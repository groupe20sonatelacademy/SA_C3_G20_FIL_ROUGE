<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionRepository::class)
 *
 * --------------------- API PLATFORM --------------------
 * @ApiResource(
 *     itemOperations={
 *          "GET" = {
 *              "path" = "/admin/promo/{id}"
 *          }
 *     },
 *     collectionOperations={
 *          "GET" = {
 *              "path" = "/admin/promo"
 *          },
 *          "POST"={
 *              "path" = "/admin/promo"
 *          }
 *     }
 * )
 * -------------------------------------------------------
 */
class Promotion
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
    private $langue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lieuPromotion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referenceAgate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fabrique;

    /**
     * @ORM\Column(type="string")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="string")
     */
    private $dateFin;

    /**
     * @ORM\ManyToMany(targetEntity=Referentiel::class, inversedBy="promotions")
     */
    private $referentiels;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="promotion", cascade={"persist"})
     */
    private $groupes;

    public function __construct()
    {
        $this->referentiels = new ArrayCollection();
        $this->groupes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getLieuPromotion(): ?string
    {
        return $this->lieuPromotion;
    }

    public function setLieuPromotion(string $lieuPromotion): self
    {
        $this->lieuPromotion = $lieuPromotion;

        return $this;
    }

    public function getReferenceAgate(): ?string
    {
        return $this->referenceAgate;
    }

    public function setReferenceAgate(string $referenceAgate): self
    {
        $this->referenceAgate = $referenceAgate;

        return $this;
    }

    public function getFabrique(): ?string
    {
        return $this->fabrique;
    }

    public function setFabrique(string $fabrique): self
    {
        $this->fabrique = $fabrique;

        return $this;
    }

    public function getDateDebut(): ?string
    {
        return $this->dateDebut;
    }

    public function setDateDebut(string $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?string
    {
        return $this->dateFin;
    }

    public function setDateFin(string $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection|Referentiel[]
     */
    public function getReferentiels(): Collection
    {
        return $this->referentiels;
    }

    public function addReferentiel(Referentiel $referentiel): self
    {
        if (!$this->referentiels->contains($referentiel)) {
            $this->referentiels[] = $referentiel;
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        if ($this->referentiels->contains($referentiel)) {
            $this->referentiels->removeElement($referentiel);
        }

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
            $groupe->setPromotion($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            // set the owning side to null (unless already changed)
            if ($groupe->getPromotion() === $this) {
                $groupe->setPromotion(null);
            }
        }

        return $this;
    }
}
