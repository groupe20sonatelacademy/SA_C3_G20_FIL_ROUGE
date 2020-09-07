<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChatRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      attributes={
 *        "security"="(is_granted('ROLE_Admin') || is_granted('ROLE_Formateur')
 *            ||is_granted('ROLE_Apprenant')|| is_granted('ROLE_CM'))",
 *        "security_message"="Vous n'avez pas access à cette ressource"   
 *      },
 *       collectionOperations={
 *        
 *        "getChats"={
 *              "method"="GET",
 *              "path"="/user/promos/{id}/apprenants/{id}/chats",
 *              "route_name"="getChats"
 *          },
 * 
 *      "sendChats"={
 *              "method"="POST",
 *              "path"="/user/promos/{id}/apprenants/{id}/chats",
 *               "route_name"="sendChats"
 *          },
 * "getChats"={
 *              "method"="POST",
 *              "path"="/user/chats",
 *               "route_name"="getChats"
 *          },
 *     },
 * normalizationContext={"groups"={"chat:read"}},
 * denormalizationContext={"groups"={"chat:write"}}
 *   
 * )
 * @ORM\Entity(repositoryClass=ChatRepository::class)
 */
class Chat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"chat:read","chat:write"})
     */
    private $message;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Groups({"chat:read","chat:write"})
     */
    private $pieceJoint;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="chats")
     * @Groups({"chat:read"})
     */
    private $promo;

    /**
     * @ORM\ManyToOne(targetEntity=Apprenant::class, inversedBy="chats")
     * @Groups({"chat:read"})
     */
    private $apprenant;

    /**
     * @ORM\Column(type="date")
     * @Groups({"chat:read"})
     */
    private $date;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getPieceJoint(): ?string
    {
        return $this->pieceJoint;
    }

    public function setPieceJoint(string $pieceJoint): self
    {
        $this->pieceJoint = $pieceJoint;

        return $this;
    }

    public function getPromo(): ?Promo
    {
        return $this->promo;
    }

    public function setPromo(?Promo $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    public function getApprenant(): ?Apprenant
    {
        return $this->apprenant;
    }

    public function setApprenant(?Apprenant $apprenant): self
    {
        $this->apprenant = $apprenant;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

}
