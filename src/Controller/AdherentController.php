<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Repository\AdherentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdherentController extends AbstractController
{
    /**
     * @Route("/adherents", name="adherents", methods={"GET"})
     */
    public function listeAdherents(AdherentRepository $repo)
    {
        $adherent=$repo->findAll();
        return $this->render('adherent/listeAdherents.html.twig', [
            'lesAdherents' => $adherent
        ]);
    }

        /**
     * @Route("/adherent/{id}", name="ficheAdherent", methods={"GET"})
     */
    public function ficheAdherent(Adherent $adherent)
    {
        return $this->render('adherent/ficheAdherent.html.twig', [
            'leAdherent' => $adherent
        ]);
    }
}
