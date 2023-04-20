<?php

namespace App\Model;
use App\Entity\Club;
// use App\Entity\Coach;
// use App\Model\FiltreReservation;
use Symfony\Component\Validator\Constraints as Assert;


class FiltreReservation{
   /** Assert\Count(
    * min = "2", 
    * minMessage = "Le nom de l'adherent doit comporter au minimum {{ limit }} caractères",)
    */
    public $nom;

    public $club;

    public $coachs;
}