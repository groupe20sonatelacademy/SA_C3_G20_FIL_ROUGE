<?php

namespace App\Entity;

use App\Repository\CMRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *  attributes={
 *          "pagination_enabled"=true,
 *           "pagination_items_per_page"=2,          
 *         },
 *  itemOperations={
 *        "archive_apprenant"={
 *          "method"="DELETE",
 *          "path"="/admin/apprenants/{id}/archivage",
 *          "controller"="App\Controller\API\ArchivageApprenantController",
 *           "security"="is_granted('ROLE_Admin')",
 *           "security_message"="Vous n'avez pas access à cette ressource"
 *        },
 *       "edit_apprenant"={
 *              "method"="PUT",
 *              "path"="/admin/apprenants/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },  
 *        "get_apprenant"={
 *              "method"="GET",
 *              "path"="/admin/apprenants/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          }, 
 *      },
 *  collectionOperations={
 *          "add_cm"={
 *              "method"="POST",
 *              "path"="/admin/s",
 *              "security"="is_granted('ROLE_Admin') or is_granted('ROLE_CM')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *          "list_apprenant"={
 *              "method"="GET",
 *              "path"="/admin/apprenants",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *     }
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
