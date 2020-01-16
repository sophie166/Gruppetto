<?php

namespace App\Controller;

use App\Entity\ProfilClub;
use App\Entity\Sport;
use App\Entity\User;
use App\Form\DescriptionFormType;
use App\Form\ProfilType;
use App\Form\RegistrationFormType;
use App\Form\InformationFormType;
use App\Repository\UserRepository;
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


            // do anything else you need here, like send an email

            return $this->redirectToRoute("app_profil_register", [
            ]);
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
        $user= new User();
        $form = $this->createForm(ProfilType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'VOUS ETES A LA MOITIÉ DE VOTRE INSCRIPTION, ENCORE UN PETIT EFFORT !!!'
            );

            return $this->redirectToRoute('app_info_register');
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


            return $this->redirectToRoute('app_descript_register');
        }

        return $this->render('registration/infoRegister.html.twig', [
            'registrationForm2' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/information/description", name="app_descript_register",)
     * @param Request $request
     * @return Response
     */
    public function description(Request $request): Response
    {
        $descriptionClub=new ProfilClub;
        $form = $this->createForm(DescriptionFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $descriptionClub->setDescriptionClub('');
            $descriptionClub->setLogoClub('');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($descriptionClub);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'VOTRE INSCRIPTION A ÉTÉ ENREGISTRÉE !!!'
            );

            return $this->redirectToRoute('navigation');
        }

        return $this->render('registration/descriptionRegister.html.twig', [
            'registrationForm2' => $form->createView(),
        ]);
    }
}
