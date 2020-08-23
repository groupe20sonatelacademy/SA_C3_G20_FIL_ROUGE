<?php

namespace App\Entity;

use App\Repository\LivrableAttendusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
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
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Brief $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
            $tag->addLivrableAttendu($this);
        }

        return $this;
    }

    public function removeTag(Brief $tag): self
    {
        if ($this->tag->contains($tag)) {
            $this->tag->removeElement($tag);
            $tag->removeLivrableAttendu($this);
        }

        return $this;
    }
}
