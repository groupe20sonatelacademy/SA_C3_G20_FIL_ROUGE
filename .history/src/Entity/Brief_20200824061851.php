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
 * routePrefix="/formateurs",
 *     attributes={
 *        "pagination_enabled"=true,
 *        "pagination_items_per_page"=2 ,
 *         "security"="is_granted('ROLE_Formateur')",
 *         "security_message"="Vous n'avez pas access à cette Ressource"   
 *         },  
 *     collectionOperations={
 *         "getBrief"={ 
 *             "method"="Get",
 *              "path" = "/briefs",
 *              "route_name"="getBrief"
 *            },  
 *       
 *          "getBriefGroupeInPromo"={
 *                   "method" = "GET",
 *                   "requirements"={"id"="\d+"},
 *                   "path" ="/promos/{id_promo}/groupes/{id_groupe}/briefs",
 *                   "route_name"="getBriefGroupeInPromo"
 *                   
 *                },  
 *       "getBriefBrouillon"={
 *                   "method" = "GET",
 *                   "requirements"={"id"="\d+"},
 *                   "path" ="/{id}/briefs/brouillons",
 *                   "route_name"="getBriefBrouillon"   
 *                },
 *       "getBriefValide"={
 *                   "method" = "GET",
 *                  "requirements"={"id"="\d+"},
 *                   "path" ="/{id}/briefs/valides",
 *                   "route_name"="getBriefValide"
 *                  
 *                },
 * 
 *        "getPromoBrief"={
 *                   "method" = "GET",
 *                  "requirements"={"id"="\d+"},
 *                   "path" ="/promos/{id}/briefs",
 *                   "route_name"="getPromoBrief"
 *                },
 * 
 *        "getBriefInPromo"={
 *                   "method" = "GET",
 *                  "requirements"={"id"="\d+"},
 *                   "path" ="/promos/{id_promo}/briefs/{id_brief}",
 *                   "route_name"="getBriefInPromo"
 *                },
 * 
 *    },
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
     * @groups({"brief:read","brouillon:read","valide:read" ,"promo:read","briefGroupe:read"})
     */
    private $langue;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $contexte;

    /**
     * @ORM\Column(type="date")
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $criterPerformance;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $modalitePedagogique;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $modaliteEvaluation;

    /**
     * @ORM\Column(type="date")
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $dateDecheance;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $photo;

    /**
     * @ORM\Column(type="integer")
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $archivage;

    /**
     * @ORM\ManyToMany(targetEntity=LivrableAttendus::class, inversedBy="briefs")
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $livrableAttendus;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="briefs")
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $tag;

    /**
     * @ORM\OneToMany(targetEntity=Ressource::class, mappedBy="brief")
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $ressource;

    /**
     * @ORM\ManyToOne(targetEntity=Formateur::class, inversedBy="briefs")
     * @groups({"promo:read","briefGroupe:read"})
     */
    private $formateur;


    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="brief")
     * @groups({"brief:read","brouillon:read","valide:read","promo:read","briefGroupe:read"})
     */
    private $nivaux;

    /**
     * @ORM\ManyToOne(targetEntity=Referentiel::class, inversedBy="briefs")
     * @groups({"promo:read","briefGroupe:read"})
     */
    private $referentiel;

    /**
     * @ORM\OneToMany(targetEntity=PromoBrief::class, mappedBy="brief")
     * @groups({"promo:read","briefGroupe:read"})
     */
    private $promoBriefs;

    /**
     * @ORM\OneToMany(targetEntity=EtatBriefGroupe::class, mappedBy="brief")
     * @groups({"briefGroupe:read","groupe:read"})
     */
    private $etatBriefGroupes;

    public function __construct()
    {
        $this->livrableAttendus = new ArrayCollection();
        $this->tag = new ArrayCollection();
        $this->ressource = new ArrayCollection();
        $this->nivaux = new ArrayCollection();
        $this->promoBriefs = new ArrayCollection();
        $this->etatBriefGroupes = new ArrayCollection();
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
        $this->description = $description;

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

    /**
     * @return Collection|PromoBrief[]
     */
    public function getPromoBriefs(): Collection
    {
        return $this->promoBriefs;
    }

    public function addPromoBrief(PromoBrief $promoBrief): self
    {
        if (!$this->promoBriefs->contains($promoBrief)) {
            $this->promoBriefs[] = $promoBrief;
            $promoBrief->setBrief($this);
        }

        return $this;
    }

    public function removePromoBrief(PromoBrief $promoBrief): self
    {
        if ($this->promoBriefs->contains($promoBrief)) {
            $this->promoBriefs->removeElement($promoBrief);
            // set the owning side to null (unless already changed)
            if ($promoBrief->getBrief() === $this) {
                $promoBrief->setBrief(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EtatBriefGroupe[]
     */
    public function getEtatBriefGroupes(): Collection
    {
        return $this->etatBriefGroupes;
    }

    public function addEtatBriefGroupe(EtatBriefGroupe $etatBriefGroupe): self
    {
        if (!$this->etatBriefGroupes->contains($etatBriefGroupe)) {
            $this->etatBriefGroupes[] = $etatBriefGroupe;
            $etatBriefGroupe->setBrief($this);
        }

        return $this;
    }

    public function removeEtatBriefGroupe(EtatBriefGroupe $etatBriefGroupe): self
    {
        if ($this->etatBriefGroupes->contains($etatBriefGroupe)) {
            $this->etatBriefGroupes->removeElement($etatBriefGroupe);
            // set the owning side to null (unless already changed)
            if ($etatBriefGroupe->getBrief() === $this) {
                $etatBriefGroupe->setBrief(null);
            }
        }

        return $this;
    }
}
