<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Club;
use App\Entity\Coach;
use App\Entity\Adherent;
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
            $this->addReference("adherent".$adherent->getId(),$adherent);

        }

        $lesClubs=$this->chargeFichier("club.csv");
        foreach ($lesClubs as $value) {
            $club = new Club();
            $club       ->setId(intval($value[0]))
                        ->setNumRue($value[1])
                        ->setRue($value[2])
                        ->setCp(intval($value[3]))
                        ->setVille($value[4]);
            $manager->persist($club);
            $this->addReference("club".$club->getId(),$club);
        }

        $lesCoachs=$this->chargeFichier("coach.csv");
        foreach ($lesCoachs as $value) {
            $coach = new Coach();
            $coach       ->setId(intval($value[0]))
                         ->setNom($value[1])
                         ->setPrenom($value[2])
                         ->setImage('https://randomuser.me/api/portraits/'.$faker->randomElement($genres)."/".mt_rand(1,99)."jpg")
                         ->setClub($this->getReference("club".mt_rand(1,60)));
            $manager->persist($coach);
            $this->addReference("coach".$coach->getId(),$coach);
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
