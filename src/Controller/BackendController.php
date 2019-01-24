<?php

namespace App\Controller;

use App\Entity\NewsItem;
use App\Entity\Partner;
use App\Entity\PressItem;
use App\Entity\Setting;
use App\Entity\TeamMember;
use App\Form\NewsItemType;
use App\Form\PartnerType;
use App\Form\PressItemType;
use App\Form\TeamMemberType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller BackendController.
 *
 * @Route("/admin")
 */
class BackendController extends Controller
{
    /**
     * Serves home page.
     *
     * @return Response
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
            'press' => $press
        ]);
    }

    /**
     * Serves press page.
     *
     * @return Response
     *
     * @Route("/revue/de/presse", name="admin_press", methods={"GET"})
     */
    public function press(): Response
    {
        $pressItems = $this->getDoctrine()->getRepository(PressItem::class)->findAll();

        return $this->render('admin/press.html.twig', ['press' => $pressItems]);
    }

    /**
     * Serves press page.
     *
     * @return Response
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
        } else {
            $press = new PressItem();
        }

        $form = $this->createForm(PressItemType::class, $press);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
     * @return Response
     *
     * @Route("/actualites", name="admin_news", methods={"GET"})
     */
    public function news(): Response
    {
        $news = $this->getDoctrine()->getRepository(NewsItem::class)->findAll();

        return $this->render('admin/news.html.twig', ['news' => $news]);
    }

    /**
     * Edit news.
     *
     * @return Response
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
            $file = $news->getImage();
            if ($file) {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('news_images_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                }

                $news->setImage($fileName);
            } else {
                $news->setImage($image);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('admin_news');
        }

        return $this->render('admin/news.edit.html.twig', ['form' => $form->createView(), 'news' => $news, 'image' => $image ?? null]);
    }

    /**
     * Deletes a news.
     *
     * @return Response
     *
     * @Route("/ctualites/suppression/{id}", name="admin_news_delete", methods={"GET"})
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
     * @return Response
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
     * @return Response
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
     * @return Response
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
     * Serves members page.
     *
     * @return Response
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
     * @return Response
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
     * @return Response
     *
     * @Route("/partenaire/suppression/{id}", name="admin_member_delete", methods={"GET", "POST"})
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
     * @return Response
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
     *
     * @Route("/inscriptions/{which}/{status}", name="admin_inscriptions_toggle", methods={"GET"})
     *
     * @param mixed $status
     *
     * @return Response
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
     * @return Response
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
