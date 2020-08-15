<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantsRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ApprenantsRepository::class)
 * @ApiResource()
 */
class Apprenants extends User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ({"apprenants_read"})
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups ({"apprenants_read"})
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infoComplementaire;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=ProfilsDeSortie::class, inversedBy="apprenants")
     */
    protected $profilDeSortie;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="apprenants")
     */
    private $groupes;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
    }


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

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getInfoComplementaire(): ?string
    {
        return $this->infoComplementaire;
    }

    public function setInfoComplementaire(?string $infoComplementaire): self
    {
        $this->infoComplementaire = $infoComplementaire;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getProfilDeSortie(): ?ProfilsDeSortie
    {
        return $this->profilDeSortie;
    }

    public function setProfilDeSortie(?ProfilsDeSortie $profilDeSortie): self
    {
        $this->profilDeSortie = $profilDeSortie;

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addApprenant($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            $groupe->removeApprenant($this);
        }

        return $this;
    }

}
