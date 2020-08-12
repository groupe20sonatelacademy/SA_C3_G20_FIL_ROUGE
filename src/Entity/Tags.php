<?php

namespace App\Entity;

use App\Repository\TagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TagsRepository::class)
 *
 * ----------------------- API PLATFORM --------------------
 * @ApiResource(
 *     attributes={
 *      "security" = "is_granted('ROLE_Administrateur')",
 *      "security_message" = "Vous n'avez pas les autorisations requises"
 *     },
 *     itemOperations={
 *          "GET" = {
 *              "path" = "/admin/tags/{id}",
 *               "requirements"={"id"="\d+"}
 *          },
 *          "PUT" = {
 *              "path" = "/admin/tags/{id}",
 *              "requirements"={"id"="\d+"}
 *          },
 *          "Archivage_competence" = {
 *                "method" = "PUT",
 *                "path" = "admin/tags/{id}/archivage",
 *                "requirements"={"id"="\d+"},
 *                "controller" = App\Controller\Api\ArchivageTags::class
 *           }
 *     },
 *     collectionOperations={
 *          "GET" = {
 *              "path" = "/admin/tags"
 *          },
 *          "POST" = {
 *              "path" = "admin/tags"
 *          }
 *     },
 *     normalizationContext={
 *          "groups" = {"tags_read"}
 *     }
 * )
 * ---------------------------------------------------------
 *
 */
class Tags
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"grpecompetences_read","tags_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grpecompetences_read","tags_read","competences_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"grpecompetences_read","tags_read","competences_read"})
     */
    private $descriptif;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetences::class, mappedBy="tags")
     * @Groups({"tags_read"})
     */
    private $groupeCompetences;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archivage;

    public function __construct()
    {
        $this->groupeCompetences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getlibelle(): ?string
    {
        return $this->libelle;
    }

    public function setlibelle(string $libelle): self
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
            $groupeCompetence->addTag($this);
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetences $groupeCompetence): self
    {
        if ($this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences->removeElement($groupeCompetence);
            $groupeCompetence->removeTag($this);
        }

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
}
