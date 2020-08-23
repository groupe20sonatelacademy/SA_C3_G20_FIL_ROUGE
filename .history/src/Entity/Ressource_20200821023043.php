<?php

namespace App\Entity;

use App\Repository\RessourceRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *  routePrefix="/formateur",
 *     attributes={
 *        "pagination_enabled"=true,
 *        "pagination_items_per_page"=2    
 *         },  
 *     collectionOperations={
 *          "LIST_briefs"={
 *               "method"="GET",
 *              "path" = "/briefs",
 *              "security"="is_granted('ROLE_Formateur')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *            },       
 *         "ADD_ressource"={
 *               "method"="POST",
 *              "path" = "/ress",
 *              "security_post_denormalize"="is_granted('ROLE_Formateur')",
 *              "security_post_denormalize_message"="Vous n'avez pas access à cette Ressource"            
 *              },
 *    },
 * )
 * @ORM\Entity(repositoryClass=RessourceRepository::class)
 */
class Ressource
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pieceJointe;

    /**
     * @ORM\ManyToOne(targetEntity=Brief::class, inversedBy="ressource")
     */
    private $brief;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getPieceJointe(): ?string
    {
        return $this->pieceJointe;
    }

    public function setPieceJointe(string $pieceJointe): self
    {
        $this->pieceJointe = $pieceJointe;

        return $this;
    }

    public function getBrief(): ?Brief
    {
        return $this->brief;
    }

    public function setBrief(?Brief $brief): self
    {
        $this->brief = $brief;

        return $this;
    }
}
