<?php


namespace App\DataFixtures;

use App\Entity\ProfilClub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ProfilClubFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');

        for ($i = 1; $i <= 2; $i++) {
            $profilClub = new ProfilClub();
            $profilClub->setNameClub('Run Team');
            $profilClub->setCityClub('Lille');
            $profilClub->setLogoClub($faker->imageUrl());
            $profilClub->setDescriptionClub('Petite équipe Lilloise');
            $manager->persist($profilClub);
        }
        $manager->flush();
    }
}
