<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $admin = new User($this->passwordHasher);
        $admin->setemail("Admin@admin.fr")->setname("admin")->setPassword("123456")->setRoles(["ROLE_USER", "ROLE_ADMIN"])->setNbPersonnes("1");
        $manager->persist($admin);


        $manager->flush();
    }
}
