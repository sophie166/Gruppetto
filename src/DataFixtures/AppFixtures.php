<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\GeneralChatClub;
use App\Entity\ProfilClub;
use App\Entity\ProfilSolo;
use App\Entity\Sport;
use App\Entity\SportCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // fFixures for profil club//
        $profilClub = new ProfilClub();
        $profilClub->setNameClub('Run Team');
        $profilClub->setCityClub('Lille');
        $profilClub->setLogoClub('avatar2.jpg');
        $profilClub->setDescriptionClub('Petite equipe Lilloise');
        $manager->persist($profilClub);

        $profilClub2 = new ProfilClub();
        $profilClub2->setNameClub('Swim Team');
        $profilClub2->setCityClub('Douai');
        $profilClub2->setLogoClub('avatar6.jpg');
        $profilClub2->setDescriptionClub('Club de natation');
        $manager->persist($profilClub2);

        // Fixtures for profil Solo//
        $profilSolo= new ProfilSolo();
        $profilSolo->setLastname('Doe');
        $profilSolo->setFirstname('Jonh');
        $profilSolo->setBirthdate(new\ DateTime(141220));
        $profilSolo->setDescription('My description');
        $profilSolo->setGender(0);
        $profilSolo->setAvatar('avatar.jpg');
        $profilSolo->setEmergencyContactName('Pascale Dino');
        $profilSolo->setLevel(1);
        $profilSolo->setSportFrequency(2);
        $profilSolo->setPhone('0000000000');
        $profilSolo->setEmergencyPhone('0000000000');
        $manager->persist($profilSolo);

        // Fixtures for sportCategory//
        $sportCategory=new SportCategory();
        $sportCategory->setNameCategory('Running');
        $manager->persist($sportCategory);

        // Fixtures for sport//
        $sport= new Sport();
        $sport->setSportName('Courses');
        $sport->setSportCategory($sportCategory);
        $manager->persist($sport);

        // Fixtures for event page//
         $event = new Event();
         $event->setNameEvent('Entrainement de course ');
         $event->setLevelEvent(1);
         $event->setDateEvent(new\ DateTime(6/12/2019));
         $event->setTimeEvent(new\ DateTime(16/44/12));
         $event->setDescription('Courses dans la nature');
         $event->setParticipantLimit('10');
         $event->setPlaceEvent('23 place des ecoliers 59000 Lille');
         $event->setSport($sport);
         $event->setCreatorClub($profilClub);

        $manager->persist($event);

        // Fixtures for GeneralChatClub
        $messageClub = new GeneralChatClub();
        $messageClub->setProfilClub($profilClub2);
        $messageClub->setDateMessage(new DateTime('now'));
        $messageClub->setContentMessage('Bonjour, je suis un club de natation');
        $manager->persist($messageClub);

        $manager->flush();
    }
}
