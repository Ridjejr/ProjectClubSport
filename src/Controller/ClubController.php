<?php

namespace App\Controller;

use App\Entity\Club;
use App\Repository\ClubRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClubController extends AbstractController
{
    /**
     * @Route("/clubs", name="clubs", methods={"GET"})
     */
    public function listeClubs(ClubRepository $repo)
    {
        $clubs=$repo->findAll();
        return $this->render('club/listeClubs.html.twig',[
          'lesClubs' => $clubs  
        ]);
    }

            /**
     * @Route("/club/{id}", name="ficheClub", methods={"GET"})
     */
    public function ficheClub(Club $club)
    {
        return $this->render('club/ficheClub.html.twig', [
            'leClub' => $club
        ]);
    }
}
