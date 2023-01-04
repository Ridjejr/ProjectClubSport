<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservations", name="reservations", methods={"GET"})
     */
    public function listeReservations(ReservationRepository $repo)
    {
        $reservation=$repo->findAll();
        return $this->render('reservation/listeReservations.html.twig', [
            'lesReservations' => $reservation
        ]);
    }

        /**
     * @Route("/reservation/{id}", name="ficheReservation", methods={"GET"})
     */
    public function ficheReservation(Reservation $reservation)
    {
        return $this->render('reservation/ficheReservation.html.twig', [
            'laReservation' => $reservation
        ]);
    }
}
