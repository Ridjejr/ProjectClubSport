<?php

namespace App\Controller\Admin;

use App\Entity\Coach;
use App\Form\CoachType;
use App\Repository\CoachRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoachController extends AbstractController
{
    /**
     * @Route("/admin/coachs", name="admin_coachs", methods={"GET"})
     */
    public function listeCoachs(CoachRepository $repo)
    {
        $coach=$repo->findAll();
        return $this->render('admin/coach/listeCoachs.html.twig', [
            'lesCoachs' => $coach,
        ]);
    }

    /**
     * @Route("/admin/coach/ajout", name="admin_coach_ajout", methods={"GET","POST"})
     * @Route("/admin/coach/modif/{id}", name="admin_coach_modif", methods={"GET","POST"})
     */
    public function ajoutModifCoach(Coach $coach=null, Request $request, EntityManagerInterface $manager)
    {
        if($coach == null){
            $coach = new Coach();
            $mode="ajouté";
        }else {
            $mode="modifié";
        }
        $form = $this->createForm(CoachType::class, $coach);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() ) 
        {
                $manager->persist($coach);
                $manager->flush();
                $this->addFlash(
                    'success', "Le coach a été bien $mode"
                );
                return $this->redirectToRoute('admin_coachs');
        }
        return $this->render('admin/coach/formAjoutModifCoach.html.twig', [
            'formCoach' => $form ->createView(),
        ]);
    }

        /**
     * @Route("/admin/coach/suppression/{id}", name="admin_coach_suppression", methods={"GET"})
     */
    public function suppressionCoach(Coach $coach, EntityManagerInterface $manager)
    {
        $nbReservations=$coach->getReservations()->count();
        if($nbReservations>0){
            $this->addFlash("danger", "Vous ne pouvez pas supprimer ce coach car $nbReservations reservation(s) y sont associés ");
        }else{
        $manager->remove($coach);
        $manager->flush();
        $this->addFlash(
            'success', "Le coach a été bien été supprimé");
        }
        return $this->redirectToRoute('admin_coachs');

    }
}
