<?php

namespace App\DataFixtures;

use App\Entity\Cat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CatFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $catNames = [
            'Whiskers', 'Fluffy', 'Tiger', 'Mittens', 'Felix', 'Snowball', 'Simba', 'Luna',
            'Oreo', 'Milo', 'Chloe', 'Ginger', 'Smokey', 'Nala', 'Charlie', 'Kitty', 'Leo',
            'Oliver', 'Misty', 'Shadow', 'Coco', 'Garfield', 'Lucy', 'Bella', 'Max', 'Lily',
            'Sasha', 'Boots', 'Tigger', 'Daisy', 'Rocky', 'Angel', 'Pepper', 'Muffin', 'Jasper',
            'Pumpkin', 'Lucky', 'Princess', 'Biscuit', 'Ziggy', 'Rosie', 'Snickers', 'Midnight',
            'Casper', 'Mittens', 'Kiki', 'Gizmo', 'Missy', 'Peanut', 'Buddy', 'Patches', 'Toby'
        ];

        $breeds = [
            'Bengal', 'Chartreux', 'Maine Coon', 'Korat', 'Munchkin', 'Domestic short-hair', 'Demon'
        ];

        $gender = [
            'Male', 'Female'
        ];


        $descriptions = [
            'Best cat ever!', 'It scares me'
        ];


        for ($i = 1; $i <= 25; $i++) {
            $cat = new Cat();
            $cat->setName($catNames[array_rand($catNames)]);
            $cat->setAge(mt_rand(1, 20));
            $cat->setBreed($breeds[array_rand($breeds)]);
            $cat->setSex($gender[array_rand($gender)]);
            $cat->setDescription($descriptions[array_rand($descriptions)]);
            $cat->setOwner($this->getReference('user_' . mt_rand(1, 10)));

            $manager->persist($cat);

            $manager->flush();
        }
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
