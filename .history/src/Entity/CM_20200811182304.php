<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\CMRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *  attributes={
 *          "pagination_enabled"=true,
 *           "pagination_items_per_page"=2,          
 *         },
 *  itemOperations={
 *        "archive_cm"={
 *          "method"="DELETE",
 *          "path"="/admin/cms/{id}/archivage",
 *          "controller"="App\Controller\API\ArchivageApprenantController",
 *           "security"="is_granted('ROLE_Admin')",
 *           "security_message"="Vous n'avez pas access à cette ressource"
 *        },
 *       "EDIT_cm"={
 *              "method"="PUT",
 *              "path"="/admin/cms/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },  
 *        "GET_cm"={
 *              "method"="GET",
 *              "path"="/admin/cms/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          }, 
 *      },
 *  collectionOperations={
 *          "ADD_cm"={
 *              "method"="POST",
 *              "path"="/admin/cms",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *          "LIST_cm"={
 *              "method"="GET",
 *              "path"="/admin/cms",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *     },
 * normalisationContext=
 * )
 * @ORM\Entity(repositoryClass=CMRepository::class)
 */
class CM extends User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
