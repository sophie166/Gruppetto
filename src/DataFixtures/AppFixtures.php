<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // Fixtures for event page//
         $event = new Event();
         $event->setNameEvent('Entrainement de course ');
         $event->setLevelEvent(1);
         $event->setDateEvent(new\ DateTime(6/12/2019));
         $event->setTimeEvent(new\ DateTime(16/44/12));
         $event->setDescription('Courses dans la nature');
         $event->setParticipantLimit('10');
         $event->setPlaceEvent('23 place des ecoliers 59000 Lille');
        $manager->persist($event);

        $manager->flush();
    }
}
