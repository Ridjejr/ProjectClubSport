<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Adherent;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");

        $fichierAdherentCsv=fopen(__DIR__."/adherent.csv","r");
        while (!feof($fichierAdherentCsv)){
            $lesAdherents[]=fgetcsv($fichierAdherentCsv);
        }
        fclose($fichierAdherentCsv);

        $genres=["men","women"];
        foreach ($lesAdherents as $value) {
            $adherent=new Adherent();
            $adherent     ->setId(intval($value))
                          ->setNom($value[1])
                          ->setPrenom($value[2])
                          ->setDateNaiss($faker->dateTimeThisCentury('Y-m-d','now'))
                          ->setTelephone(intval($value[3]))
                          ->setEmail($value[4])
                          ->setN°rue(intval($value[5]))
                          ->setRue($value[6])
                          ->setCp(intval($value[7]))
                          ->setVille($value[8])
                          ->setImage('https://randomuser.me/api/portraits/'.$faker->randomElement($genres)."/".mt_rand(1,99)."jpg");
            $manager->persist($adherent);

        }
        $manager->flush();
    }
}
