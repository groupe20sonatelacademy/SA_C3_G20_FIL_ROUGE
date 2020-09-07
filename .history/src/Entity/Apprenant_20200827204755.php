<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
     routePrefix="/admin",
 *  attributes={
 *          "pagination_enabled"=true,
 *           "pagination_items_per_page"=2,
 *           "security"="is_granted('ROLE_Admin')",
 *           "security_message"="Vous n'avez pas access à cette ressource"          
 *         },
 *  itemOperations={
 *        "archiveApprenant"={
 *          "method"="PUT",
 *          "path"="/apprenants/{id}/archivage",
 *          "controller"="App\Controller\API\ArchivageApprenantController"
 *          
 *        },
 *       "updateApprenant"={
 *              "method"="PUT",
 *              "path"="/apprenants/{id}",
 *              "requirements"={"id"="\d+"}
 *          
 *          },  
 *        "setApprenant"={
 *              "method"="GET",
 *              "path"="/apprenants/{id}",
 *              "requirements"={"id"="\d+"}
 *             
 *          }, 
 *      },
 *  collectionOperations={
 *          "addApprenant"={
 *              "method"="POST",
 *              "path"="/apprenants"
 *              
 *          },
 *          "getApprenant"={
 *              "method"="GET",
 *              "path"="/apprenants"
 *             
 *          },
 *     },
 * normalizationContext={"groups"={"apprenant:read"}}
 * )
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 */
class Apprenant  extends User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank( message="L'adresse est obligatoire")
     * @Groups({"apprenant:read","profilsortieApp:read","profilsortie:read"})
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank( message="Le statut est obligatoire")
     * @Groups({"apprenant:read","profilsortieApp:read"})
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank( message="La categorie est obligatoire")
     * @Groups({"apprenant:read","profilsortieApp:read","profilsortie:read"})
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank( message="Les infos complementaires  sont obligatoire")
     * @Groups({"apprenant:read","profilsortieApp:read","profilsortie:read"})
     */
    private $infocomplementaitre;

    /**
     * @ORM\ManyToOne(targetEntity=Profilsortie::class, inversedBy="Apprenant")
     * @Assert\NotBlank( message="Le profil de sortie est obligatoire")
     * @Groups({"apprenant:read","profilsortieApp:read"})
     * @ApiSubresource()
     */
    protected $profilsortie;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="apprenant")
     * @Groups({"apprenant:read","briefGroupe:read"})
     */
    private $groupes;

    /**
     * @ORM\OneToMany(targetEntity=PromoBriefApprenant::class, mappedBy="apprenant")
     * @groups({"promo:read","briefApprenant:read"})
     */
    private $promoBriefApprenants;

    /**
     * @ORM\OneToMany(targetEntity=LivrablePartielApprenant::class, mappedBy="apprenant")
     */
    private $livrablePartielApprenants;

    /**
     * @ORM\OneToMany(targetEntity=Chat::class, mappedBy="apprenant")
     */
    private $chats;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->promoBriefApprenants = new ArrayCollection();
        $this->livrablePartielApprenants = new ArrayCollection();
        $this->chats = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getInfocomplementaitre(): ?string
    {
        return $this->infocomplementaitre;
    }

    public function setInfocomplementaitre(string $infocomplementaitre): self
    {
        $this->infocomplementaitre = $infocomplementaitre;

        return $this;
    }

    public function getProfilsortie(): ?Profilsortie
    {
        return $this->profilsortie;
    }

    public function setProfilsortie(?Profilsortie $profilsortie): self
    {
        $this->profilsortie = $profilsortie;

        return $this;
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
            $groupe->addApprenant($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            $groupe->removeApprenant($this);
        }

        return $this;
    }

    /**
     * @return Collection|PromoBriefApprenant[]
     */
    public function getPromoBriefApprenants(): Collection
    {
        return $this->promoBriefApprenants;
    }

    public function addPromoBriefApprenant(PromoBriefApprenant $promoBriefApprenant): self
    {
        if (!$this->promoBriefApprenants->contains($promoBriefApprenant)) {
            $this->promoBriefApprenants[] = $promoBriefApprenant;
            $promoBriefApprenant->setApprenant($this);
        }

        return $this;
    }

    public function removePromoBriefApprenant(PromoBriefApprenant $promoBriefApprenant): self
    {
        if ($this->promoBriefApprenants->contains($promoBriefApprenant)) {
            $this->promoBriefApprenants->removeElement($promoBriefApprenant);
            // set the owning side to null (unless already changed)
            if ($promoBriefApprenant->getApprenant() === $this) {
                $promoBriefApprenant->setApprenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LivrablePartielApprenant[]
     */
    public function getLivrablePartielApprenants(): Collection
    {
        return $this->livrablePartielApprenants;
    }

    public function addLivrablePartielApprenant(LivrablePartielApprenant $livrablePartielApprenant): self
    {
        if (!$this->livrablePartielApprenants->contains($livrablePartielApprenant)) {
            $this->livrablePartielApprenants[] = $livrablePartielApprenant;
            $livrablePartielApprenant->setApprenant($this);
        }

        return $this;
    }

    public function removeLivrablePartielApprenant(LivrablePartielApprenant $livrablePartielApprenant): self
    {
        if ($this->livrablePartielApprenants->contains($livrablePartielApprenant)) {
            $this->livrablePartielApprenants->removeElement($livrablePartielApprenant);
            // set the owning side to null (unless already changed)
            if ($livrablePartielApprenant->getApprenant() === $this) {
                $livrablePartielApprenant->setApprenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Chat[]
     */
    public function getChats(): Collection
    {
        return $this->chats;
    }

    public function addChat(Chat $chat): self
    {
        if (!$this->chats->contains($chat)) {
            $this->chats[] = $chat;
            $chat->setApprenant($this);
        }

        return $this;
    }

    public function removeChat(Chat $chat): self
    {
        if ($this->chats->contains($chat)) {
            $this->chats->removeElement($chat);
            // set the owning side to null (unless already changed)
            if ($chat->getApprenant() === $this) {
                $chat->setApprenant(null);
            }
        }

        return $this;
    }

    
}
