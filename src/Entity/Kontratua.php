<?php

namespace App\Entity;

use App\Repository\KontratuaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: KontratuaRepository::class)]
class Kontratua
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $espedientea;

    #[ORM\Column(type: 'string', length: 255)]
    private $izena_eus;

    #[ORM\Column(type: 'string', length: 255)]
    private $izena_es;

    #[ORM\Column(type: 'text', nullable: true)]
    private $oharrak;

    #[ORM\Column(type: 'string', length: 12, nullable: true)]
    private $espedienteElektronikoa;

    #[ORM\ManyToOne(targetEntity: Arduraduna::class, inversedBy: 'kontratua')]
    private $arduraduna;

    #[ORM\ManyToOne(targetEntity: Egoera::class, inversedBy: 'kontratua')]
    private $egoera;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function __toString()
    {
        return '' . $this->espedientea . '-' . '' . $this->izena_eus;
    }

    public function __construct()
    {
        $this->lotes = new ArrayCollection();
        $this->fitxategiak = new ArrayCollection();
    }

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEspedientea(): ?string
    {
        return $this->espedientea;
    }

    public function setEspedientea(string $espedientea): self
    {
        $this->espedientea = $espedientea;

        return $this;
    }

    public function getIzenaEus(): ?string
    {
        return $this->izena_eus;
    }

    public function setIzenaEus(string $izena_eus): self
    {
        $this->izena_eus = $izena_eus;

        return $this;
    }

    public function getIzenaEs(): ?string
    {
        return $this->izena_es;
    }

    public function setIzenaEs(string $izena_es): self
    {
        $this->izena_es = $izena_es;

        return $this;
    }

    public function getOharrak(): ?string
    {
        return $this->oharrak;
    }

    public function setOharrak(?string $oharrak): self
    {
        $this->oharrak = $oharrak;

        return $this;
    }

    public function getEspedienteElektronikoa(): ?string
    {
        return $this->espedienteElektronikoa;
    }

    public function setEspedienteElektronikoa(?string $espedienteElektronikoa): self
    {
        $this->espedienteElektronikoa = $espedienteElektronikoa;

        return $this;
    }

    public function getArduraduna(): ?Arduraduna
    {
        return $this->arduraduna;
    }

    public function setArduraduna(?Arduraduna $arduraduna): self
    {
        $this->arduraduna = $arduraduna;

        return $this;
    }

    public function getEgoera(): ?Egoera
    {
        return $this->egoera;
    }

    public function setEgoera(?Egoera $egoera): self
    {
        $this->egoera = $egoera;

        return $this;
    }

}
