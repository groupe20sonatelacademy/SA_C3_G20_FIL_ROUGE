<?php

namespace App\Entity;

use App\Repository\LivrableAttendusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

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
 *         "ADD_briefs"={
 *               "method"="POST",
 *              "path" = "/briefs",
 *              "security_post_denormalize"="is_granted('ROLE_Formateur')",
 *              "security_post_denormalize_message"="Vous n'avez pas access à cette Ressource"            
 *              },
 *        
 *    },
 * )
 * @ORM\Entity(repositoryClass=LivrableAttendusRepository::class)
 */
class LivrableAttendus
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
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Brief::class, mappedBy="livrableAttendus")
     */
    private $briefs;

    public function __construct()
    {
        $this->briefs = new ArrayCollection();
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

    /**
     * @return Collection|Brief[]
     */
    public function getBriefs(): Collection
    {
        return $this->briefs;
    }

    public function addBrief(Brief $brief): self
    {
        if (!$this->briefs->contains($brief)) {
            $this->briefs[] = $brief;
            $brief->addLivrableAttendu($this);
        }

        return $this;
    }

    public function removeBrief(Brief $brief): self
    {
        if ($this->briefs->contains($brief)) {
            $this->briefs->removeElement($brief);
            $brief->removeLivrableAttendu($this);
        }

        return $this;
    }

}
