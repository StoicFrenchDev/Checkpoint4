<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// use Faker\Factory;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $faker = Factory::create();

        $user1 = new User();
        $user1->setEmail('user@user.com');
        $user1->setFirstname('Jacques');
        $user1->setLastname('Chirac');
        $user1->setRoles(['ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user1,
            'user1'
        );
        $user1->setPassword($hashedPassword);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('user2@user.com');
        $user2->setFirstname('Benjamin');
        $user2->setLastname('Richard');
        $user2->setRoles(['ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user2,
            'user2'
        );
        $user2->setPassword($hashedPassword);
        $manager->persist($user2);


        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setFirstname('Quentin');
        $admin->setLastname('Tarantino');
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'admin'
        );
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);

        $manager->flush();
    }
}
