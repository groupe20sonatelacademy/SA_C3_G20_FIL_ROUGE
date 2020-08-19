<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeCompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ------------------API PLATEFORM---------------------------
 * @ApiResource(
 *     routePrefix="/admin",
 *  attributes={
 *        "pagination_enabled"=true,
 *        "pagination_items_per_page"=2,
 *         "security"="is_granted('ROLE_Admin')",
 *         "security_message"="Vous n'avez pas l'access à cette operation",
 * 
 *       },
 *  itemOperations={
 *            "ARCHIVE_groupecompetence"={ 
 *                "method"="PUT",
 *                "path"="/groupecompetences/{id}/archivage",
 *                "controller"="App\Controller\API\ArchivageGroupeCompetenceController"
 *              }, 
 *       
 *           "VIEW_groupcompetence"={
 *               "method"="GET",
 *              "path" = "/groupecompetences/{id}",
 *              "requirements"={"id"="\d+"}
 *             },
 *       "update_groupe_competence"={
    *             "method" = "PUT",
    *             "path" = "/groupecompetences/{id}",
    *             "requirements"={"id"="\d+"},
    *             "route_name"="edition_competence_in_groupecompetence"
 *          },
 *     },
 * collectionOperations={
 *          "LIST_groupecompetences"={
 *               "method"="GET",
 *              "path" = "/groupecompetences"
 *          },
 *          "ADD_groupeCompetence"={
 *              "method" = "POST",
 *              "path" = "/groupecompetences"
 *          },
 *       "GET_competences"={
 *              "method" = "GET",
 *              "path" = "/admin/groupecompetences/competences"            
 *          },
 *     },
 *   normalizationContext={"groups"={"groupe_competence:read"}},
 * )
 * --------------------FIN----------------------------------------------------
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
     * @Groups({"groupe_competence:read"})
     * 
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"groupe_competence:read"})
     */
    private $descriptif;

    /**
     * @ORM\Column(type="integer")
     */
    private $archivage;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, inversedBy="groupeCompetences")
     * @Groups({"groupe_competence:read"})
     */
    private $competence;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, mappedBy="groupeCompetence")
     * @Groups({"groupe_competence:read"})
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity=Referentiel::class, mappedBy="groupeCompetence")
     * @Groups({"groupe_competence:read"})
     */
    private $referentiels;

    public function __construct()
    {
        $this->competence = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->referentiels = new ArrayCollection();
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
            $referentiel->addGroupeCompetence($this);
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        if ($this->referentiels->contains($referentiel)) {
            $this->referentiels->removeElement($referentiel);
            $referentiel->removeGroupeCompetence($this);
        }

        return $this;
    }
}
