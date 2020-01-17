<?php


namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // Creating admin user
        $admin = new User();
        $admin->setEmail('admin@gruppetto.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));

        $manager->persist($admin);

        // Creating cluber user
        $cluber = new User();
        $cluber->setEmail('club@club-lambda.com');
        $cluber->setRoles(['ROLE_CLUBER']);
        $cluber->setPassword($this->passwordEncoder->encodePassword(
            $cluber,
            'clubpassword'
        ));

        $manager->persist($cluber);

        // Saving new users
        $manager->flush();
    }
}
