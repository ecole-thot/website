<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller DefaultController.
 */
class DefaultController extends Controller
{
    /**
     * Redirect to correct home page following user's locale.
     *
     * @return Response
     *
     * @Route("/", name="default", methods={"GET"})
     */
    public function index(): Response
    {
        // Just redirect to home page, using the default locale
        return $this->redirectToRoute('home');
    }
}
