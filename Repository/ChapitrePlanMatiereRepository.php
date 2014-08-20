<?php

namespace Laurent\SchoolBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Laurent\SchoolBundle\Entity\PlanMatiere;


class ChapitrePlanMatiereRepository extends EntityRepository
{
    public function findChapitrePlanMatiere(PlanMatiere $planMatiere)
    {
        $dql = 'SELECT chap
                FROM Laurent\SchoolBundle\Entity\ChapitrePlanMatiere chap
                JOIN chap.planMatiere pl
                WHERE pl.id = :pl
        ';

        $query = $this->_em->createQuery($dql);
        $query->setParameter('pl', $planMatiere->getId());

        return $query->getResult();
    }
}