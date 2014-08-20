<?php

namespace Laurent\SchoolBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Laurent\SchoolBundle\Entity\ChapitrePlanMatiere;


class PointMatiereRepository extends EntityRepository
{
    public function findChapitrePointMatiere(ChapitrePlanMatiere $chap)
    {
        $dql = 'SELECT pm
                FROM Laurent\SchoolBundle\Entity\PointMatiere pm
                JOIN pm.chapitre chap
                WHERE chap.id = :chap
        ';

        $query = $this->_em->createQuery($dql);
        $query->setParameter('chap', $chap->getId());

        return $query->getResult();
    }
}