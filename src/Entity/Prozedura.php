<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProzeduraRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: ProzeduraRepository::class)]
#[ApiResource]
class Prozedura
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $prozedura_eus;

    #[ORM\Column(type: 'string', length: 255)]
    private $prozedura_es;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProzeduraEus(): ?string
    {
        return $this->prozedura_eus;
    }

    public function setProzeduraEus(string $prozedura_eus): self
    {
        $this->prozedura_eus = $prozedura_eus;

        return $this;
    }

    public function getProzeduraEs(): ?string
    {
        return $this->prozedura_es;
    }

    public function setProzeduraEs(string $prozedura_es): self
    {
        $this->prozedura_es = $prozedura_es;

        return $this;
    }
}
