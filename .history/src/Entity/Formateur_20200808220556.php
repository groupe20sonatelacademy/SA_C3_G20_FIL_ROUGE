<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use ApiPlatform\Core\Annotation\ApiResource;

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
 *       "EDIT_apprenant"={
 *              "method"="PUT",
 *              "path"="/admin/apprenants/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },  
 *        "GET_apprenant"={
 *              "method"="GET",
 *              "path"="/admin/formateurs/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          }, 
 *      },
 *  collectionOperations={
 *          "ADD_formateur"={
 *              "method"="POST",
 *              "path"="/admin/formateurs",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *          "LIST_formateur"={
 *              "method"="GET",
 *              "path"="/admin/formateurs",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *     }
 * )
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 */
class Formateur extends User
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
