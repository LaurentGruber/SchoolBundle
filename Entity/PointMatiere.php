<?php

namespace Laurent\SchoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Laurent\SchoolBundle\Repository\PointMatiereRepository")
 * @ORM\Table(name="laurent_school_point_matiere")
 */
class PointMatiere
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbPeriode;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ordre;

    /**
     * @ORM\ManyToMany(
     *      targetEntity="Laurent\SchoolBundle\Entity\ChapitrePlanMatiere",
     *      inversedBy="pointMatiere"
     * )
     * @ORM\joinTable(name="laurent_school_pointmatiere_chapitreplanmatiere")
     */
    private $chapitre;

    public function __construct()
    {
        $this->chapitre = new ArrayCollection();
    }

    /**
     * @param mixed $chapitre
     */
    public function setChapitre($chapitre)
    {
        $this->chapitre = $chapitre;
    }

    /**
     * @param ChapitrePlanMatiere $ chapitre
     */
    public function addChapitre(ChapitrePlanMatiere $chapitre)
    {
        $this->chapitre[] = $chapitre;
    }

    /**
     * @return mixed
     */
    public function getChapitre()
    {
        return $this->chapitre;
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
     * @param mixed $nbPeriode
     */
    public function setNbPeriode($nbPeriode)
    {
        $this->nbPeriode = $nbPeriode;
    }

    /**
     * @return mixed
     */
    public function getNbPeriode()
    {
        return $this->nbPeriode;
    }

    /**
     * @param mixed $ordre
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
    }

    /**
     * @return mixed
     */
    public function getOrdre()
    {
        return $this->ordre;
    }



}