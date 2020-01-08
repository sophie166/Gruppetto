<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClubChatController extends AbstractController
{
    /**
     * @Route("/club/chat", name="club_chat")
     */
    public function index()
    {
        return $this->render('club_chat/index.html.twig', [
            'controller_name' => 'ClubChatController',
        ]);
    }
}
