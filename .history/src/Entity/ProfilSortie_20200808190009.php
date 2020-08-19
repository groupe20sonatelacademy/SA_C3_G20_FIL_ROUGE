<?php

namespace App\Entity;

use App\Repository\ProfilsortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @
 * @ORM\Entity(repositoryClass=ProfilsortieRepository::class)
 */
class Profilsortie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $archivage;

    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="profilsortie")
     */
    private $Apprenant;

    public function __construct()
    {
        $this->Apprenant = new ArrayCollection();
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
     * @return Collection|Apprenant[]
     */
    public function getApprenant(): Collection
    {
        return $this->Apprenant;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->Apprenant->contains($apprenant)) {
            $this->Apprenant[] = $apprenant;
            $apprenant->setProfilsortie($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        if ($this->Apprenant->contains($apprenant)) {
            $this->Apprenant->removeElement($apprenant);
            // set the owning side to null (unless already changed)
            if ($apprenant->getProfilsortie() === $this) {
                $apprenant->setProfilsortie(null);
            }
        }

        return $this;
    }
}
