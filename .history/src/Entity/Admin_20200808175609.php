<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdminRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 * itemOperations={
 *     attributes={
*        "pagination_enabled"=true,
    *        "pagination_items_per_page"=2,
    *         "security"="is_granted('ROLE_Admin')"
    *       },
 *          "get_user"={
 *              "method"="GET",
 *              "path"="/admin/users/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Administrateur')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *          "archive_user"={
 *              "method"="PUT",
 *              "path"="/admin/users/{id}Archivage",
 *              "controller"=App\Controller\ArchivageAdminController::class,
 *              "security"="is_granted('ROLE_Administrateur')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *          "set_user"={
 *              "method"="PUT",
 *              "path"="/admin/users/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *     },
 *     collectionOperations={
 *          "add_user"={
 *              "method"="POST",
 *              "path"="/admin/users",
 *              "security"="is_granted('ROLE_Admin') or is_granted('ROLE_CM')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *          "get_users"={
 *              "method"="GET",
 *              "path"="/admin/users",
 *              "security"="is_granted('ROLE_Admin')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *     }
 * )
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin extends User
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
