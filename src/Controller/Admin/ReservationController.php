<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Model\FiltreReservation;
use App\Form\FiltreReservationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    /**
     * @Route("/admin/reservations", name="admin_reservations", methods={"GET"})
     */
    public function listeReservations(ReservationRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $filtre = new FiltreReservation();
        $formFiltreReservation=$this->createForm(FiltreReservationType::class, $filtre);
        $formFiltreReservation->handleRequest($request);
        // $reservations=$paginator->paginate(
        //     $repo->listeReserationsCompletePaginee($filtre),
        //     $request->query->getInt('page', 1), /*page number*/
        //     9/*limit per page*/
        // );
        $reservations=$repo->listeReservationsCompletPaginee($filtre);
        return $this->render('Admin/reservations/listeReservations.html.twig', [
            'lesReservations' => $reservations,
            'formFiltreReservation'=>$formFiltreReservation->createView()
        ]);
    }

    /**
     * @Route("/admin/reservation/ajout", name="admin_reservation_ajout", methods={"GET","POST"})
     * @Route("/admin/reservation/modif/{id}", name="admin_reservation_modif", methods={"GET","POST"})
     */
    public function ajoutModifReservation(Reservation $reservation=null, Request $request, EntityManagerInterface $manager)
    {
        if($reservation == null){
            $reservation = new Reservation();
            $mode="ajouté";
        }else {
            $mode="modifié";
        }
        $form=$this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($reservation);
            $manager->flush();
            $this->addFlash(
               'success', "La reservation a été bien $mode"
            );
            return $this->redirectToRoute('admin_reservations');
        }
        return $this->render('admin/reservations/formAjoutModifReservation.html.twig', [
            'formReservation' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/reservation/suppression/{id}", name="admin_reservation_suppression", methods={"GET"})
     */
    public function suppressionReservation(Reservation $reservation, EntityManagerInterface $manager)
    {
        $manager->remove($reservation);
        $manager->flush();
        $this->addFlash(
            'success', "La reservation a été bien été supprimé");
        return $this->redirectToRoute('admin_reservations');

    }

}
