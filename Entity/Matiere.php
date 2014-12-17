<?php

namespace Laurent\SchoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="laurent_school_matiere")
 */
class Matiere
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
     * @ORM\Column()
     */
    private $officialName;

    /**
     * @ORM\Column()
     */
    private $viewName;

    /**
     * @ORM\Column(type="integer")
     */
    private $degre;

    /**
     * @ORM\Column(nullable=true)
     */
    private $annee;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPeriode;

    /**
     * @ORM\OneToMany(
     *      targetEntity="Laurent\SchoolBundle\Entity\PlanMatiere",
     *      mappedBy="matiere"
     * )
     */
    private $planMatiere;

    /**
     * @ORM\Column()
     */
    private $color;

    /**
     * @param mixed $planMatiere
     */
    public function setPlanMatiere($planMatiere)
    {
        $this->planMatiere = $planMatiere;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlanMatiere()
    {
        return $this->planMatiere;
    }

     /**
     * @param mixed $degre
     */
    public function setDegre($degre)
    {
        $this->degre = $degre;
    }

    /**
     * @return mixed
     */
    public function getDegre()
    {
        return $this->degre;
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
     * @param mixed $officialName
     */
    public function setOfficialName($officialName)
    {
        $this->officialName = $officialName;
    }

    /**
     * @return mixed
     */
    public function getOfficialName()
    {
        return $this->officialName;
    }

    /**
     * @param mixed $viewName
     */
    public function setViewName($viewName)
    {
        $this->viewName = $viewName;
    }

    /**
     * @return mixed
     */
    public function getViewName()
    {
        return $this->viewName;
    }

    /**
     * @param mixed $annee
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

    /**
     * @return mixed
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    public function __toString()
    {
        return (string) $this->getOfficialName();
    }

}