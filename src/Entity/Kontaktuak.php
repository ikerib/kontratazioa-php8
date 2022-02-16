<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\KontaktuakRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: KontaktuakRepository::class)]
#[ApiResource (
    collectionOperations: ['get'],
    itemOperations: ['get'],
    normalizationContext: ['groups' => ['kontaktua:read']]
)]
class Kontaktuak
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['kontaktua:read'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['kontaktua:read'])]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['kontaktua:read'])]
    private $email;

    #[ORM\ManyToOne(targetEntity: Saila::class, inversedBy: 'kontaktuak')]
    private $saila;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSaila(): ?Saila
    {
        return $this->saila;
    }

    public function setSaila(?Saila $saila): self
    {
        $this->saila = $saila;

        return $this;
    }
}
