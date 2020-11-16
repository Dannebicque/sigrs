<?php

namespace App\Entity;

use App\Repository\EnfantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnfantRepository::class)
 */
class Enfant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDeNaissance;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity=ParentEnfant::class, mappedBy="enfant",cascade={"persist"})
     */
    private $parentEnfants;

    /**
     * @ORM\OneToMany(targetEntity=Cantine::class, mappedBy="enfant")
     */
    private $cantines;

    public function __construct()
    {
        $this->parentEnfants = new ArrayCollection();
        $this->cantines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|ParentEnfant[]
     */
    public function getParentEnfants(): Collection
    {
        return $this->parentEnfants;
    }

    public function addParentEnfant(ParentEnfant $parentEnfant): self
    {
        if (!$this->parentEnfants->contains($parentEnfant)) {
            $this->parentEnfants[] = $parentEnfant;
            $parentEnfant->setEnfant($this);
        }

        return $this;
    }

    public function removeParentEnfant(ParentEnfant $parentEnfant): self
    {
        if ($this->parentEnfants->removeElement($parentEnfant)) {
            // set the owning side to null (unless already changed)
            if ($parentEnfant->getEnfant() === $this) {
                $parentEnfant->setEnfant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cantine[]
     */
    public function getCantines(): Collection
    {
        return $this->cantines;
    }

    public function addCantine(Cantine $cantine): self
    {
        if (!$this->cantines->contains($cantine)) {
            $this->cantines[] = $cantine;
            $cantine->setEnfant($this);
        }

        return $this;
    }

    public function removeCantine(Cantine $cantine): self
    {
        if ($this->cantines->removeElement($cantine)) {
            // set the owning side to null (unless already changed)
            if ($cantine->getEnfant() === $this) {
                $cantine->setEnfant(null);
            }
        }

        return $this;
    }
}
