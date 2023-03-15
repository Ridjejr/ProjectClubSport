<?php

namespace App\Controller\Admin;

use App\Entity\Adherent;
use App\Form\AdherentType;
use App\Form\FiltreAdherentType;
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
        $formFiltreAdherent=$this->createForm(FiltreAdherentType::class);
        $formFiltreAdherent->handleRequest($request);
        if ($formFiltreAdherent->isSubmitted() && $formFiltreAdherent->isValid()) { 
            // on recupère la saisie dans le formulaire du nom 
            $nom = $formFiltreAdherent->get('nom') ->getData();
        }      

        $adherent=$repo->findAll();
        return $this->render('admin/adherent/listeAdherents.html.twig', [
            'lesAdherents' => $adherent,
            'formFiltreAdherent'=>$formFiltreAdherent->createView()
        ]);
    }

    /**
     * @Route("/admin/adherent/ajout", name="admin_adherent_ajout", methods={"GET","POST"})
     * @Route("/admin/adherent/modif/{id}", name="admin_adherent_modif", methods={"GET","POST"})
     */
    public function ajoutModifAdherent(Adherent $adherent=null, Request $request, EntityManagerInterface $manager)
    {
        if($adherent == null){
            $adherent = new Adherent();
            $mode="ajouté";
        }else {
            $mode="modifié";
        }
        $form=$this->createForm(AdherentType::class, $adherent);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($adherent);
            $manager->flush();
            $this->addFlash(
               'success', "L'adherent a été bien $mode"
            );
            return $this->redirectToRoute('admin_adherents');
        }
        return $this->render('admin/adherent/formAjoutModifAdherent.html.twig', [
            'formAdherent' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/adherent/suppression/{id}", name="admin_adherent_suppression", methods={"GET"})
     */
    public function suppressionAdherent(Adherent $adherent, EntityManagerInterface $manager)
    {
        $nbReservations=$adherent->getReservations()->count();
        if($nbReservations>0){
            $this->addFlash("danger", "Vous ne pouvez pas supprimer cet adherent car $nbReservations reservation(s) y sont associés ");
        }else{
        $manager->remove($adherent);
        $manager->flush();
        $this->addFlash(
            'success', "L'adherent a été bien été supprimé");
        }
        return $this->redirectToRoute('admin_adherents');

    }


}