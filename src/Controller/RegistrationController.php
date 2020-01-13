<?php

namespace App\Controller;

use App\Entity\ProfilClub;
use App\Entity\User;
use App\Form\DescriptionFormType;
use App\Form\ProfilType;
use App\Form\RegistrationFormType;
use App\Form\InformationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
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

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_profil_register');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/profil", name="app_profil_register")
     */
    public function profil(Request $request): Response
    {
        $roles = new User();
        $form = $this
            ->createForm(ProfilType::class, $roles);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($roles);
            $entityManager->flush();


            return $this->redirectToRoute('app_info_register');
        }
        return $this->render('profil/index.html.twig', [
            'registrationForm2' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/information", name="app_info_register")
     */
    public function information(Request $request): Response
    {
        $profilClub=new ProfilClub();
        $form = $this->createForm(InformationFormType::class, $profilClub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profilClub);
            $entityManager->flush();

            return $this->redirectToRoute('app_descript_register');
        }

        return $this->render('registration/infoRegister.html.twig', [
            'registrationForm3' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/description", name="app_descript_register")
     */
    public function description(Request $request): Response
    {
        $descript = new ProfilClub();
        $form = $this->createForm(DescriptionFormType::class, $descript);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($descript);
            $entityManager->flush();


            return $this->redirectToRoute('app_descript_register');
        }
        return $this->render('registration/descriptionRegister.html.twig', [
            'registrationForm4' => $form->createView(),
        ]);
    }
}
