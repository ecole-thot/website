<?php

namespace App\Controller;

use App\Entity\NewsItem;
use App\Entity\Partner;
use App\Entity\PressItem;
use App\Entity\Setting;
use App\Entity\TeamMember;
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
    private function getAllSettings(): array
    {
        $settingsRaw = $this->getDoctrine()->getRepository(Setting::class)->findAll();

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
     * @return Response
     *
     * @Route("/", name="home", methods={"GET"})
     */
    public function home(): Response
    {
        // We need all partners
        $partners = $this->getDoctrine()->getRepository(Partner::class)->findAll();

        return $this->render('front/home.html.twig', [
            'settings' => $this->getAllSettings(),
            'partners' => $partners,
        ]);
    }

    /**
     * Serves news page.
     *
     *
     * @Route("/actualites", name="news", methods={"GET"}, defaults={"page":0})
     * @Route("/actualites/async/{page}", name="news_ajax", methods={"GET"})
     *
     * @param mixed $_route
     *
     * @return Response
     */
    public function news($_route, int $page): Response
    {
        if ('news' == $_route) {
            $lastNews = $this->getDoctrine()->getRepository(NewsItem::class)->findBy([], ['publishedAt' => 'DESC']);

            $reviews = $this->getDoctrine()->getRepository(PressItem::class)->findBy([], ['publishedAt' => 'DESC']);

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
            $lastNews = $this->getDoctrine()->getRepository(NewsItem::class)->findBy([], ['publishedAt' => 'DESC'], 4, $page * 4 + 1);

            return $this->render('_partials/articles.html.twig', [
                'articles' => $lastNews,
            ]);
        }
    }

    /**
     * Serves a specific news.
     *
     * @return Response
     *
     * @Route("/actualites/{id}", name="news_article", methods={"GET"})
     */
    public function newsArticle(int $id): Response
    {
        $news = $this->getDoctrine()->getRepository(NewsItem::class)->findOneById($id);

        if (!$news) {
            return $this->redirectToRoute('news');
        }

        // On the same theme
        $sameThemeNewsRaw = $this->getDoctrine()->getRepository(NewsItem::class)->findBy(['theme' => $news->getTheme()], ['publishedAt' => 'DESC'], 2);

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
     * @return Response
     *
     * @Route("/l-ecole", name="school", methods={"GET"})
     */
    public function school(): Response
    {
        $members = $this->getDoctrine()->getRepository(TeamMember::class)->findBy([], ['sortingOrder' => 'ASC']);

        return $this->render('front/school.html.twig', ['members' => $members]);
    }

    /**
     * Serves manifesto page.
     *
     * @return Response
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
     * @return Response
     *
     * @Route("/contact", name="contact", methods={"GET", "POST"})
     */
    public function contact(Request $request, \Swift_Mailer $mailer): Response
    {
        $info = null;

        if ('POST' === $request->getMethod()) {
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
     * @return Response
     *
     * @Route("/recrutement", name="jobs", methods={"GET"})
     */
    public function jobs(): Response
    {
        return $this->render('front/jobs.html.twig', [
            'settings' => $this->getAllSettings(),
        ]);
    }

    /**
     * Serves legal terms page.
     *
     * @return Response
     *
     * @Route("/mentions-legales", name="legal", methods={"GET"})
     */
    public function legal(): Response
    {
        return $this->render('front/legal.html.twig');
    }
}
