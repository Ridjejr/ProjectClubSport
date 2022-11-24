<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
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
     * @ORM\OneToMany(targetEntity=Adherent::class, mappedBy="Reservation")
     */
    private $adherents;

    /**
     * @ORM\OneToMany(targetEntity=Club::class, mappedBy="reservation")
     */
    private $Club;

    /**
     * @ORM\OneToMany(targetEntity=Coach::class, mappedBy="Reservation")
     */
    private $coaches;

    public function __construct()
    {
        $this->adherents = new ArrayCollection();
        $this->Club = new ArrayCollection();
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

    /**
     * @return Collection<int, Adherent>
     */
    public function getAdherents(): Collection
    {
        return $this->adherents;
    }

    public function addAdherent(Adherent $adherent): self
    {
        if (!$this->adherents->contains($adherent)) {
            $this->adherents[] = $adherent;
            $adherent->setReservation($this);
        }

        return $this;
    }

    public function removeAdherent(Adherent $adherent): self
    {
        if ($this->adherents->removeElement($adherent)) {
            // set the owning side to null (unless already changed)
            if ($adherent->getReservation() === $this) {
                $adherent->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Club>
     */
    public function getClub(): Collection
    {
        return $this->Club;
    }

    public function addClub(Club $club): self
    {
        if (!$this->Club->contains($club)) {
            $this->Club[] = $club;
            $club->setReservation($this);
        }

        return $this;
    }

    public function removeClub(Club $club): self
    {
        if ($this->Club->removeElement($club)) {
            // set the owning side to null (unless already changed)
            if ($club->getReservation() === $this) {
                $club->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Coach>
     */
    public function getCoaches(): Collection
    {
        return $this->coaches;
    }

    public function addCoach(Coach $coach): self
    {
        if (!$this->coaches->contains($coach)) {
            $this->coaches[] = $coach;
            $coach->setReservation($this);
        }

        return $this;
    }

    public function removeCoach(Coach $coach): self
    {
        if ($this->coaches->removeElement($coach)) {
            // set the owning side to null (unless already changed)
            if ($coach->getReservation() === $this) {
                $coach->setReservation(null);
            }
        }

        return $this;
    }
}
