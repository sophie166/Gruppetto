<?php

namespace App\Controller;

use App\Entity\GeneralChatClub;
use App\Entity\ProfilClub;
use App\Entity\User;
use App\Repository\GeneralChatClubRepository;
use App\Repository\ProfilClubRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
    public function chatGeneral(GeneralChatClubRepository $clubRepository) : Response
    {
        return $this->render('club_chat/general.html.twig', [
            'messages' => $clubRepository->findAll(),
            ]);
    }
}
