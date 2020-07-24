<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\ArchivageMethodController;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProfilsRepository::class)
 * @apiResource(
 * itemOperations = {"GET","PUT","PATCH","DELETE":{
 *      "method"="post",
 *      "path"="/profils/{id}/archivage",
 *      "controller"="App\Controller\ArchivageProfilMethodController",
 *      "swagger_context"={
 *          "summary"="Permet la suppression d'un profil",
 *          "description"="En réalité cela gère l'archivage"
 *              }
 *          }
 *      },
 *     attributes={
            "pagination_items_per_page"=2
 *     },
 *     normalizationContext={
 *          "groups"={"profil_read"}
 *     },
 *     subresourceOperations={
 *          "users_get_subresource"={"patch"="/profils/{id}/users"}
 *      }
 * )
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
     * @Assert\NotBlank(message="Veuillez renseigner le libellé du profil")
     * @Assert\Length(
     *      min=2,
     *      max=30,
     *      minMessage="Le Libellé doit être supérieur ou égal à 2 caractères",
     *      maxMessage="Le libellé doit être inférieur ou égal à 30 caractères"
     * )
     * @Groups({"profil_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="L'archivage n'a pas été défini")
     * @Assert\Regex(
     *      pattern = "/^(1|0)$/",
     *      message = "L'archivage doit être soit 1 ou 0"
     * )
     */
    private $archivage;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profil")
     * 
     * @Groups({"profil_read"})
     * 
     * @ApiSubresource
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
