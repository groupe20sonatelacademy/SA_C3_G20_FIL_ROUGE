<?php

namespace App\Entity;

use App\Repository\StatistiqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatistiqueRepository::class)
 */
class Statistique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Competence::class, inversedBy="statistiques")
     */
    private $competence;

    /**
     * @ORM\ManyToOne(targetEntity=Apprenant::class, inversedBy="statistiques")
     */
    private $apprenant;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="statistiques")
     */
    private $niveaux;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompetence(): ?Competence
    {
        return $this->commetence;
    }

    public function setCompetence(?Competence $commetence): self
    {
        $this->commetence = $commetence;

        return $this;
    }

    public function getApprenant(): ?Apprenant
    {
        return $this->apprenant;
    }

    public function setApprenant(?Apprenant $apprenant): self
    {
        $this->apprenant = $apprenant;

        return $this;
    }

    public function getNiveaux(): ?Niveau
    {
        return $this->niveaux;
    }

    public function setNiveaux(?Niveau $niveaux): self
    {
        $this->niveaux = $niveaux;

        return $this;
    }
}
