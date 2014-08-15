<?php

namespace Laurent\SchoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Laurent\SchoolBundle\Repository\ClasseRepository")
 * @ORM\Table(name="laurent_school_classe")
 */
class Classe
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
    private $code;

    /**
     * @ORM\Column()
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $degre;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @var User $eleves
     *
     * @ORM\ManyToMany(
     *     targetEntity="Claroline\CoreBundle\Entity\User",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     */
    private $eleves;

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
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
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


}