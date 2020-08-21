<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamSessionRepository")
 */
class ExamSession
{
    const TYPE_DILF = 1;
    const TYPE_DELF_A1_A2 = 2;
    const TYPE_DELF_B1 = 3;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="date")
     */
    private $sessionDate;

    /**
     * @ORM\Column(type="date")
     */
    private $inscriptionMaxDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $closed;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSessionDate()
    {
        return $this->sessionDate;
    }

    /**
     * @param mixed $sessionDate
     *
     * @return self
     */
    public function setSessionDate($sessionDate)
    {
        $this->sessionDate = $sessionDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInscriptionMaxDate()
    {
        return $this->inscriptionMaxDate;
    }

    /**
     * @param mixed $inscriptionMaxDate
     *
     * @return self
     */
    public function setInscriptionMaxDate($inscriptionMaxDate)
    {
        $this->inscriptionMaxDate = $inscriptionMaxDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * @param mixed $closed
     *
     * @return self
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }
}
