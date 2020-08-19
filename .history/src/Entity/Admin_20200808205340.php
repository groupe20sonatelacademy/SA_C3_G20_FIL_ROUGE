<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdminRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
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
 *                      "controller"=App\Controller\API\ArchivageAdminController",
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
 *                        "security"="is_granted('ROLE_Admin')",
 *                         "security_message"="Vous n'avez pas access à cette Ressource"
 *                        },
 *                 "LIST_users"={
 *                        "method"="GET",
 *                         "path"="/admin/users",
 *                         "security"="is_granted('ROLE_Admin')",
 *                         "security_message"="Vous n'avez pas access à cette Ressource"
 *                             },
 *            }
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
