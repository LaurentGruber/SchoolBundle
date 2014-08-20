<?php

namespace Laurent\SchoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Laurent\SchoolBundle\Repository\ChapitrePlanMatiereRepository")
 * @ORM\Table(name="laurent_school_chapitre_plan_matiere")
 */
class ChapitrePlanMatiere
{
    const JANVIER = 1;
    const FEVRIER = 2;
    const MARS = 3;
    const AVRIL = 4;
    const MAI= 5;
    const JUIN = 6;
    const JUILLET = 7;
    const AOUT = 8;
    const SEPTEMBRE =9;
    const OCTOBRE = 10;
    const NOVEMBRE = 11;
    const DECEMBRE = 12;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $moment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $annee;

    /**
     * @ORM\ManyToMany(
     *      targetEntity="Laurent\SchoolBundle\Entity\PointMatiere",
     *      mappedBy="chapitre"
     * )
     * @ORM\joinTable(name="laurent_school_pointmatiere_chapitreplanmatiere")
     */
    private $pointMatiere;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Laurent\SchoolBundle\Entity\PlanMatiere",
     * )
     *
     */
    private $planMatiere;

    /**
     * @param mixed $annee
     */

    public function __construct()
    {
        $this->pointMatiere = new ArrayCollection();
    }

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

    /**
     * @param PlanMatiere $planMatiere
     */
    public function setPlanMatiere(PlanMatiere $planMatiere)
    {
        $this->planMatiere = $planMatiere;
    }

    /**
     * @return mixed
     */
    public function getPlanMatiere()
    {
        return $this->planMatiere;
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
     * @param mixed $moment
     */
    public function setMoment($moment)
    {
        $this->moment = $moment;
    }

    /**
     * @return mixed
     */
    public function getMoment()
    {
        return $this->moment;
    }

    public function getMomentTranslationKey()
    {
        switch ($this->type) {
            case self::JANVIER: return "Janvier";
            case self::FEVRIER: return "Février";
            case self::MARS: return "Mars";
            case self::AVRIL: return "Avril";
            case self::MAI: return "Mai";
            case self::JUIN: return "Juin";
            case self::JUILLET: return "Juillet";
            case self::AOUT: return "Août";
            case self::SEPTEMBRE: return "Septembre";
            case self::OCTOBRE: return "Octobre";
            case self::NOVEMBRE: return "Novembre";
            case self::DECEMBRE: return "Décembre";
            default: return "error";
        }
    }

    public function getInputMoment()
    {
        switch ($this->type) {
            case self::JANVIER: return "Janvier";
            case self::FEVRIER: return "Février";
            case self::MARS: return "Mars";
            case self::AVRIL: return "Avril";
            case self::MAI: return "Mai";
            case self::JUIN: return "Juin";
            case self::JUILLET: return "Juillet";
            case self::AOUT: return "Août";
            case self::SEPTEMBRE: return "Septembre";
            case self::OCTOBRE: return "Octobre";
            case self::NOVEMBRE: return "Novembre";
            case self::DECEMBRE: return "Décembre";
            default: return "error";
        }
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
     * @param mixed $pointMatiere
     */
    public function setPointMatiere($pointMatiere)
    {
        $this->pointMatiere = $pointMatiere;
    }

    /**
     * @param PointMatiere $pm
     */
    public function addPointMatiere(PointMatiere $pm)
    {
        $this->pointMatiere[] = $pm;
    }

    /**
     * @return mixed
     */
    public function getPointMatiere()
    {
        return $this->pointMatiere;
    }


}