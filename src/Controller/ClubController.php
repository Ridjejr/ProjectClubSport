<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
