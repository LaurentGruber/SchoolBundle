<?php

namespace Laurent\SchoolBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Claroline\CoreBundle\Entity\User;

class ClasseRepository extends EntityRepository
{
    public function findUserClasse(User $user){
        /* ManyToMany à la place de onetomany car je ne modifie pas l'entity user du coreBundle */
        $dql ="SELECT c
         FROM Laurent\SchoolBundle\Entity\Classe c
         JOIN c.eleves e
         Where e = :userId";
        $query = $this->_em->createQuery($dql);
        $query->setParameter('userId', $user->getId());

        return $query->getResult();
    }
}