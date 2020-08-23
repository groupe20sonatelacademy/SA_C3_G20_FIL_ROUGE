<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BriefRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * ------------------ API PLATEFORME---------------------
 * @ApiResource(
 *     routePrefix="/formateur",
 *     attributes={
 *        "pagination_enabled"=true,
 *        "pagination_items_per_page"=2    
 *         },  
 *     collectionOperations={
 *            "LIST_briefs"={
 *               "method"="GET",
 *              "path" = "/briefs",
 *              "security"="is_granted('ROLE_Formateur')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *        },
 *          "ADD_briefs"={
 *               "method"="POST",
 *              "path" = "/briefs",
 *              "security_post_denormalize"="is_granted('ROLE_Formateur')",
 *              "security_post_denormalize_message"="Vous n'avez pas access à cette Ressource"
 *              
 *              },
 *         "LIST_briefs"={
 *              "method"="GET",
 *              "path" = "/promos/{id}/groups/{id}/briefs",
 *               "requirements"={"id"="\d+"},
 *               "security"="is_granted('ROLE_Formateur')",
 *               "security_message"="Vous n'avez pas access à cette Ressource"
 *            },
 *    
 * )
 * -----------------FIN----------------------------------
 * @ORM\Entity(repositoryClass=BriefRepository::class)
 */
class Brief
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contexte;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $criterPerformance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modalitePedagogique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modaliteEvaluation;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDecheance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\Column(type="integer")
     */
    private $archivage;

    /**
     * @ORM\ManyToMany(targetEntity=LivrableAttendus::class, inversedBy="briefs")
     */
    private $livrableAttendus;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="briefs")
     */
    private $tag;

    /**
     * @ORM\OneToMany(targetEntity=Ressource::class, mappedBy="brief")
     */
    private $ressource;

    /**
     * @ORM\ManyToOne(targetEntity=Formateur::class, inversedBy="briefs")
     */
    private $formateur;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, inversedBy="briefs")
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="brief")
     */
    private $nivaux;

    /**
     * @ORM\ManyToOne(targetEntity=Referentiel::class, inversedBy="briefs")
     */
    private $referentiel;

    public function __construct()
    {
        $this->livrableAttendus = new ArrayCollection();
        $this->tag = new ArrayCollection();
        $this->ressource = new ArrayCollection();
        $this->groupe = new ArrayCollection();
        $this->nivaux = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->descriptio = $description;

        return $this;
    }

    public function getContexte(): ?string
    {
        return $this->contexte;
    }

    public function setContexte(string $contexte): self
    {
        $this->contexte = $contexte;

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

    public function getCriterPerformance(): ?string
    {
        return $this->criterPerformance;
    }

    public function setCriterPerformance(string $criterPerformance): self
    {
        $this->criterPerformance = $criterPerformance;

        return $this;
    }

    public function getModalitePedagogique(): ?string
    {
        return $this->modalitePedagogique;
    }

    public function setModalitePedagogique(string $modalitePedagogique): self
    {
        $this->modalitePedagogique = $modalitePedagogique;

        return $this;
    }

    public function getModaliteEvaluation(): ?string
    {
        return $this->modaliteEvaluation;
    }

    public function setModaliteEvaluation(string $modaliteEvaluation): self
    {
        $this->modaliteEvaluation = $modaliteEvaluation;

        return $this;
    }

    public function getDateDecheance(): ?\DateTimeInterface
    {
        return $this->dateDecheance;
    }

    public function setDateDecheance(\DateTimeInterface $dateDecheance): self
    {
        $this->dateDecheance = $dateDecheance;

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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

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
     * @return Collection|LivrableAttendus[]
     */
    public function getLivrableAttendus(): Collection
    {
        return $this->livrableAttendus;
    }

    public function addLivrableAttendu(LivrableAttendus $livrableAttendu): self
    {
        if (!$this->livrableAttendus->contains($livrableAttendu)) {
            $this->livrableAttendus[] = $livrableAttendu;
        }

        return $this;
    }

    public function removeLivrableAttendu(LivrableAttendus $livrableAttendu): self
    {
        if ($this->livrableAttendus->contains($livrableAttendu)) {
            $this->livrableAttendus->removeElement($livrableAttendu);
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tag->contains($tag)) {
            $this->tag->removeElement($tag);
        }

        return $this;
    }

    /**
     * @return Collection|Ressource[]
     */
    public function getRessource(): Collection
    {
        return $this->ressource;
    }

    public function addRessource(Ressource $ressource): self
    {
        if (!$this->ressource->contains($ressource)) {
            $this->ressource[] = $ressource;
            $ressource->setBrief($this);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): self
    {
        if ($this->ressource->contains($ressource)) {
            $this->ressource->removeElement($ressource);
            // set the owning side to null (unless already changed)
            if ($ressource->getBrief() === $this) {
                $ressource->setBrief(null);
            }
        }

        return $this;
    }

    public function getFormateur(): ?Formateur
    {
        return $this->formateur;
    }

    public function setFormateur(?Formateur $formateur): self
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe[] = $groupe;
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupe->contains($groupe)) {
            $this->groupe->removeElement($groupe);
        }

        return $this;
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNivaux(): Collection
    {
        return $this->nivaux;
    }

    public function addNivaux(Niveau $nivaux): self
    {
        if (!$this->nivaux->contains($nivaux)) {
            $this->nivaux[] = $nivaux;
            $nivaux->setBrief($this);
        }

        return $this;
    }

    public function removeNivaux(Niveau $nivaux): self
    {
        if ($this->nivaux->contains($nivaux)) {
            $this->nivaux->removeElement($nivaux);
            // set the owning side to null (unless already changed)
            if ($nivaux->getBrief() === $this) {
                $nivaux->setBrief(null);
            }
        }

        return $this;
    }

    public function getReferentiel(): ?Referentiel
    {
        return $this->referentiel;
    }

    public function setReferentiel(?Referentiel $referentiel): self
    {
        $this->referentiel = $referentiel;

        return $this;
    }

    
}
