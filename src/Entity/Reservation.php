<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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


    /**
     * @ORM\ManyToOne(targetEntity=Adherent::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     * Assert\Count(
     * min = "1", 
     * minMessage = "Vous devez selectionner un club")
     */
    private $adherent;

    /**
     * @ORM\ManyToOne(targetEntity=Coach::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     * Assert\Count(
     * min = "1", 
     * minMessage = "Vous devez selectionner un club")
     */
    private $coach;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="reservation")
     * @ORM\JoinColumn(nullable=false)
     * Assert\Count(
     * min = "1", 
     * minMessage = "Vous devez selectionner un club")
     */
    private $club;


    public function __construct()
    {
        $this->adherents = new ArrayCollection();
        $this->coaches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getAdherent(): ?Adherent
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherent $adherent): self
    {
        $this->adherent = $adherent;

        return $this;
    }

    public function getCoach(): ?Coach
    {
        return $this->coach;
    }

    public function setCoach(?Coach $coach): self
    {
        $this->coach = $coach;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

}
