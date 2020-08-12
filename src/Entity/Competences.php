<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\CompetencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ORM\Entity(repositoryClass=CompetencesRepository::class)
 *
 *  ----------------------- VALIDATION--------------------
 * @UniqueEntity("libelle",message="Il existe déjà une compétence ayant le même libellé")
 * ---------------------------------------------------------
 *
 * ----------------------- API PLATFORM --------------------
 * @ApiResource(
 *     attributes={
 *      "security" = "is_granted('ROLE_Administrateur')",
 *      "security_message" = "Vous n'avez pas les autorisations requises"
 *     },
 *     itemOperations={
 *          "GET" = {
 *              "path" = "/admin/competences/{id}",
 *              "requirements"={"id"="\d+"},
 *          },
 *          "PUT" = {
 *              "path" = "/admin/competences/{id}",
 *              "requirements"={"id"="\d+"}
 *          },
 *          "archivage_competences" = {
 *              "method" = "PUT",
 *              "path" = "/admin/competences/{id}/archivage",
 *              "requirements"={"id"="\d+"},
 *              "controller" = App\Controller\Api\ArchivageCompetences::class
 *          }
 *     },
 *     collectionOperations={
 *          "GET" = {
 *              "path" = "/admin/competences"
 *          },
 *          "POST" = {
 *              "path" = "admin/competences"
 *          }
 *     },
 *     normalizationContext={
 *          "groups" = {"competences_read"}
 *     }
 * )
 * ---------------------------------------------------------
 *
 */
class Competences
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"competences_read", "grpecompetences_read", "tags_read", "niveaux_read","referentiel_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * ----------------------- VALIDATION --------------------
     * @Assert\NotBlank(message="Le libellé de la compétence est obligatoire")
     * @Assert\Length(
     *      min=4,
     *      max=255,
     *      minMessage="Le libellé ne doit pas être inférieur à 4 caractères",
     *      maxMessage="Le libellé ne doit pas être supérieur à 255 caractères"
     * )
     * --------------------------------------------------------
     * @Groups({"competences_read", "grpecompetences_read","tags_read", "niveaux_read","referentiel_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * ----------------------- VALIDATION --------------------
     * @Assert\NotBlank(message="Le descritif de la compétence est obligatoire")
     * @Assert\Length(
     *      min=4,
     *      max=255,
     *      minMessage="Le descriptif ne doit pas être inférieur à 4 caractères",
     *      maxMessage="Le descriptif ne doit pas être supérieur à 255 caractères"
     * )
     * --------------------------------------------------------
     * @Groups({"competences_read", "grpecompetences_read","tags_read","niveaux_read","referentiel_read"})
     */
    private $descriptif;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"competences_read","referentiel_read"})
     */
    private $archivage;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetences::class, mappedBy="competences")
     * @Groups({"competences_read"})
     */
    private $groupeCompetences;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="competences")
     */
    private $niveaux;

    /**
     * @ORM\ManyToMany(targetEntity=Referentiel::class, mappedBy="competences")
     */
    private $referentiels;


    public function __construct()
    {
        $this->groupeCompetences = new ArrayCollection();
        $this->niveaux = new ArrayCollection();
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
     * @return Collection|GroupeCompetences[]
     */
    public function getGroupeCompetences(): Collection
    {
        return $this->groupeCompetences;
    }

    public function addGroupeCompetence(GroupeCompetences $groupeCompetence): self
    {
        if (!$this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences[] = $groupeCompetence;
            $groupeCompetence->addCompetence($this);
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetences $groupeCompetence): self
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
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux[] = $niveau;
            $niveau->setCompetences($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveaux->contains($niveau)) {
            $this->niveaux->removeElement($niveau);
            // set the owning side to null (unless already changed)
            if ($niveau->getCompetences() === $this) {
                $niveau->setCompetences(null);
            }
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
            $referentiel->addCompetence($this);
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        if ($this->referentiels->contains($referentiel)) {
            $this->referentiels->removeElement($referentiel);
            $referentiel->removeCompetence($this);
        }

        return $this;
    }
}
