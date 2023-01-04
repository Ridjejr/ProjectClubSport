<?php

namespace App\Entity;

use App\Repository\EntrainementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrainementRepository::class)
 */
class Entrainement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $objectif;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $equipements;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveau;

    /**
     * @ORM\ManyToMany(targetEntity=Adherent::class, inversedBy="entrainements")
     */
    private $Adherent;

    public function __construct()
    {
        $this->Adherent = new ArrayCollection();
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

    public function getObjectif(): ?string
    {
        return $this->objectif;
    }

    public function setObjectif(string $objectif): self
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getEquipements(): ?string
    {
        return $this->equipements;
    }

    public function setEquipements(string $equipements): self
    {
        $this->equipements = $equipements;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, Adherent>
     */
    public function getAdherent(): Collection
    {
        return $this->Adherent;
    }

    public function addAdherent(Adherent $adherent): self
    {
        if (!$this->Adherent->contains($adherent)) {
            $this->Adherent[] = $adherent;
        }

        return $this;
    }

    public function removeAdherent(Adherent $adherent): self
    {
        $this->Adherent->removeElement($adherent);

        return $this;
    }
}
