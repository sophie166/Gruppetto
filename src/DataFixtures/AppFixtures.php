<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\ProfilClub;
use App\Entity\ProfilSolo;
use App\Entity\Sport;
use App\Entity\SportCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // fFixtures for profil club//
        $profilClub = new ProfilClub();
        $profilClub->setNameClub('Run Team');
        $profilClub->setCityClub('Lille');
        $profilClub->setLogoClub('avatar2.jpg');
        $profilClub->setDescriptionClub('Petite equipe Liloise');
        $manager->persist($profilClub);

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

        $manager->flush();
    }
}
