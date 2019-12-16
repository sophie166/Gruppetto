<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }
    /**
     * @Route("/navbar", name="home")
     */
    // To display the navbar we be remove when we create the other page //
    public function nav()
    {
        return $this->render('navbar/navbar.html.twig');
    }
}
