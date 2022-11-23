<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClubsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
        $faker=Factory::create("fr_FR");
        $clubs=new Club();
        

        $manager->flush();
    }
}
