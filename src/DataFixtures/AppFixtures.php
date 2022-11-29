<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Adherent;
use App\Entity\Coach;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");

        $lesAdherents=$this->chargeFichier("adherent.csv");

        $genres=["men","women"];
        foreach ($lesAdherents as $value) {
            $adherent=new Adherent();
            $adherent     ->setId(intval($value[0]))
                          ->setNom($value[1])
                          ->setPrenom($value[2])
                          ->setDateNaiss($faker->dateTimeThisCentury())
                          ->setTelephone(intval($value[3]))
                          ->setEmail($value[4])
                          ->setNumRue(intval($value[5]))
                          ->setRue($value[6])
                          ->setCp(intval($value[7]))
                          ->setVille($value[8])
                          ->setImage('https://randomuser.me/api/portraits/'.$faker->randomElement($genres)."/".mt_rand(1,99)."jpg");
            $manager->persist($adherent);
            //$this->addReference("adherent".$adherent->getId(),

        }

        $lesCoachs=$this->chargeFichier("coach.csv");
        foreach ($lesCoachs as $value) {
            $coach = new Coach();
            $coach       ->setId(intval($value[0]))
                         ->setNom($value[1])
                         ->setPrenom($value[2])
                         ->setImage('https://randomuser.me/api/portraits/'.$faker->randomElement($genres)."/".mt_rand(1,99)."jpg");
            $manager->persist($coach);
        }
        $manager->flush();
    }

    public function chargeFichier($fichier){
        $fichierCsv=fopen(__DIR__."/".$fichier,"r");
        while (!feof($fichierCsv)){
            $data[]=fgetcsv($fichierCsv);
        }
        fclose($fichierCsv);
        return $data;
    }
}
