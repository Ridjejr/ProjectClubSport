<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $N°rue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rue;

    /**
     * @ORM\Column(type="integer")
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="Club")
     */
    private $reservation;

    /**
     * @ORM\ManyToOne(targetEntity=Coach::class, inversedBy="clubs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Coach;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getN°rue(): ?int
    {
        return $this->N°rue;
    }

    public function setN°rue(int $N°rue): self
    {
        $this->N°rue = $N°rue;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getCoach(): ?Coach
    {
        return $this->Coach;
    }

    public function setCoach(?Coach $Coach): self
    {
        $this->Coach = $Coach;

        return $this;
    }
}
