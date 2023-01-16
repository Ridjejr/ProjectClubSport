<?php

namespace App\Controller;

use App\Repository\EntrainementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntrainementController extends AbstractController
{
    /**
     * @Route("/entrainements", name="entrainements", methods={"GET"})
     */
    public function listeEntrainement(EntrainementRepository $repo)
    {
        $entrainements=$repo->findAll();
        return $this->render('entrainement/listeEntrainements.html.twig', [
            'lesEntrainements' => $entrainements
        ]);
    }

    /**
     * @Route("/entrainements/{niveau}", name="entrainement_niveau", methods={"GET"})
     */
    public function listeParNiveauEntrainement(String $niveau, EntrainementRepository $repo)
    {
        $entrainements=$repo->findBy([
            'niveau' => $niveau
        ]);
        return $this->render('entrainement/listeParNiveauEntrainements.html.twig', [
            'lesEntrainements' => $entrainements,
            'leNiveau' => $niveau
        ]);
    }
}
