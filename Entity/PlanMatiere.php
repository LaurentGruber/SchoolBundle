<?php

namespace Laurent\SchoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Claroline\CoreBundle\Entity\User;

/**
 * @ORM\Entity(repositoryClass="Laurent\SchoolBundle\Repository\PlanMatiereRepository")
 * @ORM\Table(name="laurent_school_plan_matiere")
 */
class PlanMatiere
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column()
     */
    private $name;

    /**
     * @ORM\ManyToMany(
     *     targetEntity="Claroline\CoreBundle\Entity\User",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     * @ORM\joinTable(name="laurent_school_planmatiere_user")
     */
    private $prof;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Laurent\SchoolBundle\Entity\Matiere",
     *      inversedBy="planMatiere"
     * )
     */
    private $matiere;

    /**
     * @ORM\Column(nullable=true)
     */
    private $refProgramme;

    /**
     * @ORM\ManyToOne(
     * targetEntity="Claroline\CoreBundle\Entity\Competence\Competence",
     * )
     */
    private $referentiel;

    /**
     * @param mixed $referentiel
     */
    public function setReferentiel($referentiel)
    {
        $this->referentiel = $referentiel;
    }

    /**
     * @return mixed
     */
    public function getReferentiel()
    {
        return $this->referentiel;
    }

    /**
     * @param mixed $refProgramme
     */
    public function setRefProgramme($refProgramme)
    {
        $this->refProgramme = $refProgramme;
    }

    /**
     * @return mixed
     */
    public function getRefProgramme()
    {
        return $this->refProgramme;
    }

    /**
     * @param mixed $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
    }

    /**
     * @return \Laurent\SchoolBundle\Entity\Matiere
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $prof
     */
    public function setProf($prof)
    {
        $this->prof = $prof;
    }

    /**
     * @param User $user
     */
    public function addProf(User $user)
    {
        $this->prof[] = $user;
    }


    /**
     * @return mixed
     */
    public function getProf()
    {
        return $this->prof;
    }



}