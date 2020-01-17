<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

        if ($this->getUser()) {
            return $this->redirectToRoute('club_chat');
        }
        return $this->render('home/index.html.twig');
    }

    /**
     * @return Response
     * @Route("/details", name="information")
     */
    public function show(): Response
    {
        return $this->render('details.html.twig');
    }

}
