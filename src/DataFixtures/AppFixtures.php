<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Club;
use App\Entity\Coach;
use App\Entity\Adherent;
use App\Entity\Entrainement;
use App\Entity\Reservation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");

        //Methode qui permet d'aller chercher les info sur les adherent grâce au fichier csv       
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
                          ->setImage('https://randomuser.me/api/portraits/'.$faker->randomElement($genres)."/".mt_rand(1,99).".jpg");
            $manager->persist($adherent);
            $this->addReference("adherent".$adherent->getId(),$adherent);

        }

        //Methode qui permet d'aller chercher les info sur les club grâce au fichier csv       
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

        //Methode qui permet d'aller chercher les info sur les coach grâce au fichier csv       
        $lesCoachs=$this->chargeFichier("coach.csv");
        foreach ($lesCoachs as $value) {
            $coach = new Coach();
            $coach       ->setId(intval($value[0]))
                         ->setNom($value[1])
                         ->setPrenom($value[2])
                         ->setImage('https://randomuser.me/api/portraits/'.$faker->randomElement($genres)."/".mt_rand(1,99).".jpg")
                         ->setClub($this->getReference("club".mt_rand(1,60)));
            $manager->persist($coach);
            $this->addReference("coach".$coach->getId(),$coach);
        }

        //Methode qui permet d'aller chercher les info sur les entrainement grâce au fichier csv
        $lesEntrainements=$this->chargeFichier("entrainement.csv");
        foreach ($lesEntrainements as $value) {
            $entrainement = new Entrainement();
            $entrainement        ->setId(intval($value[0]))
                                 ->setObjectif($value[1])
                                 ->setEquipements($value[2])
                                 ->setNiveau($value[3])
                                 ->addAdherent($this->getReference("adherent".mt_rand(2,30)))
                                 ->addAdherent($this->getReference("adherent".mt_rand(2,30)))
                                 ->addAdherent($this->getReference("adherent".mt_rand(2,30)));
            $manager->persist($entrainement);
            $this->addReference("entrainement".$entrainement->getId(),$entrainement);

        }


        //Methode qui permet d'aller chercher les info sur les reservation grâce au fichier csv
        $lesReservations=$this->chargeFichier("reservation.csv");
        foreach ($lesReservations as $value) {
        $reservation = new Reservation();
        $reservation        ->setId(intval($value[0]))
                            ->setDateR($faker->dateTimeThisCentury())
                            ->setHeureR($faker->dateTime('22:00:00','Europe/Paris'))
                            ->setAdherent($this->getReference("adherent".mt_rand(2,30)))
                            ->setCoach($this->getReference("coach".mt_rand(1,30)))
                            ->setClub($this->getReference("club".mt_rand(1,60)));
        $manager->persist($reservation);
        $this->addReference("reservation".$reservation->getId(),$reservation);

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
