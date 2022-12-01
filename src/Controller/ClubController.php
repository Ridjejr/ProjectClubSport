<?php

namespace App\Controller;

use App\Entity\Club;
use App\Repository\ClubRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClubController extends AbstractController
{
    /**
     * @Route("/clubs", name="clubs", methodes={GET})
     */
    public function listeClubs(ClubRepository $repo)
    {
        $clubs=$repo->findAll();
        return $this->render('club/listeClubs.html.twig',[
          'lesClubs' => $clubs  ]);
    }
}
