<?php

namespace App\Controller;

use App\Entity\Club;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClubController extends AbstractController
{
    /**
     * @Route("/club", name="ficheClub")
     */
    public function ficheClub(Club $club)
    {
        return $this->render('club/ficheClub.html.twig',[
          'leClub' => $club  ]);
    }
}
