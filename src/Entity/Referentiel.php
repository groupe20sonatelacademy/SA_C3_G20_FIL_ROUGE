<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReferentielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReferentielRepository::class)
 *
 * ----------------------- API PLATFORM -------------------
 * @ApiResource(
 *
 *     itemOperations={
 *          "GET" = {
 *               "path" = "/admin/referentiels/{id}",
 *               "requirements"={"id"="\d+"}
 *          },
 *          "PUT" = {
 *               "path" = "/admin/referentiels/{id}",
 *               "requirements"={"id"="\d+"}
 *          },
 *          "archivage_referentiel" = {
 *               "method" = "PUT",
 *               "path" = "/admin/referentiels/{id}/archivage",
 *               "requirements"={"id"="\d+"},
 *               "controller" = App\Controller\Api\ArchivageReferentiel::class
 *          }
 *     },
 *     collectionOperations={
 *           "GET" = {
 *              "path" = "/admin/referentiels"
 *           },
 *          "POST" = {
 *              "path" = "/admin/referentiels"
 *          }
 *     },
 *     normalizationContext={
 *          "groups" = {"referentiel_read"}
 *     }
 * )
 * --------------------------------------------------------
 */
class Referentiel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("referentiel_read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("referentiel_read")
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     * @Groups("referentiel_read")
     */
    private $presentation;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("referentiel_read")
     */
    private $competencesVisees;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("referentiel_read")
     */
    private $programme;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("referentiel_read")
     */
    private $critereEvaluation;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("referentiel_read")
     */
    private $critereAdmission;

    /**
     * @ORM\ManyToMany(targetEntity=Competences::class, inversedBy="referentiels")
     * @Groups("referentiel_read")
     */
    private $competences;

    /**
     * @ORM\ManyToMany(targetEntity=Promotion::class, mappedBy="referentiels")
     */
    private $promotions;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->promotions = new ArrayCollection();
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

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getCompetencesVisees(): ?string
    {
        return $this->competencesVisees;
    }

    public function setCompetencesVisees(?string $competencesVisees): self
    {
        $this->competencesVisees = $competencesVisees;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(?string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getCritereEvaluation(): ?string
    {
        return $this->critereEvaluation;
    }

    public function setCritereEvaluation(?string $critereEvaluation): self
    {
        $this->critereEvaluation = $critereEvaluation;

        return $this;
    }

    public function getCritereAdmission(): ?string
    {
        return $this->critereAdmission;
    }

    public function setCritereAdmission(?string $critereAdmission): self
    {
        $this->critereAdmission = $critereAdmission;

        return $this;
    }

    /**
     * @return Collection|Competences[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competences $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): self
    {
        if ($this->competences->contains($competence)) {
            $this->competences->removeElement($competence);
        }

        return $this;
    }

    /**
     * @return Collection|Promotion[]
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotion $promotion): self
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions[] = $promotion;
            $promotion->addReferentiel($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotions->contains($promotion)) {
            $this->promotions->removeElement($promotion);
            $promotion->removeReferentiel($this);
        }

        return $this;
    }
}
