<?php

namespace App\Controller;

use App\Entity\GeneralChatClub;
use App\Entity\ProfilClub;
use App\Entity\User;
use App\Form\GeneralChatType;
use App\Repository\GeneralChatClubRepository;
use App\Repository\ProfilClubRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

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
    public function chatGeneral(GeneralChatClubRepository $clubRepository, Request $request) : Response
    {
        $newMessage = new GeneralChatClub();
        $form = $this->createForm(GeneralChatType::class, $newMessage);
        $form->handleRequest($request);
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $club = $this->getDoctrine()->
            getRepository(ProfilClub::class)
                ->findBy([
                 'id' => $_POST['profilClub']
                ]);
            $newMessage->setDateMessage(new \DateTime('now'));
            $newMessage ->setContentMessage($form["contentMessage"]->getData());
            $newMessage->setProfilClub($club[0]);
            if (in_array('ROLE_USER', $user->getRoles())) {
                 $newMessage->setProfilSolo($user->getProfilSolo());
            } else {
                 $newMessage->setProfilSolo(null);
            }
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($newMessage);
             $entityManager->flush();
             return $this->redirectToRoute('club_chat_general');
        }


        return $this->render('club_chat/general.html.twig', [
            'messages' => $clubRepository->findAll(),
            'form' => $form->createView(),

        ]);
    }
}
