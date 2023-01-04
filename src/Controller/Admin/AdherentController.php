<?php

namespace App\Controller\Admin;

use App\Entity\Adherent;
use App\Form\AdherentType;
use App\Repository\AdherentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdherentController extends AbstractController
{
    /**
     * @Route("/admin/adherents", name="admin_adherents", methods={"GET"})
     */
    public function listeAdherents(AdherentRepository $repo,  PaginatorInterface $paginator, Request $request)
    {
        // $adherent = $paginator->paginate(
        //     $request->query->getInt('page', 1), /*page number*/
        //     9 /*limit per page*/
        // );
        $adherent=$repo->findAll();
        return $this->render('admin/adherent/listeAdherents.html.twig', [
            'lesAdherents' => $adherent
        ]);
    }

    /**
     * @Route("/admin/adherent/ajout", name="admin_adherent_ajout", methods={"GET","POST"})
     */
    public function ajoutAdherent(Request $request, EntityManagerInterface $manager)
    {
        $adherent= new Adherent();
        $form=$this->createForm(AdherentType::class, $adherent);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($adherent);
            $manager->flush();
            return $this->redirectToRoute('admin_adherents');
        }
        return $this->render('admin/adherent/formAjoutAdherent.html.twig', [
            'formAdherent' => $form->createView()
        ]);
    }
}
