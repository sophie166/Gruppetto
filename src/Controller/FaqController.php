<?php

// src/Controller/WildController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class FaqController extends AbstractController
{
    /**
     * Getting a program with a formatted slug for title
     *
     * @param string|null $slug The slugger
     * @return Response
     * @Route("/faq", name="faq")
     */
    public function show(?string $slug): Response
    {
        return $this->render('faq.html.twig');
    }
}
