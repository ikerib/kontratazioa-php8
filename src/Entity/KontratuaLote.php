<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\KontratuaLoteRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: KontratuaLoteRepository::class)]
#[ApiResource]
class KontratuaLote
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $zenbatekoarenUnitatea;

    #[ORM\Column(type: 'float', nullable: true)]
    private $aurrekontuaIva;

    #[ORM\Column(type: 'float', nullable: true)]
    private $aurrekontuaIvaGabe;

    #[ORM\Column(type: 'date', nullable: true)]
    private $sinadura;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $iraupena;

    #[ORM\Column(type: 'date', nullable: true)]
    private $fetxaIraupena;

    #[ORM\Column(type: 'float', nullable: true)]
    private $adjudikazioaIva;

    #[ORM\Column(type: 'float', nullable: true)]
    private $adjudikazioaIvaGabe;

    #[ORM\Column(type: 'string', length: 255)]
    private $luzapena;

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

    public function getZenbatekoarenUnitatea(): ?string
    {
        return $this->zenbatekoarenUnitatea;
    }

    public function setZenbatekoarenUnitatea(string $zenbatekoarenUnitatea): self
    {
        $this->zenbatekoarenUnitatea = $zenbatekoarenUnitatea;

        return $this;
    }

    public function getAurrekontuaIva(): ?float
    {
        return $this->aurrekontuaIva;
    }

    public function setAurrekontuaIva(?float $aurrekontuaIva): self
    {
        $this->aurrekontuaIva = $aurrekontuaIva;

        return $this;
    }

    public function getAurrekontuaIvaGabe(): ?float
    {
        return $this->aurrekontuaIvaGabe;
    }

    public function setAurrekontuaIvaGabe(?float $aurrekontuaIvaGabe): self
    {
        $this->aurrekontuaIvaGabe = $aurrekontuaIvaGabe;

        return $this;
    }

    public function getSinadura(): ?\DateTimeInterface
    {
        return $this->sinadura;
    }

    public function setSinadura(?\DateTimeInterface $sinadura): self
    {
        $this->sinadura = $sinadura;

        return $this;
    }

    public function getIraupena(): ?string
    {
        return $this->iraupena;
    }

    public function setIraupena(?string $iraupena): self
    {
        $this->iraupena = $iraupena;

        return $this;
    }

    public function getFetxaIraupena(): ?\DateTimeInterface
    {
        return $this->fetxaIraupena;
    }

    public function setFetxaIraupena(?\DateTimeInterface $fetxaIraupena): self
    {
        $this->fetxaIraupena = $fetxaIraupena;

        return $this;
    }

    public function getAdjudikazioaIva(): ?float
    {
        return $this->adjudikazioaIva;
    }

    public function setAdjudikazioaIva(?float $adjudikazioaIva): self
    {
        $this->adjudikazioaIva = $adjudikazioaIva;

        return $this;
    }

    public function getAdjudikazioaIvaGabe(): ?float
    {
        return $this->adjudikazioaIvaGabe;
    }

    public function setAdjudikazioaIvaGabe(?float $adjudikazioaIvaGabe): self
    {
        $this->adjudikazioaIvaGabe = $adjudikazioaIvaGabe;

        return $this;
    }

    public function getLuzapena(): ?string
    {
        return $this->luzapena;
    }

    public function setLuzapena(string $luzapena): self
    {
        $this->luzapena = $luzapena;

        return $this;
    }
}
