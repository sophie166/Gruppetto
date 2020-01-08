<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $event = new Event();
         $event->setNameEvent('Entrainement de course ');
         $event->setLevelEvent('Debutant');
         $event->setDateEvent('new\DateTime(O6/12/2012)');
         $event->setTimeEvent('1:12:12');
         $event->setDescription('Courses dans la nature');
         $event->setParticipantLimit('10');
        $manager->persist($event);

        $manager->flush();
    }
}
