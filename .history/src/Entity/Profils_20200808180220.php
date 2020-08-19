<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     attributes={
 *          "pagination_enabled"=true,
 *           "pagination_items_per_page"=2,
 *            "security"="is_granted('ROLE_Admin')"
 *         },
 *     itemOperations={
 *           "archive_profils"={
 *          "method"="put",
 *          "path"="/admin/profils/{id}/archivage",
 *          "controller"=App\Controller\ArchivageProfilController::class,
 *           "security"="is_granted('ROLE_Admin')",
 *           "security_message"="Vous n'avez pas access à cette ressource"
 *        }  
 *    "edit_user"={
 *              "method"="PUT",
 *              "path"="/admin/users/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },   
 *      },
 *  collectionOperations={
 *          "add_profils"={
 *              "method"="POST",
 *              "path"="/admin/profils",
 *              "security"="is_granted('ROLE_Admin') or is_granted('ROLE_CM')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *          "list_users"={
 *              "method"="GET",
 *              "path"="/admin/profils",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *     }
 *    normalizationContext={"groups"={"user:read"}},
 * )
 *  @ORM\Entity(repositoryClass=ProfilsRepository::class)
 */
class Profils
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank( message="Le libelle est obligatoire")
     * @Groups({"Profil:read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank( message="l'archevage est obligatoire" )
     */
    private $archivage;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profil")
     * @Assert\NotBlank( message="le user est obligatoire" )
     * @Groups({"Profil:read"})
     * @ApiSubresource()
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProfil($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getProfil() === $this) {
                $user->setProfil(null);
            }
        }

        return $this;
    }
}
