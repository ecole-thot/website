<?php

namespace App\Controller;

use App\Entity\ExamSession;
use App\Entity\NewsItem;
use App\Entity\Partner;
use App\Entity\PressItem;
use App\Entity\Setting;
use App\Entity\TeamMember;
use App\Form\ExamSessionType;
use App\Form\NewsItemType;
use App\Form\PartnerType;
use App\Form\PressItemType;
use App\Form\TeamMemberType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller BackendController.
 *
 * @Route("/admin")
 */
class BackendController extends AbstractController
{
    /**
     * Serves home page.
     *
     * @Route("/", name="admin_home", methods={"GET"})
     */
    public function home(): Response
    {
        // We need all settings
        $settingsRaw = $this->getDoctrine()->getRepository(Setting::class)->findAll();
        $partners = $this->getDoctrine()->getRepository(Partner::class)->findAll();
        $members = $this->getDoctrine()->getRepository(TeamMember::class)->findAll();
        $news = $this->getDoctrine()->getRepository(NewsItem::class)->findAll();
        $press = $this->getDoctrine()->getRepository(PressItem::class)->findAll();

        // Flatten settings array
        foreach ($settingsRaw as $setting) {
            $settings[$setting->getSlug()] = $setting->getValue();
        }

        return $this->render('admin/home.html.twig', [
            'settings' => $settings,
            'partners' => $partners,
            'members' => $members,
            'news' => $news,
            'press' => $press,
        ]);
    }

    /**
     * Serves press page.
     *
     * @Route("/revue/de/presse", name="admin_press", methods={"GET"})
     */
    public function press(): Response
    {
        $pressItems = $this->getDoctrine()->getRepository(PressItem::class)->findBy([], ['publishedAt' => 'DESC']);

        return $this->render('admin/press.html.twig', ['press' => $pressItems]);
    }

    /**
     * Serves press page.
     *
     * @Route("/revue/de/presse/nouveau", name="admin_press_new", methods={"GET", "POST"}, defaults={"id"=null})
     * @Route("/revue/de/presse/edition/{id}", name="admin_press_edit", methods={"GET", "POST"})
     */
    public function pressEdit(Request $request, ?int $id): Response
    {
        if ($id) {
            $press = $this->getDoctrine()->getRepository(PressItem::class)->findOneById($id);
            if (!$press) {
                throw new NotFoundHttpException();
            }
            if ($press->getDocument()) {
                $previousDocument = $press->getDocument();
                $press->setDocument(new File($this->getParameter('press_documents_directory').'/'.$press->getDocument()));
            }
        } else {
            $press = new PressItem();
        }

        $form = $this->createForm(PressItemType::class, $press);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // If this is a file
            if ($press->getDocument() && null != $press->getDocument()) {
                $file = $press->getDocument();
                $filename = base_convert(mt_rand(100000, 999999), 10, 36).'-'.$file->getClientOriginalName();
                try {
                    $file->move(
                        $this->getParameter('press_documents_directory'),
                        $filename
                    );
                } catch (FileException $e) {
                }
                $press->setDocument($filename);
            } else {
                $press->setDocument($previousDocument);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($press);
            $em->flush();

            return $this->redirectToRoute('admin_press');
        }

        return $this->render('admin/press.edit.html.twig', [
            'press' => $press,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Serves news page.
     *
     * @Route("/actualites", name="admin_news", methods={"GET"})
     */
    public function news(): Response
    {
        $news = $this->getDoctrine()->getRepository(NewsItem::class)->findBy([], ['publishedAt' => 'ASC']);

        return $this->render('admin/news.html.twig', ['news' => $news]);
    }

    /**
     * Edit news.
     *
     * @Route("/actualites/edit/new", name="admin_news_new", methods={"GET","POST"}, defaults={"id":null})
     * @Route("/actualites/edit/{id}", name="admin_news_edit", methods={"GET","POST"})
     */
    public function newsEdit(Request $request, int $id = null): Response
    {
        if ($id) {
            $news = $this->getDoctrine()->getRepository(NewsItem::class)->findOneById($id);
            if (!$news) {
                throw new NotFoundHttpException();
            }
            if ($news->getImage()) {
                $image = $news->getImage();
                $news->setImage(new File($this->getParameter('news_images_directory').'/'.$news->getImage()));
            }
            if ($news->getLinkedFile()) {
                $linkedFile = $news->getLinkedFile();
                $news->setLinkedFile(new File($this->getParameter('news_files_directory').'/'.$news->getLinkedFile()));
            }
        } else {
            $news = new NewsItem();
        }

        if (!$news) {
            $this->redirectToRoute('admin_news');
        }

        $form = $this->createForm(NewsItemType::class, $news);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $imageFile = $news->getImage();
            if ($imageFile) {
                $imageFileName = md5(uniqid()).'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('news_images_directory'),
                        $imageFileName
                    );
                } catch (FileException $e) {
                }

                $news->setImage($imageFileName);
            } else {
                $news->setImage($image);
            }

            $linkedFile = $news->getLinkedFile();
            if ($linkedFile) {
                $linkedFileName = substr(md5(uniqid()), 0, 12).'_'.$linkedFile->getClientOriginalName();

                try {
                    $linkedFile->move(
                        $this->getParameter('news_files_directory'),
                        $linkedFileName
                    );
                } catch (FileException $e) {
                }

                $news->setLinkedFile($linkedFileName);
            } else {
                $news->setLinkedFile($linkedFile);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('admin_news');
        }

        return $this->render('admin/news.edit.html.twig', ['form' => $form->createView(), 'news' => $news, 'image' => $image ?? null, 'linkedFile' => $linkedFile ?? null]);
    }

    /**
     * Deletes a news.
     *
     * @Route("/actualites/suppression/{id}", name="admin_news_delete", methods={"GET"})
     */
    public function newsDelete(Request $request, ?int $id): Response
    {
        $news = $this->getDoctrine()->getRepository(NewsItem::class)->findOneById($id);
        if (!$news) {
            throw new NotFoundHttpException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($news);
        $em->flush();

        return $this->redirectToRoute('admin_news');
    }

    /**
     * Serves partners page.
     *
     * @Route("/partenaires", name="admin_partners", methods={"GET"})
     */
    public function partners(): Response
    {
        $partners = $this->getDoctrine()->getRepository(Partner::class)->findAll();

        return $this->render('admin/partners.html.twig', ['partners' => $partners]);
    }

    /**
     * Serves partners edition page.
     *
     * @Route("/partenaire/nouveau", name="admin_partner_new", methods={"GET", "POST"}, defaults={"id"=null})
     * @Route("/partenaire/edition/{id}", name="admin_partner_edit", methods={"GET", "POST"})
     */
    public function partnerEdit(Request $request, ?int $id): Response
    {
        if ($id) {
            $partner = $this->getDoctrine()->getRepository(Partner::class)->findOneById($id);
            if (!$partner) {
                throw new NotFoundHttpException();
            }
            if ($partner->getImage()) {
                $image = $partner->getImage();
                $partner->setImage(new File($this->getParameter('partner_images_directory').'/'.$partner->getImage()));
            }
        } else {
            $partner = new Partner();
        }

        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $partner->getImage();
            if ($file) {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                try {
                    $file->move(
                    $this->getParameter('partner_images_directory'),
                    $fileName
                );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $partner->setImage($fileName);
            } else {
                $partner->setImage($image);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush();

            return $this->redirectToRoute('admin_partners');
        }

        return $this->render('admin/partner.edit.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
            'image' => $image ?? null,
        ]);
    }

    /**
     * Deletes a partner.
     *
     * @Route("/partenaire/suppression/{id}", name="admin_partner_delete", methods={"GET", "POST"})
     */
    public function partnerDelete(Request $request, ?int $id): Response
    {
        $partner = $this->getDoctrine()->getRepository(Partner::class)->findOneById($id);
        if (!$partner) {
            throw new NotFoundHttpException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($partner);
        $em->flush();

        return $this->redirectToRoute('admin_partners');
    }

    /**
     * Serves centre d'examen page.
     *
     * @Route("/examens", name="admin_examens", methods={"GET"})
     */
    public function examDates(): Response
    {
        $sessions = $this->getDoctrine()->getRepository(ExamSession::class)->findAll();

        return $this->render('admin/examSessions.html.twig', ['sessions' => $sessions]);
    }

    /**
     * Serves centre d'examen edition page.
     *
     * @Route("/examens/nouveau", name="admin_examen_new", methods={"GET", "POST"}, defaults={"id"=null})
     * @Route("/examens/edition/{id}", name="admin_examen_edit", methods={"GET", "POST"})
     */
    public function examDateEdit(Request $request, ?int $id): Response
    {
        if ($id) {
            $session = $this->getDoctrine()->getRepository(ExamSession::class)->findOneById($id);
            if (!$session) {
                throw new NotFoundHttpException();
            }
        } else {
            $session = new ExamSession();
        }

        $form = $this->createForm(ExamSessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($session);
            $em->flush();

            return $this->redirectToRoute('admin_examens');
        }

        return $this->render('admin/examSession.edit.html.twig', [
            'session' => $session,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Deletes a exam date.
     *
     * @Route("/examens/suppression/{id}", name="admin_examen_delete", methods={"GET", "POST"})
     */
    public function examDateDelete(Request $request, ?int $id): Response
    {
        $partner = $this->getDoctrine()->getRepository(Partner::class)->findOneById($id);
        if (!$partner) {
            throw new NotFoundHttpException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($partner);
        $em->flush();

        return $this->redirectToRoute('admin_examens');
    }

    /**
     * Serves members page.
     *
     * @Route("/equipe", name="admin_members", methods={"GET"})
     */
    public function members(): Response
    {
        $members = $this->getDoctrine()->getRepository(TeamMember::class)->findAll();

        return $this->render('admin/members.html.twig', ['members' => $members]);
    }

    /**
     * Serves members edition page.
     *
     * @Route("/equipe/nouveau", name="admin_member_new", methods={"GET", "POST"}, defaults={"id"=null})
     * @Route("/equipe/edition/{id}", name="admin_member_edit", methods={"GET", "POST"})
     */
    public function membersEdit(Request $request, ?int $id): Response
    {
        if ($id) {
            $member = $this->getDoctrine()->getRepository(TeamMember::class)->findOneById($id);
            if (!$member) {
                throw new NotFoundHttpException();
            }
            if ($member->getImage()) {
                $image = $member->getImage();
                $member->setImage(new File($this->getParameter('members_images_directory').'/'.$member->getImage()));
            }
        } else {
            $member = new TeamMember();
        }

        $form = $this->createForm(TeamMemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $member->getImage();
            if ($file) {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                try {
                    $file->move(
                    $this->getParameter('members_images_directory'),
                    $fileName
                );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $member->setImage($fileName);
            } else {
                $member->setImage($image);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();

            return $this->redirectToRoute('admin_members');
        }

        return $this->render('admin/member.edit.html.twig', [
            'member' => $member,
            'form' => $form->createView(),
            'image' => $image ?? null,
        ]);
    }

    /**
     * Deletes a member.
     *
     * @Route("/equipe/suppression/{id}", name="admin_member_delete", methods={"GET", "POST"})
     */
    public function memberDelete(Request $request, ?int $id): Response
    {
        $member = $this->getDoctrine()->getRepository(TeamMember::class)->findOneById($id);
        if (!$member) {
            throw new NotFoundHttpException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($member);
        $em->flush();

        return $this->redirectToRoute('admin_members');
    }

    /**
     * Serves inscriptions page.
     *
     * @Route("/inscriptions", name="admin_inscriptions", methods={"GET"})
     */
    public function inscriptions(): Response
    {
        // We need all settings
        $settingsRaw = $this->getDoctrine()->getRepository(Setting::class)->findAll();

        // Flatten settings array
        foreach ($settingsRaw as $setting) {
            $settings[$setting->getSlug()] = $setting->getValue();
        }

        return $this->render('admin/inscriptions.html.twig', ['settings' => $settings]);
    }

    /**
     * Toggle inscriptions status.
     *
     * @Route("/inscriptions/{which}/{status}", name="admin_inscriptions_toggle", methods={"GET"})
     *
     * @param mixed $status
     */
    public function inscriptionsToggle(string $which, $status): Response
    {
        // We need all settings
        $setting = $this->getDoctrine()->getRepository(Setting::class)->findOneBySlug($which);

        if (!$setting) {
            throw new NotFoundHttpException();
        }

        $setting->setValue($status);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('admin_inscriptions');
    }

    /**
     * Change inscriptions values.
     *
     * @Route("/settings/values", name="admin_settings_values", methods={"POST"})
     */
    public function settingsValues(Request $request): Response
    {
        // We need all settings
        $settings = $this->getDoctrine()->getRepository(Setting::class)->findAll();

        foreach ($request->request as $key => $data) {
            foreach ($settings as $setting) {
                if ($setting->getSlug() === $key) {
                    $setting->setValue($data);
                }
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response($this->generateUrl('admin_inscriptions'));
    }
}
