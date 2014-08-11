<?php

namespace Laurent\SchoolBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="laurent_school_horaire")
 */
class Horaire
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
     * @ORM\Column(type="date")
     */
    private $datevaldebut;


    /**
     * @ORM\Column(type="date")
     */
    private $datevalfin;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDatevaldebut()
    {
        return $this->datevaldebut;
    }

    /**
     * @return mixed
     */
    public function getDatevalfin()
    {
        return $this->datevalfin;
    }
}