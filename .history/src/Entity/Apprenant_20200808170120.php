<?php

namespace App\Entity;

use App\Repository\ApprenantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 */
class Apprenant  extends User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $infocomplementaitre;

    /**
     * @ORM\ManyToOne(targetEntity=Profilsortie::class, inversedBy="Apprenant")
     */
    private $profilsortie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getInfocomplementaitre(): ?string
    {
        return $this->infocomplementaitre;
    }

    public function setInfocomplementaitre(string $infocomplementaitre): self
    {
        $this->infocomplementaitre = $infocomplementaitre;

        return $this;
    }

    public function getProfilsortie(): ?Profilsortie
    {
        return $this->profilsortie;
    }

    public function setProfilsortie(?Profilsortie $profilsortie): self
    {
        $this->profilsortie = $profilsortie;

        return $this;
    }
}
