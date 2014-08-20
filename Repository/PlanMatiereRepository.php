<?php

namespace Laurent\SchoolBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Claroline\CoreBundle\Entity\User;

class PlanMatiereRepository extends EntityRepository
{
    public function findUserPlanMatiere(User $user)
    {
        $dql = 'SELECT pl
                FROM Laurent\SchoolBundle\Entity\PlanMatiere pl
                JOIN pl.prof p
                WHERE p.id = :prof
        ';

        $query = $this->_em->createQuery($dql);
        $query->setParameter('prof', $user->getId());

        return $query->getResult();
    }
}