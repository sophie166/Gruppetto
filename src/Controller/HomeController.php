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
     * @Route("/navbar", name="navigation")
     */
    // To display the navbar will be removed when we create the other pages //
    public function nav()
    {
        return $this->render('navbar/navbar.html.twig');
    }
}
