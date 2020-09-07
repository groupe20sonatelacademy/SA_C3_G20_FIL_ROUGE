<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FilDiscussionRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FilDiscussionRepository::class)
 */
class FilDiscussion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="fildiscussion")
     */
    private $commentaires;

    /**
     * @ORM\OneToOne(targetEntity=LivrablePartielApprenant::class, cascade={"persist", "remove"})
     */
    private $livrablePartielApprenant;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setFildiscussion($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getFildiscussion() === $this) {
                $commentaire->setFildiscussion(null);
            }
        }

        return $this;
    }

    public function getLivrablePartielApprenant(): ?LivrablePartielApprenant
    {
        return $this->livrablePartielApprenant;
    }

    public function setLivrablePartielApprenant(?LivrablePartielApprenant $livrablePartielApprenant): self
    {
        $this->livrablePartielApprenant = $livrablePartielApprenant;

        return $this;
    }
}
