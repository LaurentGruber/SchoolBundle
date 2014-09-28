<?php

namespace Laurent\SchoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Claroline\CoreBundle\Entity\User;

/**
 * @ORM\Entity()
 * @ORM\Table(name="laurent_school_prof_matiere_classe")
 */
class ProfMatiereClasse
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Laurent\SchoolBundle\Entity\Matiere",
     * )
     */
    private $matiere;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Laurent\SchoolBundle\Entity\Classe",
     * )
     */
    private $classe;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Claroline\CoreBundle\Entity\User",
     *     cascade={"persist"}
     * )
     */
    private $prof;

    /**
     * @param mixed $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
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
     * @param mixed $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
    }

    /**
     * @return mixed
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param mixed $prof
     */
    public function setProf($prof)
    {
        $this->prof = $prof;
    }

    /**
     * @return mixed
     */
    public function getProf()
    {
        return $this->prof;
    }


}