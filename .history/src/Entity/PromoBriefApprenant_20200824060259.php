<?php

namespace App\Entity;

use App\Repository\PromoBriefApprenantRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PromoBriefApprenantRepository::class)
 */
class PromoBriefApprenant
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
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=PromoBrief::class, inversedBy="promoBriefApprenants")
     */
    private $promoBrief;

    /**
     * @ORM\ManyToOne(targetEntity=Apprenant::class, inversedBy="promoBriefApprenants")
     * eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1OTgyNDAyODgsImV4cCI6MTU5ODI0Mzg4OCwicm9sZXMiOlsiUk9MRV9Gb3JtYXRldXIiXSwidXNlcm5hbWUiOiJpbmVzLnJpb3UifQ.n_YLIXkebkdO519NOQdo5AeUawdasLG2d-g8u-QOu6Y5nWSjUVKblMEolb0PRmxv1wTCCxQYbSR09cEEwiia5MK-l9qssDx8pI72eIPsB4ZK3x6LfUnprG-CjJ6VYYmQdvnkBJ5yv-q00wKS2u0Qg6fL1de25516th-FRhuv6hFoVwbi0KZCVvH6qew-abOBG7YhNhp-On8kc0vrgvYIaP_8RymKEngMpoKu6WqVigwc_M3Hg4wgIuSCfZkn7mdAajnOnGlP1mnTxg1vzAaBGN5ERuEA59wIwR2oQYtI8K2xwsUAYLfvzS3OOvF9XSISk8vyAvctLoJuLzQC0QxHqdNpS5n28XlZUIkjene93e2ofM0_nBUkdwBlmVnD8ET-wkSXqz3x7_kQkVaEInjRdk1xcKLVCquZPN_z1DG0ayO4stY86tZu0Kto8Razrs4liLGjmCBI35ks6eDqpQ9nHY4s7NuGMAXWBg63csJXZvQYK_BwYgw502trnSUrMx4eFdwQZCav8B6YBFHCFZWoN_UblNT8T54SxfU6RfkREAvQ265Hk0agsxhZTCTW0l1RXBzBuNV-YTCKmBe6KnM9zzEjzG_0XwPtkSj-CYokzvf1Tw_gZJmVy0dySgyHylquKdb28ceVHx5VznFkz4ZP1EgsFGHDh_uulxaa0h6ml-8
     */
    private $apprenant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getPromoBrief(): ?PromoBrief
    {
        return $this->promoBrief;
    }

    public function setPromoBrief(?PromoBrief $promoBrief): self
    {
        $this->promoBrief = $promoBrief;

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
}
