<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Controller FrontController.
 *
 * @Route("/{_locale}", requirements={"_locale"="%app.locales%"})
 */
class FrontController extends Controller
{
    /**
     * Serves home page.
     *
     * @return Response
     *
     * @Route("/", name="home", methods={"GET"})
     */
    public function home(): Response
    {
        return $this->render('front/home.html.twig');
    }

    /**
     * Serves news page.
     *
     * @return Response
     *
     * @Route("/actualites", name="news", methods={"GET"})
     */
    public function news(): Response
    {
        return $this->render('front/news.html.twig');
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
        return $this->render('front/school.html.twig');
    }

    /**
     * Serves contact page.
     *
     * @return Response
     *
     * @Route("/contact", name="contact", methods={"GET"})
     */
    public function contact(): Response
    {
        return $this->render('front/contact.html.twig');
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
        return $this->render('front/jobs.html.twig');
    }

    /**
     * Serves courses page.
     *
     * @return Response
     *
     * @Route("/formations", name="courses", methods={"GET"})
     */
    public function courses(): Response
    {
        return $this->render('front/courses.html.twig');
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
