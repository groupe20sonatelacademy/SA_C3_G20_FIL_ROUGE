<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  attributes={
 *          "pagination_enabled"=true,
 *           "pagination_items_per_page"=2,          
 *         },
 *  itemOperations={
 *        "ARCHIVE_formateur"={
 *          "method"="PUT",
 *          "path"="/admin/formateurs/{id}/archivage",
 *          "controller"="App\Controller\API\ArchivageApprenantController",
 *           "security"="is_granted('ROLE_Admin')",
 *           "security_message"="Vous n'avez pas access à cette ressource"
 *        },
 *       "EDIT_formateur"={
 *              "method"="PUT",
 *              "path"="/admin/formateurs/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },  
 *        "SET_apprenant"={
 *              "method"="GET",
 *              "path"="/admin/formateurs/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          }, 
 *      },
 *  collectionOperations={
 *          "ADD_formateur"={
 *              "method"="POST",
 *              "path"="/admin/formateurs",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *          "LIST_formateur"={
 *              "method"="GET",
 *              "path"="/admin/formateurs",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *     },
 * normalizationContext={"groups"={"formateur:read"}}
 * )
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 */
class Formateur extends User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="formateur")
     * @Groups({"formateur:read"})
     */
    private $groupes;

    /**
     * @ORM\ManyToMany(targetEntity=Promo::class, mappedBy="formateur")
     * @Groups({"formateur:read"})
     */
    private $promos;

    /**
     * @ORM\OneToMany(targetEntity=Brief::class, mappedBy="formateur")
     */
    private $briefs;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="formateur")
     */
    private $commentaires;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->promos = new ArrayCollection();
        $this->briefs = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addFormateur($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            $groupe->removeFormateur($this);
        }

        return $this;
    }

    /**
     * @return Collection|Promo[]
     */
    public function getPromos(): Collection
    {
        return $this->promos;
    }

    public function addPromo(Promo $promo): self
    {
        if (!$this->promos->contains($promo)) {
            $this->promos[] = $promo;
            $promo->addFormateur($this);
        }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        if ($this->promos->contains($promo)) {
            $this->promos->removeElement($promo);
            $promo->removeFormateur($this);
        }

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
            $brief->setFormateur($this);
        }

        return $this;
    }

    public function removeBrief(Brief $brief): self
    {
        if ($this->briefs->contains($brief)) {
            $this->briefs->removeElement($brief);
            // set the owning side to null (unless already changed)
            if ($brief->getFormateur() === $this) {
                $brief->setFormateur(null);
            }
        }

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
            $commentaire->setFormateur($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getFormateur() === $this) {
                $commentaire->setFormateur(null);
            }
        }

        return $this;
    }
}
