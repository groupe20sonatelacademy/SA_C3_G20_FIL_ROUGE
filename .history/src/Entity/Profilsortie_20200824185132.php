<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilsortieRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * routePrefix="/admin",
 * attributes={
 *          "pagination_enabled"=true,
 *           "pagination_items_per_page"=2,  
 *            "security"="is_granted('ROLE_Admin')",
 *           "security_message"="Vous n'avez pas access à cette ressource"      
 *         },
 *  itemOperations={
 *        "archive_profilsortie"={
 *          "method"="PUT",
 *          "path"="/profilsorties/{id}/archivage",
 *          "controller"="App\Controller\API\ArchivageProfilsotieController"
 *          
 *        },
 *       "updateProfilortie"={
 *              "method"="PUT",
 *              "path"="/profilsorties/{id}",
 *              "requirements"={"id"="\d+"}
 *              
 *          },  
 *        "getProfilSortie"={
 *              "method"="GET",
 *              "path"="/admin/profilsorties/{id}",
 *              "requirements"={"id"="\d+"}
 *             
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
 * normalizationContext={"groups"={"profilsortie:read"}}
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
     * @Groups({"profilsortie:read","apprenant:read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $archivage;

    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="profilsortie")
     * @Groups({"profilsortie:read"})
     * @ApiSubresource()
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