<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChatRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *      attributes={
 *        "security"="(is_granted('ROLE_Admin') || is_granted('ROLE_Formateur')
 *            ||is_granted('ROLE_Apprenant')|| is_granted('ROLE_CM'))",
 *        "security_message"="Vous n'avez pas access à cette ressource"   
 *      },
 *       collectionOperations={
 *        
 *      "getChats"={
 *              "method"="GET",
 *              "path"="/user/promos/{id}/apprenants/{id}/chats",
 *               "route_name"=SendChats
 *          },
 * 
 *      "sendChats"={
 *              "method"="POST",
 *              "path"="/user/promos/{id}/apprenant/{id}/chats",
 *               "route_name"=SendChats
 *          },
 * 
 *   }
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
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pieceJoint;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="chats")
     */
    private $promo;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="chats")
     */
    private $user;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
