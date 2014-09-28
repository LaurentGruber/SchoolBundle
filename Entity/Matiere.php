<?php

namespace Laurent\SchoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="laurent_school_matiere")
 */
class Matiere
{
    const DEGRE_1 = 1;
    const DEGRE_2 = 2;
    const DEGRE_3 = 3;

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

    public function getDegreTranslationKey()
    {
        switch ($this->type) {
            case self::DEGRE_1: return "degre1";
            case self::DEGRE_2: return "degre2";
            case self::DEGRE_3: return "degre3";
            default: return "error";
        }
    }

    public function getInputDegre()
    {
        switch ($this->type) {
            case self::DEGRE_1: return "degre1";
            case self::DEGRE_2: return "degre2";
            case self::DEGRE_3: return "degre3";
            default: return "error";
        }
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


}