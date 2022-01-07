<?php

namespace App\Controller;

use App\Entity\ExamSession;
use App\Entity\NewsItem;
use App\Entity\Partner;
use App\Entity\PressItem;
use App\Entity\Setting;
use App\Entity\TeamMember;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller FrontController.
 *
 * @Route("/{_locale}", requirements={"_locale"="%app.locales%"})
 */
class FrontController extends AbstractController
{
    private function getAllSettings(ManagerRegistry $doctrine): array
    {
        $settingsRaw = $doctrine->getRepository(Setting::class)->findAll();

        // Flatten settings array
        $settings = [];
        foreach ($settingsRaw as $setting) {
            $settings[$setting->getSlug()] = $setting->getTypedValue();
        }

        return $settings;
    }

    /**
     * Serves home page.
     *
     * @Route("/", name="home", methods={"GET"})
     */
    public function home(ManagerRegistry $doctrine): Response
    {
        // We need all partners
        $partners = $doctrine->getRepository(Partner::class)->findAll();

        return $this->render('front/home.html.twig', [
            'settings' => $this->getAllSettings($doctrine),
            'partners' => $partners,
        ]);
    }

    /**
     * Serves centre d'examen page.
     *
     * @Route("/centre-examen", name="examination_center", methods={"GET", "POST"})
     */
    public function examinationCenter(ManagerRegistry $doctrine, Request $request, \Swift_Mailer $mailer): Response
    {
        $info = null;

        if ('POST' === $request->getMethod()) {
            // Get all data
            $data = $request->request->all();

            // Check captcha
            $params = [
                'secret' => $this->getParameter('recaptcha_secret'),
                'response' => $data['g-recaptcha-response'],
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $recaptcha_response = json_decode(curl_exec($ch));
            curl_close($ch);

            if (false == $recaptcha_response->success) {
                return $this->render('front/examinationCenter.html.twig', ['error' => 'captcha.notvalid']);
            }

            $form = [
                'name' => $request->request->get('name'),
                'email' => $request->request->get('email'),
                'subject' => $request->request->get('subject'),
                'message' => $request->request->get('message'),
            ];

            if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
                return $this->render('front/examinationCenter.html.twig', ['error' => 'contact.email.notvalid']);
            }

            $message = (new \Swift_Message('Email de contact site web'))
                ->setFrom($form['email'])
                ->setTo($this->getParameter('contact_email_examen'))
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',
                        $form
                    ),
                    'text/html'
                );

            $mailer->send($message);
            $info = 'contact.success';
        }

        // We need all future session dates
        $dates = $doctrine->getRepository(ExamSession::class)->findAllFutureSessions();

        // Now group by type
        $sessions = [];
        foreach ($dates as $date) {
            if (!isset($sessions[$date->getType()])) {
                $sessions[$date->getType()] = [];
            }
            $sessions[$date->getType()][] = $date;
        }

        return $this->render('front/examinationCenter.html.twig', [
            'sessions' => $sessions,
            'settings' => $this->getAllSettings($doctrine),
            'info' => $info,
        ]);
    }

    /**
     * Serves news page.
     *
     * @Route("/actualites", name="news", methods={"GET"}, defaults={"page":0})
     * @Route("/actualites/async/{page}", name="news_ajax", methods={"GET"})
     *
     * @param mixed $_route
     */
    public function news(ManagerRegistry $doctrine, $_route, int $page): Response
    {
        if ('news' == $_route) {
            $lastNews = $doctrine->getRepository(NewsItem::class)->findBy([], ['publishedAt' => 'DESC']);

            $reviews = $doctrine->getRepository(PressItem::class)->findBy([], ['publishedAt' => 'DESC']);

            // Order by year
            $reviewsByYear = [];
            foreach ($reviews as $review) {
                $year = $review->getPublishedAt()->format('Y');
                if (!isset($reviewsByYear[$year])) {
                    $reviewsByYear[$year] = [];
                }
                $reviewsByYear[$year][] = $review;
            }

            return $this->render('front/news.html.twig', [
                'lastNews' => $lastNews,
                'reviews' => $reviewsByYear,
            ]);
        } else {
            $lastNews = $doctrine->getRepository(NewsItem::class)->findBy([], ['publishedAt' => 'DESC'], 4, $page * 4 + 1);

            return $this->render('_partials/articles.html.twig', [
                'articles' => $lastNews,
            ]);
        }
    }

    /**
     * Serves a specific news.
     *
     * @Route("/actualites/{id}", name="news_article", methods={"GET"})
     */
    public function newsArticle(ManagerRegistry $doctrine, int $id): Response
    {
        $news = $doctrine->getRepository(NewsItem::class)->findOneById($id);

        if (!$news) {
            return $this->redirectToRoute('news');
        }

        // On the same theme
        $sameThemeNewsRaw = $doctrine->getRepository(NewsItem::class)->findBy(['theme' => $news->getTheme()], ['publishedAt' => 'DESC'], 2);

        $sameThemeNews = [];
        // Remove the actual news
        foreach ($sameThemeNewsRaw as $stnews) {
            if ($news->getId() !== $stnews->getId()) {
                $sameThemeNews[] = $stnews;
            }
        }

        return $this->render('front/news.article.html.twig', [
            'news' => $news,
            'sameThemeNews' => $sameThemeNews,
        ]);
    }

    /**
     * Serves school page.
     *
     * @Route("/l-ecole", name="school", methods={"GET"})
     */
    public function school(ManagerRegistry $doctrine): Response
    {
        $members = $doctrine->getRepository(TeamMember::class)->findBy([], ['sortingOrder' => 'ASC']);

        return $this->render('front/school.html.twig', ['members' => $members]);
    }

    /**
     * Serves manifesto page.
     *
     * @Route("/manifeste", name="manifesto", methods={"GET"})
     */
    public function manifesto(): Response
    {
        return $this->render('front/manifesto.html.twig');
    }

    /**
     * Serves contact page.
     *
     * @Route("/contact", name="contact", methods={"GET", "POST"})
     */
    public function contact(Request $request, \Swift_Mailer $mailer): Response
    {
        $info = null;

        if ('POST' === $request->getMethod()) {
            // Get all data
            $data = $request->request->all();

            // Check captcha
            $params = [
                'secret' => $this->getParameter('recaptcha_secret'),
                'response' => $data['g-recaptcha-response'],
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $recaptcha_response = json_decode(curl_exec($ch));
            curl_close($ch);

            if (false == $recaptcha_response->success) {
                return $this->render('front/contact.html.twig', ['error' => 'captcha.notvalid']);
            }

            $form = [
                'name' => $request->request->get('name'),
                'email' => $request->request->get('email'),
                'subject' => $request->request->get('subject'),
                'message' => $request->request->get('message'),
            ];

            if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
                return $this->render('front/contact.html.twig', ['error' => 'contact.email.notvalid']);
            }

            $message = (new \Swift_Message('Email de contact site web'))
                ->setFrom($form['email'])
                ->setTo($this->getParameter('contact_email'))
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',
                        $form
                    ),
                    'text/html'
                );

            $mailer->send($message);
            $info = 'contact.success';
        }

        return $this->render('front/contact.html.twig', ['info' => $info]);
    }

    /**
     * Serves jobs page.
     *
     * @Route("/recrutement", name="jobs", methods={"GET"})
     */
    public function jobs(ManagerRegistry $doctrine): Response
    {
        return $this->render('front/jobs.html.twig', [
            'settings' => $this->getAllSettings($doctrine),
        ]);
    }

    /**
     * Serves legal terms page.
     *
     * @Route("/mentions-legales", name="legal", methods={"GET"})
     */
    public function legal(): Response
    {
        return $this->render('front/legal.html.twig');
    }
}
