<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentaireRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *     attributes={
 *        "security"="(is_granted('ROLE_Formateur') ||is_granted('ROLE_Apprenant'))",
 *        "security_message"="Vous n'avez pas access à cette ressource"   
 *      },
 *       collectionOperations={
 *  "addCommentaire"={
 *              "method"="POST",
 *              "path"="/formateurs/livrablePartiel/{id}/commentaires",
 *               "route_name"="sendChats"
 *             },
 *     }
 * )
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
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
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity=Formateur::class, inversedBy="commentaires")
     */
    private $formateur;

    /**
     * @ORM\ManyToOne(targetEntity=FilDiscussion::class, inversedBy="commentaires")
     */
    private $fildiscussion;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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

    public function getFildiscussion(): ?FilDiscussion
    {
        return $this->fildiscussion;
    }

    public function setFildiscussion(?FilDiscussion $fildiscussion): self
    {
        $this->fildiscussion = $fildiscussion;

        return $this;
    }
}
