<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProfilsDeSortieRepository;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ApiResource(
 * attributes = {
 *      "security" = "is_granted('ROLE_Administrateur')",
 *      "security_message"="Vous n'avez les autorisations requises"
 *     },
 * normalizationContext = {
 *     "groups"={"profils_de_sorties_read"}
 * },
 * collectionOperations = {
 *      "GET"={},
 *      "POST"={}
 * },
 * itemOperations = {
 *      "GET"={},
 *      "PUT"={},
 *     "profilsDeSorties_archivage" = {
 *          "method" = "PUT",
 *          "path" = "/profils_de_sorties/{id}/archivage",
 *          "controller" = App\Controller\Api\ArchivageProfilsDeSorties::class,
 *
 *    }
 * }
 * 
 * )
 * @ORM\Entity(repositoryClass=ProfilsDeSortieRepository::class)
 */
class ProfilsDeSortie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner le libellé")
     * @Assert\Length(
     *      min=1,
     *      max=255,
     *      minMessage="Le libellé ne doit pas être inférieur à 1 caractères",
     *      maxMessage="Le libellé ne doit pas être supérieur à 255 caractères"
     * )
     * @Groups({"profils_de_sorties_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archivage;

    /**
     * @ApiSubresource
     * @ORM\OneToMany(targetEntity=Apprenants::class, mappedBy="profilDeSortie")
     * @Groups ({"profils_de_sorties_read"})
     */
    private $apprenants;

    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
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

    public function getArchivage(): ?bool
    {
        return $this->archivage;
    }

    public function setArchivage(bool $archivage): self
    {
        $this->archivage = $archivage;

        return $this;
    }

    /**
     * @return Collection|Apprenants[]
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Apprenants $apprenant): self
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants[] = $apprenant;
            $apprenant->setProfilDeSortie($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenants $apprenant): self
    {
        if ($this->apprenants->contains($apprenant)) {
            $this->apprenants->removeElement($apprenant);
            // set the owning side to null (unless already changed)
            if ($apprenant->getProfilDeSortie() === $this) {
                $apprenant->setProfilDeSortie(null);
            }
        }

        return $this;
    }
}
