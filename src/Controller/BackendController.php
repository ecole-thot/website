<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Entity\Setting;
use App\Form\PartnerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        return $this->render('admin/home.html.twig');
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
     * @Route("/partenaire/nouveau", name="admin_partner_create", methods={"GET", "POST"}, defaults={"id"=null})
     * @Route("/partenaire/edition/{id}", name="admin_partner_edit", methods={"GET", "POST"})
     */
    public function partnerEdit(Request $request, ?int $id): Response
    {
        if ($id) {
            $partner = $this->getDoctrine()->getRepository(Partner::class)->findOneById($id);
            if (!$partner) {
                throw new NotFoundHttpException();
            }
        } else {
            $partner = new Partner();
        }

        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $partner->getImage();
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

            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush();

            return $this->redirectToRoute('admin_partners');
        }

        return $this->render('admin/partner.edit.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
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
}
