<?php

use Doctrine\ORM\Mapping as ORM;


/**
 * Tbookmarks
 * @ORM\Table(name="TBookmarks")
 * @ORM\Entity
 */
class Tbookmarks
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $horainicio;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return null|string
     */
    public function getHorainicio()
    {
        return $this->horainicio;
    }

    /**
     * @param null|string $horainicio
     */
    public function setHorainicio($horainicio)
    {
        $this->horainicio = $horainicio;
    }




}