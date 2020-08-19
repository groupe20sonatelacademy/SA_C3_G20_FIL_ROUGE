<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeCompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource(
 * attributes={
 *        "pagination_enabled"=true,
 *        "pagination_items_per_page"=2
 *       },
 *  itemOperations={
 *            "ARCHIVE_groupecompetence"={ 
 *                "method"="DELETE",
 *                "path"="/admin/groupecompetences/{id}/archivage",
 *                "security"="is_granted('ROLE_Admin')",
 *                "security_message"="Vous n'avez pas l'access à cette operation",
 *                "controller"=App\Controller\API\ArchivageGroupeCompetenceController::class
 *              }, 
 *         
 *           "view_competence"={
 *               "method"="GET",
 *              "path" = "/admin/groupecompetences/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *             },
 *          "edit_competence"={
 *              "method" = "PUT",
 *              "path" = "/admin/groupecompetences/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource",
 *          }
 *     },
 * collectionOperations={
 *          "list_competences"={
 *               "method"="GET",
 *              "path" = "/admin/groupecompetences",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *          "add_groupeCompetence"={
 *              "method" = "POST",
 *              "path" = "/admin/groupecompetences",
 *              "security_post_denormalize"="is_granted('ROLE_Admin')",
 *              "security_post_denormalize_message"="Vous n'avez pas access à cette Ressource",
 *          }
 *     }
 * )
 * @ORM\Entity(repositoryClass=GroupeCompetenceRepository::class)
 */
class GroupeCompetence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptif;

    /**
     * @ORM\Column(type="integer")
     */
    private $archivage;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, inversedBy="groupeCompetences")
     */
    private $competence;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, mappedBy="groupeCompetence")
     */
    private $tags;

    public function __construct()
    {
        $this->competence = new ArrayCollection();
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

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getArchivage(): ?int
    {
        return $this->archivage;
    }

    public function setArchivage(int $archivage): self
    {
        $this->archivage = $archivage;

        return $this;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetence(): Collection
    {
        return $this->competence;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competence->contains($competence)) {
            $this->competence[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competence->contains($competence)) {
            $this->competence->removeElement($competence);
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addGroupeCompetence($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeGroupeCompetence($this);
        }

        return $this;
    }
}
