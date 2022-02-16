<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
#[ApiResource (
    collectionOperations: ['get', 'post'],
    itemOperations: ['get', 'put', 'delete'],
    denormalizationContext: ['groups' => ['notification:write']],
    normalizationContext: ['groups' => ['notification:read', 'notification:write']]
)]
class Notification
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['lote:read'])]
    private $id;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['notification:read', 'notification:write'])]
    private $noiz;

    #[ORM\Column(type: 'boolean')]
    private $notify=1;

    #[ORM\Column(type: 'boolean')]
    private $emailed=0;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    #[ORM\ManyToOne(targetEntity: KontratuaLote::class, inversedBy: 'notifications')]
    #[Groups(['notification:write'])]
    private $lote;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'notification')]
//    #[Groups(['notification:write'])]
    private $usuario;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoiz(): ?\DateTimeInterface
    {
        return $this->noiz;
    }

    public function setNoiz(\DateTimeInterface $noiz): self
    {
        $this->noiz = $noiz;

        return $this;
    }

    public function getNotify(): ?bool
    {
        return $this->notify;
    }

    public function setNotify(bool $notify): self
    {
        $this->notify = $notify;

        return $this;
    }

    public function getEmailed(): ?bool
    {
        return $this->emailed;
    }

    public function setEmailed(bool $emailed): self
    {
        $this->emailed = $emailed;

        return $this;
    }

    public function getLote(): ?KontratuaLote
    {
        return $this->lote;
    }

    public function setLote(?KontratuaLote $lote): self
    {
        $this->lote = $lote;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
