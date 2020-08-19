<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * attributes={
 *        "pagination_enabled"=true,
 *        "pagination_items_per_page"=2
 *       },
 *   itemOperations={
 *        "archive_niveau"={ 
 *                "method"="PUT",
 *                "path"="/admin/niveaux/{id}/archivage",
 *                "security"="is_granted('ROLE_Admin')",
 *                "security_message"="Vous n'avez pas l'access à cette operation",
 *                "controller"=App\Controller\API\ArchivageTagController::class
 *              }, 
 *         
 *          "view_niveau"={
 *               "method"="GET",
 *              "path" = "/admin/niveaux/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *             },
 *          "edit_niveau"={
 *              "method" = "PUT",
 *              "path" = "/admin/niveaux/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource",
 *             },
 *          },
 *    collectionOperations={
 *         "list_niveau"={
 *               "method"="GET",
 *              "path" = "/admin/niveaux",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *          "add_niveau"={
 *              "method" = "POST",
 *              "path" = "/admin/niveaux",
 *              "security_post_denormalize"="is_granted('ROLE_Admin')",
 *              "security_post_denormalize_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *      },
 *   normalizationContext={"groups"={"niveau:read"}}
 * )
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 */
class Niveau
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"niveau:read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $groupeDaction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $critereDevaluation;

    /**
     * @ORM\Column(type="integer")
     */
    private $archivage;

    /**
     * @ORM\ManyToOne(targetEntity=Competence::class, inversedBy="niveau")
     */
    private $competence;


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

    public function getGroupeDaction(): ?string
    {
        return $this->groupeDaction;
    }

    public function setGroupeDaction(string $groupeDaction): self
    {
        $this->groupeDaction = $groupeDaction;

        return $this;
    }

    public function getCritereDevaluation(): ?string
    {
        return $this->critereDevaluation;
    }

    public function setCritereDevaluation(string $critereDevaluation): self
    {
        $this->critereDevaluation = $critereDevaluation;

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

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }


}