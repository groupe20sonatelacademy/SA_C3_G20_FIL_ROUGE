<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *   attributes={
 *        "pagination_enabled"=true,
 *        "pagination_items_per_page"=2,
 *       },
 *  collectionOperations={
 *          "LIST_competences"={
 *               "method"="GET",
 *              "path" = "/admin/competences",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *          "ADD_competence"={
 *               "method"="POST",
 *              "path" = "/admin/competences",
 *              "security_post_denormalize"="is_granted('EDIT',object)",
 *              "security_post_denormalize_message"="Vous n'avez pas access à cette Ressource"
 *              
 *          },
 *     },
 *  itemOperations={         
 *            "ARCHIVE_competence"={ 
 *                "method"="PUT",
 *                "security"="is_granted('ARCHIVE',object)",
 *                "security_message"="Vous n'avez pas l'access à cette operation",
 *                "path"="/admin/competences/{id}/archivage",
 *                "controller"="App\Controller\API\ArchivageCompetenceController",
 *                 "swagger_context"={
 *                        "summary"="Archiver une competence",
 *                        "description"="Achiver le chrono d'une competence donnée"
 *                   },
 *              }, 
 * 
 *           "VIEW_competence"={
 *               "method"="GET",
 *              "path" = "/admin/competences/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('VIEW',object)",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *             },
 *          "EDIT_competence"={
 *              "method" = "PUT",
 *              "path" = "/admin/competences/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('EDIT',object)",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *     },
 * normalizationContext={"groups"={"competence:read"}}
 * )
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence:read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence:read"})
     */
    private $descriptif;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"competence:read"})
     */
    private $archivage;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, mappedBy="competence")
     * @Groups({"competence:read"})
     */
    private $groupeCompetences;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="competence")
     * @Groups({"niveau:read","competence:read",})
     */
    private $niveau;

    public function __construct()
    {
        
        $this->groupeCompetences = new ArrayCollection();
        $this->niveau = new ArrayCollection();
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
     * @return Collection|GroupeCompetence[]
     */
    public function getGroupeCompetences(): Collection
    {
        return $this->groupeCompetences;
    }

    public function addGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if (!$this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences[] = $groupeCompetence;
            $groupeCompetence->addCompetence($this);
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if ($this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences->removeElement($groupeCompetence);
            $groupeCompetence->removeCompetence($this);
        }

        return $this;
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveau(): Collection
    {
        return $this->niveau;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveau->contains($niveau)) {
            $this->niveau[] = $niveau;
            $niveau->setCompetence($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveau->contains($niveau)) {
            $this->niveau->removeElement($niveau);
            // set the owning side to null (unless already changed)
            if ($niveau->getCompetence() === $this) {
                $niveau->setCompetence(null);
            }
        }

        return $this;
    }

    
}
