<?php

namespace App\Controller;

use App\Entity\ProfilClub;
use App\Form\ProfilClubType;
use App\Repository\ProfilClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil/club")
 */
class ProfilClubController extends AbstractController
{
    /**
     * @Route("/", name="profil_club_index", methods={"GET"})
     */
    public function index(ProfilClubRepository $profilClubRepository): Response
    {
        return $this->render('profil_club/index.html.twig', [
            'profil_clubs' => $profilClubRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="profil_club_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $profilClub = new ProfilClub();
        $form = $this->createForm(ProfilClubType::class, $profilClub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profilClub);
            $entityManager->flush();

            return $this->redirectToRoute('profil_club_index');
        }

        return $this->render('profil_club/new.html.twig', [
            'profil_club' => $profilClub,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="profil_club_show", methods={"GET"})
     */
    public function show(ProfilClub $profilClub): Response
    {
        return $this->render('profil_club/show.html.twig', [
            'profil_club' => $profilClub,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="profil_club_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProfilClub $profilClub): Response
    {
        $form = $this->createForm(ProfilClubType::class, $profilClub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profil_club_index');
        }

        return $this->render('profil_club/edit.html.twig', [
            'profil_club' => $profilClub,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="profil_club_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProfilClub $profilClub): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profilClub->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($profilClub);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profil_club_index');
    }
}
