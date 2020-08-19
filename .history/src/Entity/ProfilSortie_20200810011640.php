<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilsortieRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource(
 * attributes={
 *          "pagination_enabled"=true,
 *           "pagination_items_per_page"=2,        
 *         },
 *  itemOperations={
 *        "archive_profilsortie"={
 *          "method"="PUT",
 *          "path"="/admin/profilsorties/{id}/archivage",
 *          "controller"="App\Controller\API\ArchivageProfilsotieController",
 *           "security"="is_granted('ROLE_Admin')",
 *           "security_message"="Vous n'avez pas access à cette ressource"
 *        },
 *       "EDIT_profilsortie"={
 *              "method"="PUT",
 *              "path"="/admin/profilsorties/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },  
 *        "GET_profilsortie"={
 *              "method"="GET",
 *              "path"="/admin/profilsorties/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          }, 
 *      },
 *  collectionOperations={
 *          "ADD_profilsortie"={
 *              "method"="POST",
 *              "path"="/admin/profilsorties",
 *              "security"="is_granted('ROLE_Admin') or is_granted('ROLE_CM')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *          "LIST_profilsortie"={
 *              "method"="GET",
 *              "path"="/admin/profilsorties",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *     },
 * )
 * @ORM\Entity(repositoryClass=ProfilsortieRepository::class)
 */
class Profilsortie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

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
     * @a
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
