<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 * )
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 */
class Apprenant  extends User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank( message="L'adresse est obligatoire")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank( message="Le statut est obligatoire")
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank( message="La categorie est obligatoire")
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank( message="Les infos complementaires  sont obligatoire")
     */
    private $infocomplementaitre;

    /**
     * @ORM\ManyToOne(targetEntity=Profilsortie::class, inversedBy="Apprenant")
     * 
     * @ApiSubresource()
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
