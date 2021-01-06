<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var mixed
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail("klassevent@ymail.com")
            ->setName("admin")
            ->setFirstName("admin")
            ->setPhone("0123456789")
            ->setPassword($this->encoder->encodePassword($admin, "KlassEvent"))
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $manager->flush();
    }
    // to init project -> $ symfony console d:f:l
}
