<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateR;

    /**
     * @ORM\Column(type="time")
     */
    private $HeureR;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateR(): ?\DateTimeInterface
    {
        return $this->dateR;
    }

    public function setDateR(\DateTimeInterface $dateR): self
    {
        $this->dateR = $dateR;

        return $this;
    }

    public function getHeureR(): ?\DateTimeInterface
    {
        return $this->HeureR;
    }

    public function setHeureR(\DateTimeInterface $HeureR): self
    {
        $this->HeureR = $HeureR;

        return $this;
    }
}
