<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClubRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $NumRue;

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
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="club")
     */
    private $reservation;

    /**
     * @ORM\OneToMany(targetEntity=Coach::class, mappedBy="club")
     */
    private $club;

    public function __construct()
    {
        $this->reservation = new ArrayCollection();
        $this->club = new ArrayCollection();
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

    public function getNumRue(): ?int
    {
        return $this->NumRue;
    }

    public function setNumRue(int $NumRue): self
    {
        $this->NumRue = $NumRue;

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


    /**
     * @return Collection<int, Reservation>
     */
    public function getReservation(): Collection
    {
        return $this->reservation;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservation->contains($reservation)) {
            $this->reservation[] = $reservation;
            $reservation->setClub($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservation->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getClub() === $this) {
                $reservation->setClub(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Coach>
     */
    public function getClub(): Collection
    {
        return $this->club;
    }

    public function addClub(Coach $club): self
    {
        if (!$this->club->contains($club)) {
            $this->club[] = $club;
            $club->setClub($this);
        }

        return $this;
    }

    public function removeClub(Coach $club): self
    {
        if ($this->club->removeElement($club)) {
            // set the owning side to null (unless already changed)
            if ($club->getClub() === $this) {
                $club->setClub(null);
            }
        }

        return $this;
    }

    public function getAdressComplete(): ?string
    {
        return $this->NumRue ." ". "rue" ." ". $this->Rue;
    }

}
