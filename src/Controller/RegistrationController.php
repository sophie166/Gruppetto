<?php

namespace App\Controller;

use App\Entity\ProfilClub;
use App\Entity\ProfilSolo;
use App\Entity\Sport;
use App\Entity\User;
use App\Form\InformationClubFormType;
use App\Form\InformationSoloFormType;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
                'Félicitations, vous avez fait votre premier pas chez Gruppetto !!!'
            );


            // do anything else you need here, like send an email


            return $this->render('profil/index.html.twig');
        }
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/register/club/information", name="app_club_register_informations")
     * @param Request $request
     * @return Response
     */
    public function informationClub(Request $request): Response
    {
        $profilClub = new ProfilClub();
        $profilClub->setNameClub('');
        $profilClub->setCityClub('');
        $profilClub->setDescriptionClub('');

        $form = $this->createForm(InformationClubFormType::class, $profilClub);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            if (is_null($form['logoClub']->getData())) {
                $profilClub->setLogoClub('no_avatar.jpg');
            } else {
                $profilClub->setLogoClub($form['logoClub']->getData());
                $logoClub=md5(uniqid()) . '.' . $profilClub->getLogoClub();
                $profilClub->setLogoClub($logoClub);
            }
            $profilClub->setSport($form['sport']->getData());

            $this->getUser()->setRoles(['ROLE_USER', 'ROLE_CLUBER']);

            // linking user to ProfilClub
            $profilClub->addUser($this->getUser());
            $entityManager->persist($profilClub);
            $entityManager->persist($this->getUser());
            $entityManager->flush();
            $this->addFlash(
                'notice',
                "Il ne vous reste plus q'à vous connecter !"
            );

            return $this->redirectToRoute('app_login');
        }
        return $this->render('registration/infoClubRegister.html.twig', [
            'registrationForm2' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/solo/informations", name="app_solo_register_informations")
     * @param Request $request
     * @return Response
     */
    public function informationSolo(Request $request): Response
    {
        $profilSolo = new ProfilSolo();
        $profilSolo->setFirstname('');
        $profilSolo->setLastname('');

        $form = $this->createForm(InformationSoloFormType::class, $profilSolo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            if (is_null($form['LogoClub']->getData())) {
                $profilSolo->setAvatar('no_avatar.jpg');
            } else {
                $profilSolo->setAvatar($form['LogoClub']->getData());
            }
            $entityManager->persist($profilSolo);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Bravo, vous avez reussi, Bienvenue chez Gruppetto !!!'
            );

            return $this->render('event/index.html.twig');
        }

        return $this->render('registration/infoSoloRegister.html.twig', [
            'registrationForm3' => $form->createView(),
        ]);
    }
}
