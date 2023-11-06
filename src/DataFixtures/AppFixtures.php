<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $regularUser = new User();
        $regularUser
            ->setEmail("lucas@regular.com")
            ->setPassword($this->hasher->hashPassword($regularUser, "regular"));

        $manager->persist($regularUser);

        $adminUser = new User();
        $adminUser
            ->setEmail("lucas@admin.com")
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($adminUser, "admin"));

        $manager->persist($adminUser);

        $manager->flush();
    }
}
