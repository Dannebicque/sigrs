<?php

namespace App\Entity;

use App\Repository\CantineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CantineRepository::class)
 */
class Cantine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Enfant::class, inversedBy="cantines")
     */
    private $enfant;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRepas;

    /**
     * @ORM\Column(type="boolean")
     */
    private $repasPris = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnfant(): ?Enfant
    {
        return $this->enfant;
    }

    public function setEnfant(?Enfant $enfant): self
    {
        $this->enfant = $enfant;

        return $this;
    }

    public function getDateRepas(): ?\DateTimeInterface
    {
        return $this->dateRepas;
    }

    public function setDateRepas(\DateTimeInterface $dateRepas): self
    {
        $this->dateRepas = $dateRepas;

        return $this;
    }

    public function getRepasPris(): ?bool
    {
        return $this->repasPris;
    }

    public function setRepasPris(bool $repasPris): self
    {
        $this->repasPris = $repasPris;

        return $this;
    }
}
