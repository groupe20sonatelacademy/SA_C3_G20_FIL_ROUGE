<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NiveauRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
------------------------- API PLATFORM -------------------
 * @ApiResource(
 *     attributes={
 *          "security"="is_granted('ROLE_Administrateur')",
 *          "security_message"="Vous n'avez les autorisations requises"
 *     },
 *     itemOperations={
 *          "GET"={
 *               "path" = "/admin/niveaux/{id}",
 *               "requirements"={"id"="\d+"},
 *          },
 *          "PUT"={
 *              "path" = "/admin/niveaux/{id}",
 *              "requirements"={"id"="\d+"}
 *          },
 *          "Archivage_niveau" = {
 *               "method" = "PUT",
 *               "path" = "/admin/niveaux/{id}/archivage",
 *               "requirements"={"id"="\d+"},
 *               "controller" = App\Controller\Api\ArchivageNiveaux::class
 *           }
 *     },
 *     collectionOperations={
 *          "POST" = {
 *              "path" = "/admin/niveaux"
 *          },
 *          "GET" = {
 *              "path" = "/admin/niveaux"
 *          }
 *     },
 *     normalizationContext={
 *          "groups" = {
 *               "niveaux_read"
 *          }
 *     }
 * )
 * ----------------------------------------------------------
 */
class Niveau
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"niveaux_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"niveaux_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archivage;

    /**
     * @ORM\ManyToOne(targetEntity=Competences::class, inversedBy="niveaux")
     * @Groups({"niveaux_read"})
     */
    private $competences;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $critereEvaluation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $groupeActions;

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
    public function getArchivage(): ?bool
    {
        return $this->archivage;
    }

    public function setArchivage(bool $archivage): self
    {
        $this->archivage = $archivage;

        return $this;
    }

    public function getCompetences(): ?Competences
    {
        return $this->competences;
    }

    public function setCompetences(?Competences $competences): self
    {
        $this->competences = $competences;

        return $this;
    }

    public function getCritereEvaluation(): ?string
    {
        return $this->critereEvaluation;
    }

    public function setCritereEvaluation(string $critereEvaluation): self
    {
        $this->critereEvaluation = $critereEvaluation;

        return $this;
    }

    public function getGroupeActions(): ?string
    {
        return $this->groupeActions;
    }

    public function setGroupeActions(string $groupeActions): self
    {
        $this->groupeActions = $groupeActions;

        return $this;
    }
}
