<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Club;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClubsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       
        $faker=Factory::create("fr_FR");
        $clubs=new Club();
        $clubs  -> setId
                -> setN°rue($faker->buildingNumber())
                -> setRue($faker->streetName())
                -> setCP($faker->numberBetween(01000,95000))
                -> setVille($faker->city());
        $manager->persist($clubs);
        

        $manager->flush(); 
    }
}  
