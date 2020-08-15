<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use App\Repository\GroupeCompetencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ORM\Entity(repositoryClass=GroupeCompetencesRepository::class)
 *
 * ---------------------- API PLATFORM --------------------------
 * @ApiResource (
 *     routePrefix="/admin",
 *     attributes={
 *      "security" = "is_granted('ROLE_Administrateur')",
 *      "security_message" = "Vous n'avez pas les autorisations requises"
 *     },
 *     itemOperations={
 *          "GET" = {
 *              "requirements"={"id"="\d+"}
 *          },
 *          "Archivage_competence" = {
 *                "method" = "PUT",
 *                "path" = "/groupe_competences/{id}/archivage",
 *                "requirements"={"id"="\d+"},
 *                "controller" = App\Controller\Api\ArchivageGrpeCompetences::class
 *           },
 *           "update_groupe_competence" = {
 *                  "method" = "PUT",
 *                  "path" = "/groupe_competences/{id}",
 *                  "requirements"={"id"="\d+"},
 *                  "route_name" = "edition_competence_in_grpe_competence"
 *          }
 *     },
 *     collectionOperations={
 *          "GET" = {},
 *          "POST" = {}
 *     },
 *     normalizationContext={
 *          "groups" = {
 *              "grpecompetences_read"
 *          }
 *     }
 * )
 * --------------------------------------------------------------
 *
 * ---------------------- VALIDATION-----------------------------
 * @UniqueEntity("libelle",message="Il existe déjà un groupe de compétence ayant le même libelle")
 * --------------------------------------------------------------
 */
class GroupeCompetences
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"grpecompetences_read","tags_read","competence_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grpecompetences_read","tags_read","competence_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"grpecompetences_read","tags_read","competence_read"})
     */
    private $descriptif;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archivage;

    /**
     * @ORM\ManyToMany(targetEntity=Competences::class, inversedBy="groupeCompetences", cascade={"persist"})
     * @Groups({"grpecompetences_read","tags_read"})
     * @ApiSubresource
     */
    private $competences;

    /**
     * @ORM\ManyToMany(targetEntity=Tags::class, inversedBy="groupeCompetences")
     *  @Groups({"grpecompetences_read","competences_read"})
     */
    private $tags;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->tags = new ArrayCollection();
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

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(?string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getArchivage(): ?bool
    {
        return $this->archivage;
    }

    public function setArchivage(bool $archivage): self
    {
        $this->archivage = $archivage;

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
     * @return Collection|Tags[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }
}
