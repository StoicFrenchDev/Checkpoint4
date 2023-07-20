<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// use Faker\Factory;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $faker = Factory::create();

        $usersData = [
            [
                'email' => 'thomasa@sf.com',
                'firstname' => 'Thomas', 'lastname' => 'Aldaitz',
                'password' => 'Thom123',
            ],
            [
                'email' => 'ludovicd@sf.com',
                'firstname' => 'Ludovic', 'lastname' => 'Dormoy',
                'password' => 'Ludo123',
            ],
            [
                'email' => 'benjaminr@sf.com',
                'firstname' => 'Benjamin', 'lastname' => 'Richard',
                'password' => 'Ben123',
            ],
            [
                'email' => 'baptister@sf.com',
                'firstname' => 'Baptiste', 'lastname' => 'Renier',
                'password' => 'Bapt123',
            ],
            [
                'email' => 'aurelienf@sf.com',
                'firstname' => 'Aurelien', 'lastname' => 'Faure',
                'password' => 'Aurel123',
            ],
            [
                'email' => 'anthonyp@sf.com',
                'firstname' => 'Anthony', 'lastname' => 'Pham',
                'password' => 'Antho123',
            ],
            [
                'email' => 'valentini@sf.com',
                'firstname' => 'Valentin', 'lastname' => 'Inacio',
                'password' => 'Val123',
            ],
            [
                'email' => 'gwendolinen@sf.com',
                'firstname' => 'Gwendoline', 'lastname' => 'NGuon',
                'password' => 'Gwen123',
            ],
            [
                'email' => 'fredericm@sf.com',
                'firstname' => 'Frédéric', 'lastname' => 'Moutin',
                'password' => 'Fred123',
            ],
            [
                'email' => 'laetitiab@sf.com',
                'firstname' => 'Laetitia', 'lastname' => 'Biny',
                'password' => 'Laeti123',
            ],
        ];

        foreach ($usersData as $index => $userData) {
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setFirstname($userData['firstname']);
            $user->setLastname($userData['lastname']);
            $user->setRoles(['ROLE_USER']);
            $user->setResidence($this->getReference('city_' . mt_rand(1, 3)));
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $userData['password']
            );

            $user->setPassword($hashedPassword);

            $manager->persist($user);
            $this->addReference('user_' . ($index + 1), $user);
        }

        $manager->flush();
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setFirstname('Quentin');
        $admin->setLastname('Tarantino');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setResidence($this->getReference('city_' . mt_rand(1, 3)));
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'admin'
        );
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CityFixtures::class,
        ];
    }
}
