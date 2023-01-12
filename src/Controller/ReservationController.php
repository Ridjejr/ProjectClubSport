<?php

namespace App\Controller;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    /**
     * @Route("/adherents", name="reservations", methods={"GET"})
     */
    public function listeReservations(ReservationRepository $repo)
    {
        $reservation=$repo->findAll();
        return $this->render('adherent/listeReservations.html.twig', [
            'lesReservations' => $reservation
        ]);
    }

    //     /**
    //  * @Route("/adherent/{id}", name="ficheAdherent", methods={"GET"})
    //  */
    // public function ficheAdherent(Adherent $adherent)
    // {
        
    //     return $this->render('adherent/ficheAdherent.html.twig', [
    //         'leAdherent' => $adherent
    //     ]);
    // }
}
