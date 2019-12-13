<?php

// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaqController extends AbstractController
{
    /**
     * Getting a program with a formatted slug for title
     *
     * @return Response
     * @Route("/faq", name="faq")
     */
    public function show(): Response
    {
        return $this->render('faq.html.twig');
    }
}
