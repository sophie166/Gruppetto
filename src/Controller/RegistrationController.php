<?php

namespace App\Controller;

use App\Entity\ProfilClub;
use App\Entity\Sport;
use App\Entity\User;
use App\Form\DescriptionFormType;
use App\Form\ProfilType;
use App\Form\RegistrationFormType;
use App\Form\InformationFormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
    public function profilregister()
    {
        $form = $this
            ->createForm(ProfilType::class);

        return $this->render('profil/index.html.twig', [
            'registrationForm2' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/information", name="app_info_register")
     */
    public function information(Request $request): Response
    {
        $profilClub = new ProfilClub();
        $sportName = new Sport();
        $profilClub->setNameClub('');
        $sportName->setSportName('');
        $profilClub->setCityClub('');

        $form = $this->createForm(InformationFormType::class, $profilClub)
            ->add('nameClub', TextType::class)
            ->add('sport', EntityType::class, [
                'class' => Sport::class,
            ])
            ->add('cityClub', TextType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profilClub->getNameClub();
            $sportName->getSportName();
            $profilClub->getCityClub();

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
        $descriptionClub = new ProfilClub();
        $descriptionClub->setDescriptionClub('');
        $descriptionClub->setLogoClub('');

        $form = $this->createForm(DescriptionFormType::class, $descriptionClub)
            ->add('LogoClub', FileType::class, array(
            ))
            ->add('DescriptionClub', TextareaType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $descriptionClub->setDescriptionClub('description');
            $descriptionClub->getLogoClub();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($descriptionClub);
            $entityManager->flush();

            return $this->redirectToRoute('app_descript_register');
        }

        return $this->render('registration/descriptionRegister.html.twig', [
        'registrationForm4' => $form->createView(),
        ]);
    }
}
