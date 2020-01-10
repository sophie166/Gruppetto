<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClubChatController
 * @package App\Controller
 * @Route("/club/chat", name="club_chat")
 */
class ClubChatController extends AbstractController
{
    /**
     * @Route("", name="")
     * @return Response
     */
    public function chat(): Response
    {
        return $this->render('club_chat/index.html.twig', [
        ]);
    }

    /**
     * @return Response
     * @Route("/general", name="_general")
     */
    public function chatGeneral() : Response
    {
        return $this->render('club_chat/general.html.twig');
    }
}
