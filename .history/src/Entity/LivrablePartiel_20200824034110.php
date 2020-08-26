<?php

namespace App\Entity;

use App\Repository\LivrablePartielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Entity(repositoryClass=LivrablePartielRepository::class)
 */
class LivrablePartiel
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
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="date")
     */
    private $delai;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=PromoBrief::class, inversedBy="livrablePartiels")
     */
    private $promoBrief;

    /**
     * @ORM\ManyToMany(targetEntity=Niveau::class, mappedBy="livrablePartiel")
     */
    private $niveaux;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreRendus;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreCorriges;

    /**
     * @ORM\OneToMany(targetEntity=LivrablePartielApprenant::class, mappedBy="livrablePartiel")
     */
    private $livrablePartielApprenants;

    public function __construct()
    {
        $this->niveaux = new ArrayCollection();
        $this->livrablePartielApprenants = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDelai(): ?\DateTimeInterface
    {
        return $this->delai;
    }

    public function setDelai(\DateTimeInterface $delai): self
    {
        $this->delai = $delai;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPromoBrief(): ?PromoBrief
    {
        return $this->promoBrief;
    }

    public function setPromoBrief(?PromoBrief $promoBrief): self
    {
        $this->promoBrief = $promoBrief;

        return $this;
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux[] = $niveau;
            $niveau->addLivrablePartiel($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveaux->contains($niveau)) {
            $this->niveaux->removeElement($niveau);
            $niveau->removeLivrablePartiel($this);
        }

        return $this;
    }

    public function getNombreRendus(): ?int
    {
        return $this->nombreRendus;
    }

    public function setNombreRendus(int $nombreRendus): self
    {
        $this->nombreRendus = $nombreRendus;

        return $this;
    }

    public function getNombreCorriges(): ?int
    {
        return $this->nombreCorriges;
    }

    public function setNombreCorriges(int $nombreCorriges): self
    {
        $this->nombreCorriges = $nombreCorriges;

        return $this;
    }

    /**
     * @return Collection|LivrablePartielApprenant[]
     */
    public function getLivrablePartielApprenants(): Collection
    {
        return $this->livrablePartielApprenants;
    }

    public function addLivrablePartielApprenant(LivrablePartielApprenant $livrablePartielApprenant): self
    {
        if (!$this->livrablePartielApprenants->contains($livrablePartielApprenant)) {
            $this->livrablePartielApprenants[] = $livrablePartielApprenant;
            $livrablePartielApprenant->setLivrablePartiel($this);
        }

        return $this;
    }

    public function removeLivrablePartielApprenant(LivrablePartielApprenant $livrablePartielApprenant): self
    {
        if ($this->livrablePartielApprenants->contains($livrablePartielApprenant)) {
            $this->livrablePartielApprenants->removeElement($livrablePartielApprenant);
            // set the owning side to null (unless already changed)
            if ($livrablePartielApprenant->getLivrablePartiel() === $this) {
                $livrablePartielApprenant->setLivrablePartiel(null);
            }
        }

        return $this;
    }
}
