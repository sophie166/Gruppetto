<?php

namespace App\Controller;

use App\Entity\ProfilClub;
use App\Entity\ProfilSolo;
use App\Entity\Sport;
use App\Entity\User;
use App\Form\InformationSoloFormType;
use App\Form\ProfilType;
use App\Form\RegistrationFormType;
use App\Form\InformationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Felicitations, vous avez fait votre premier pas chez Gruppetto !!!'
            );


            // do anything else you need here, like send an email


            return $this->render('profil/index.html.twig');
        }
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/profil", name="app_profil_register")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function profilregister(Request $request): Response
    {
        $form = $this->createForm(ProfilType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'notice',
                'Bientot arrivé, encore un petit effort !!!'
            );
                return $this->redirectToRoute('navbar');
        }
                return $this->render('profil/index.html.twig', [
            'registrationForm' => $form->createView(),
                ]);
    }

    /**
     * @Route("/register/information", name="app_info_register")
     * @param Request $request
     * @return Response
     */
    public function information(Request $request): Response
    {
        $profilClub = new ProfilClub();
        $sportName = new Sport();
        $profilClub->setNameClub('');
        $sportName->setSportName('');
        $profilClub->setCityClub('');
        $profilClub->setDescriptionClub('');
        $profilClub->setLogoClub('');

        $form = $this->createForm(InformationFormType::class, $profilClub);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profilClub);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Bravo, vous avez reussi, Bienvenue chez Gruppetto !!!'
            );

            return $this->render('navbar/navbar.html.twig', [
            ]);
        }

        return $this->render('registration/infoRegister.html.twig', [
            'registrationForm2' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/informationSolo", name="app_info_register_solo")
     * @param Request $request
     * @return Response
     */
    public function informationSolo(Request $request): Response
    {
        $profilSolo = new ProfilSolo();
        $profilSolo->setFirstname('');
        $profilSolo->setLastname('');
        $profilSolo->setAvatar('');

        $form = $this->createForm(InformationSoloFormType::class, $profilSolo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profilSolo);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Bravo, vous avez reussi, Bienvenue chez Gruppetto !!!'
            );

            return $this->render('navbar/navbar.html.twig', [
            ]);
        }

        return $this->render('registration/infoSoloRegister.html.twig', [
            'registrationForm3' => $form->createView(),
        ]);
    }
}
