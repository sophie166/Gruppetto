<?php

namespace App\Controller;

use App\Entity\ProfilClub;
use App\Entity\User;
use App\Form\ProfilClubType;
use App\Form\UserType;
use App\Repository\ProfilClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil/club")
 */
class ProfilClubController extends AbstractController
{

    /**
     * @Route("/{id}/", name="profil_club_edit", methods={"GET","POST"})
     * @param Request $request
     * @param ProfilClub $profilClub
     * @return Response
     * @IsGranted("ROLE_USER")
     */

    public function edit(Request $request, ProfilClub $profilClub): Response
    {
        // create form for profil club and user password security
        $form = $this->createForm(ProfilClubType::class, $profilClub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile =$form['logoClub']->getData();

            if ($logoFile) {
                $logoFileName = md5(uniqid()). '.'.$logoFile->guessExtension();
                // Move the file to the directory where brochures are stored
                $logoFile->move($this->getParameter('upload_directory'), $logoFileName);
                $profilClub->setLogoClub($logoFileName);
            }

            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('profil_club/show.html.twig', [
            'profil_club' => $profilClub,
            'form' => $form->createView(),
        ]);
    }
}
