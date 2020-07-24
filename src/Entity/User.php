<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * 
 * @UniqueEntity("email",message="Cet email existe déja")
 * @UniqueEntity("username",message="Ce username existe déjà")
 * @UniqueEntity("telephone",message="Ce numéro de téléphone existe déjà")
 * 
 * @apiResource(
 *  itemOperations = {"GET","PUT","PATCH","DELETE":{
 *      "method"="post",
 *      "path"="/users/{id}/archivage",
 *      "controller"="App\Controller\ArchivageUserMethodController",
 *      "swagger_context"={
 *          "summary"="Permet la suppression d'un user",
 *          "description"="En réalité cela gère l'archivage"
 *              }
 *          }
 *      },
 *     subresourceOperations={
 *          "api_profils_users_get_subresource"={
 *               "normalization_context"={"groups"={"users_subresource"}}
 *          }
 *     },
 *    normalizationContext={
 *          "groups"={"user_read"}
 *       }
 *    )
 * 
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="Veuillez renseigner le username")
     * @Assert\Length(
     *      min=8,
     *      max=180,
     *      minMessage="Le username ne doit pas être inférieur à 8 caractères",
     *      maxMessage="Le username ne doit pas être supérieur à 180 caractères"
     * )
     * @Groups({"user_read", "profil_read", "users_subresource"})
     */
    private $username;

    
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min=8,
     *      max=255,
     *      minMessage="Le password ne doit pas être inférieur à 8 caractères",
     *      maxMessage="Le password ne doit pas être supérieur à 255 caractères"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Veuillez renseigner le password")
     * @Groups({"user_read", "profil_read","users_subresource"})
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner le téléphone de l'utilisateur")
     * @Groups({"user_read", "profil_read"})
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=6)
     * @Assert\NotBlank(message="Veuillez renseigner le genre de l'utilisateur")
     * @Groups({"user_read"})
     */
    private $genre;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Veuillez définir l'archivage")
     */
    private $archivage;

    /**
     * @ORM\ManyToOne(targetEntity=Profils::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Veuillez renseigner le profil de l'utilisateur")
     * @Groups({"user_read","profil_read"})
     */
    private $profil;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner le nom de l'utilisateur")
     * @Assert\Length(
     *      min=1,
     *      max=255,
     *      minMessage="Le nom ne doit pas être inférieur à 1 caractères",
     *      maxMessage="Le nom ne doit pas être supérieur à 255 caractères"
     * )
     * @Groups({"user_read", "profil_read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner le prénom de l'utilisateur")
     * @Assert\Length(
     *      min=1,
     *      max=255,
     *      minMessage="Le prénom ne doit pas être inférieur à 1 caractères",
     *      maxMessage="Le prénom ne doit pas être supérieur à 255 caractères"
     * )
     * @Groups({"user_read", "profil_read", "users_subresource"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner l'email de l'utilisateur")
     * @Assert\Email(message="L'email est invalide")
     * @Groups({"user_read", "profil_read", "users_subresource"})
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

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

    public function getProfil(): ?Profils
    {
        return $this->profil;
    }

    public function setProfil(?Profils $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
