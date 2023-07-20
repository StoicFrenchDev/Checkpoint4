<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cityNames = ['Mos Eisley', 'Metropolis', 'Gotham City'];

        foreach ($cityNames as $index => $cityName) {
            $city = new City();
            $city->setName($cityName);
        
            $manager->persist($city);
            $this->addReference('city_' . ($index + 1), $city);
        }


        $manager->flush();
    }
}
