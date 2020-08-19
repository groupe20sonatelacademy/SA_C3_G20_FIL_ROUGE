<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;



/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="Profil", type="string")
 * @ORM\DiscriminatorMap({"admin"="User","cm"="CM","formateur"="Formateur","apprenant"="Apprenant"})
 * @UniqueEntity(fields={"username"})
 * @UniqueEntity(fields={"email"})
 * @ApiResource(
 *      attributes={
 *             "pagination_enabled"=true,
 *              "pagination_items_per_page"=2,
 *              },
 *   itemOperations={
 *           "GET_user"={
 *                 "method"="GET",
 *                 "path"="/admin/users/{id}",
 *                  "requirements"={"id"="\d+"},
 *                  "security"="is_granted('ROLE_Admin')",
 *                  "security_message"="Vous n'avez pas access à cette Ressource"
 *                  },
 *             "ARCHIVE_user"={
 *                      "method"="PUT",
 *                      "path"="/admin/users/{id}Archivage",
 *                      "controller"="App\Controller\API\ArchivageAdminController",
 *                      "security"="is_granted('ROLE_Admin')",
 *                      "security_message"="Vous n'avez pas access à cette Ressource"
 *                    },
 *               "EDIT_user"={
 *                       "method"="PUT",
 *                       "path"="/admin/users/{id}",
 *                        "requirements"={"id"="\d+"},
 *                        "security"="is_granted('ROLE_Admin')",
 *                        "security_message"="Vous n'avez pas access à cette Ressource"
 *                       },
 *                    },
 *         collectionOperations={
 *                 "ADD_user"={
 *                        "method"="POST",
 *                        "path"="/admin/users",
 *                        "security_post_denormalize"="is_granted('ROLE_Admin')",
 *                        "security_post_denormalize_message"="Vous n'avez pas access à cette Ressource",
 *                        },
 *                 "LIST_users"={
 *                        "method"="GET",
 *                         "path"="/admin/users",
 *                         "security"="is_granted('ROLE_Admin')",
 *                         "security_message"="Vous n'avez pas access à cette Ressource"
 *                             },
 *            },
 *  normalizationContext={"groups"={"user:read"}},
 * )
 */
class User implements UserInterface

{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank( message="le username est obligatoire")
     * @Assert\User( message="le username doit etre unique")
     * @Groups({"user:read"})
     */
    protected $username;

    
     
    protected $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank( message="le mot de passe est obligatoire")
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank( message="le telephone est obligatoire")
     * @Groups({"user:read"})
     */
    protected $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $photo;

    /**
     * @ORM\Column(type="string", length=6)
     * @Assert\NotBlank( message="le sexe est obligatoire")
     * @Groups({"user:read"})
     */
    protected $genre;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user:read"})
     */
    protected $archivage;

    /**
     * @ORM\ManyToOne(targetEntity=Profils::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank( message="le profil est obligatoire" ) 
     * @ApiSubresource()
     * @Groups({"user:read"})
     */
    protected $profil;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="le nom est obligatoire")
     * @Groups({"user:read"})
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank( message="le prenom est obligatoire" )
     * @Groups({"user:read"})
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="l'email est obligatoire")
     * @Groups({"user:read"})
     */
    protected $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
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
        $roles[] = 'ROLE_' . $this->profil->getLibelle();

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

    public function getArchivage(): ?bool
    {
        return $this->archivage;
    }

    public function setArchivage(bool $archivage): self
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





    //POUR CHARGER LA PHOTO


}
