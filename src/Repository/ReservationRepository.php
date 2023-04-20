<?php

namespace App\Repository;

use App\Entity\Reservation;
use App\Model\FiltreReservation;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Reservation>
 *
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function add(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    */
   public function listeReservationsCompletPaginee(FiltreReservation $filtre=null)
   {
    $query =$this->createQueryBuilder('r')
           ->select('r','adh','coa','clu')
           ->Join('r.adherent', 'adh')
           ->Join('r.coach', 'coa')
           ->Join('r.club', 'clu')
           ->orderBy('clu.ville', 'ASC');
            if (!empty($filtre->nom)) {
                $query->andWhere('adh.nom like :nomcherche')
                ->setParameter('nomcherche', "%{$filtre->nom}%");
            }
            if (!empty($filtre->club)) {
                $query->andWhere('r.club = :clubcherche')
                ->setParameter('clubcherche', $filtre->club);
            }
            if (!empty($filtre->coachs)) {
                $query->andWhere('r.coach = :coachcherche')
                ->setParameter('coachcherche', $filtre->coachs);
            }
            // if (!empty($filtre->coachs) && $filtre->coachs->count()>0) {
            //     $conditions=[];
            //     foreach ($filtre->coachs as $key => $coach) {
            //         $conditions[] = $query->where("r.coach=coachRecherche$key");
            //         $query->setParameter("coachRecherche$key", $coach);
            //     }
            //     $blocConditionsOr=$query->expr()->orX()->addMultiple($conditions);
            //     $query->andWhere($blocConditionsOr);
            //     // foreach ($filtre->coachs as $key => $coach) {
            //     //     $query->andWhere($query->expr()->orX(
            //     //         $query->expr()->eq('r.coach',$coach)
                        
            //     //     ));
            // }
        ;

       return $query->getQuery()->getResult();
   }

}