<?php

namespace App\Entity;

use App\Repository\AnneeScolaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnneeScolaireRepository::class)
 */
class AnneeScolaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $anneeDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRentree;

    /**
     * @ORM\OneToMany(targetEntity=Vacance::class, mappedBy="anneeScolaire")
     */
    private $vacances;

    public function __construct()
    {
        $this->vacances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getAnneeDebut(): ?int
    {
        return $this->anneeDebut;
    }

    public function setAnneeDebut(int $anneeDebut): self
    {
        $this->anneeDebut = $anneeDebut;

        return $this;
    }

    public function getDateRentree(): ?\DateTimeInterface
    {
        return $this->dateRentree;
    }

    public function setDateRentree(\DateTimeInterface $dateRentree): self
    {
        $this->dateRentree = $dateRentree;

        return $this;
    }

    /**
     * @return Collection|Vacance[]
     */
    public function getVacances(): Collection
    {
        return $this->vacances;
    }

    public function addVacance(Vacance $vacance): self
    {
        if (!$this->vacances->contains($vacance)) {
            $this->vacances[] = $vacance;
            $vacance->setAnneeScolaire($this);
        }

        return $this;
    }

    public function removeVacance(Vacance $vacance): self
    {
        if ($this->vacances->removeElement($vacance)) {
            // set the owning side to null (unless already changed)
            if ($vacance->getAnneeScolaire() === $this) {
                $vacance->setAnneeScolaire(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }


}
