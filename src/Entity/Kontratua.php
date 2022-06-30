<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\KontratuaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: KontratuaRepository::class)]
#[ApiResource (
    collectionOperations: ['get'],
    itemOperations: ['get'],
    shortName: 'kontratua',
    normalizationContext: ['groups' => ['kontratua:read']]
)]
class Kontratua
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['kontratua:read'])]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['kontratua:read'])]
    private ?string $espedientea;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['kontratua:read'])]
    private ?string $izena_eus;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['kontratua:read'])]
    private ?string $izena_es;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $oharrak;

    #[ORM\Column(type: 'string', length: 12, nullable: true)]
    private ?string $espedienteElektronikoa;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $artxiboa;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $isFixed = false;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function __toString()
    {
        return '' . $this->espedientea . '-' . ' ' . $this->izena_eus;
    }

    #[Pure] public function __construct()
    {
        $this->lotes = new ArrayCollection();
        $this->fitxategiak = new ArrayCollection();
        $this->oharrak = null;
    }

    #[ORM\ManyToOne(targetEntity: Arduraduna::class, inversedBy: 'kontratua')]
    private ?Arduraduna $arduraduna;

    #[ORM\ManyToOne(targetEntity: Egoera::class, inversedBy: 'kontratua')]
    private ?Egoera $egoera;

    #[ORM\OneToMany(mappedBy: 'kontratua', targetEntity: Fitxategia::class)]
    private $fitxategiak;

    #[ORM\ManyToOne(targetEntity: Mota::class, inversedBy: 'kontratuak')]
    private ?Mota $mota;

    #[ORM\ManyToOne(targetEntity: Prozedura::class, inversedBy: 'kontratuak')]
    private ?Prozedura $prozedura;

    #[ORM\ManyToOne(targetEntity: Saila::class, inversedBy: 'kontratuak')]
    private ?Saila $saila;

    #[ORM\OneToMany(mappedBy: 'kontratua', targetEntity: KontratuaLote::class)]
    private  $lotes;

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

    public function getArtxiboa(): ?string
    {
        return $this->artxiboa;
    }

    public function setArtxiboa(?string $artxiboa): self
    {
        $this->artxiboa = $artxiboa;

        return $this;
    }

    public function isIsFixed(): ?bool
    {
        return $this->isFixed;
    }

    public function setIsFixed(?bool $isFixed): self
    {
        $this->isFixed = $isFixed;

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

    /**
     * @return Collection<int, Fitxategia>
     */
    public function getFitxategiak(): Collection
    {
        return $this->fitxategiak;
    }

    public function addFitxategiak(Fitxategia $fitxategiak): self
    {
        if (!$this->fitxategiak->contains($fitxategiak)) {
            $this->fitxategiak[] = $fitxategiak;
            $fitxategiak->setKontratua($this);
        }

        return $this;
    }

    public function removeFitxategiak(Fitxategia $fitxategiak): self
    {
        if ($this->fitxategiak->removeElement($fitxategiak)) {
            // set the owning side to null (unless already changed)
            if ($fitxategiak->getKontratua() === $this) {
                $fitxategiak->setKontratua(null);
            }
        }

        return $this;
    }

    public function getMota(): ?Mota
    {
        return $this->mota;
    }

    public function setMota(?Mota $mota): self
    {
        $this->mota = $mota;

        return $this;
    }

    public function getProzedura(): ?Prozedura
    {
        return $this->prozedura;
    }

    public function setProzedura(?Prozedura $prozedura): self
    {
        $this->prozedura = $prozedura;

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

    /**
     * @return Collection<int, KontratuaLote>
     */
    public function getLotes(): Collection
    {
        return $this->lotes;
    }

    public function addLote(KontratuaLote $lote): self
    {
        if (!$this->lotes->contains($lote)) {
            $this->lotes[] = $lote;
            $lote->setKontratua($this);
        }

        return $this;
    }

    public function removeLote(KontratuaLote $lote): self
    {
        if ($this->lotes->removeElement($lote)) {
            // set the owning side to null (unless already changed)
            if ($lote->getKontratua() === $this) {
                $lote->setKontratua(null);
            }
        }

        return $this;
    }



}
