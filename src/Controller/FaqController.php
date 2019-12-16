<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaqController extends AbstractController
{
    /**
     * @return Response
     * @Route("/faq", name="faq")
     */
    public function show(): Response
    {
        return $this->render('faq.html.twig');
    }
}
