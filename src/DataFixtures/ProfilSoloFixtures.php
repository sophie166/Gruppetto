<?php


namespace App\DataFixtures;

use App\Entity\ProfilSolo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ProfilSoloFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');

        for ($i = 1; $i <= 5; $i++) {
            $profilSoloLambda = new ProfilSolo();
            $profilSoloLambda
                ->setLastname($faker->lastName)
                ->setFirstname($faker->firstName)
                ->setBirthdate($faker->dateTimeThisCentury)
                ->setDescription($faker->realText(200))
                ->setGender($faker->boolean)
                ->setAvatar($faker->imageUrl(640, 480))
                ->setEmergencyContactName($faker->name)
                ->setLevel(1)
                ->setSportFrequency(4)
                ->setPhone("0603948293")
                ->setEmergencyPhone("0345029382");
            $manager->persist($profilSoloLambda);
        }
        $manager->flush();
    }
}
