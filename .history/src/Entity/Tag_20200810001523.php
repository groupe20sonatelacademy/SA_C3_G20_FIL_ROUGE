<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource(
 * eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1OTcwMTA3MTksImV4cCI6MTU5NzAxNDMxOSwicm9sZXMiOlsiUk9MRV9BZG1pbiJdLCJ1c2VybmFtZSI6ImNkdXJhbmQifQ.szIw5Digyzrd1Kba-TpPXQ9hR0U5TSBe7MuYC9dnyxW72AbObo_NtcBJuiP3sigKG8VvEr2rEpLgrKy9PWbTvsQhMxf_Kv228U5NHn5b1QoCr7qLx3JFAFmhG6c0nrvoke3mDUn2NyZhTgttpS1vt0PIrrWkbgbgG3bvsEsRn9a44yrhy-NPEFRs-3pqG-UCtjFtTFi_coV8hPUUDNLxv44r2N4uxIS4yvvbdbOnh32QWt2eOEpq7MBdwxE7G0ByRMurl-wdL-Hcgj8x_yuTMOcKc42-lXe8H9KuhTUFDtrliXYbdLHv3hhneJJ2Pn4BWvbjcxwTRZRDjAkkRweE3ihkgXSy1ML7Jb8qudr8sBrUdhSH_pP0O_Mpx2oJbMrhQQ2GI_tr8lP6Xht7hj2CLv2JZi4YjapY6yCVw3cdsr50y-THeTsTGqMMaDyKnaA0T8bbg8742L9axxl8JC5Bvg8SvM89dCZA4lAmobs2WQ8hEPGOp6Sv8G-gHsGdaKJgtd51smZ0NfWke0re1Y_UyVm_x6NVVSRMk7JWo1RgAYHcnkuIhsSdu-sP0krov2IABfkTtMT8B2UqwuFPFQZsfISQENxXaJq0IKdRVZRC2ieoTVrmnWymUS4YYWPRKFOI_4JCiU4QYyQdGmVaCQc_7lFaAGev09zKuVPcnudbtjA
 * )
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptif;

    /**
     * @ORM\Column(type="integer")
     */
    private $archivage;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, inversedBy="tags")
     */
    private $groupeCompetence;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeTag::class, mappedBy="tag")
     */
    private $groupeTags;

    public function __construct()
    {
        $this->groupeCompetence = new ArrayCollection();
        $this->groupeTags = new ArrayCollection();
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

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

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
     * @return Collection|GroupeCompetence[]
     */
    public function getGroupeCompetence(): Collection
    {
        return $this->groupeCompetence;
    }

    public function addGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if (!$this->groupeCompetence->contains($groupeCompetence)) {
            $this->groupeCompetence[] = $groupeCompetence;
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if ($this->groupeCompetence->contains($groupeCompetence)) {
            $this->groupeCompetence->removeElement($groupeCompetence);
        }

        return $this;
    }

    /**
     * @return Collection|GroupeTag[]
     */
    public function getGroupeTags(): Collection
    {
        return $this->groupeTags;
    }

    public function addGroupeTag(GroupeTag $groupeTag): self
    {
        if (!$this->groupeTags->contains($groupeTag)) {
            $this->groupeTags[] = $groupeTag;
            $groupeTag->addTag($this);
        }

        return $this;
    }

    public function removeGroupeTag(GroupeTag $groupeTag): self
    {
        if ($this->groupeTags->contains($groupeTag)) {
            $this->groupeTags->removeElement($groupeTag);
            $groupeTag->removeTag($this);
        }

        return $this;
    }
}
