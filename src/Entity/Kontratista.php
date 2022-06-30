<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\KontratistaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: KontratistaRepository::class)]
#[ApiResource]
class Kontratista
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $izena_eus;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $izena_es;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    #[Pure] public function __construct()
    {
        $this->lote = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->izena_eus;
    }

    #[ORM\OneToMany(mappedBy: 'kontratista', targetEntity: KontratuaLote::class)]
    private $lote;

    public function getId(): ?int
    {
        return $this->id;
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

    public function setIzenaEs(?string $izena_es): self
    {
        $this->izena_es = $izena_es;

        return $this;
    }

    /**
     * @return Collection<int, KontratuaLote>
     */
    public function getLote(): Collection
    {
        return $this->lote;
    }

    public function addLote(KontratuaLote $lote): self
    {
        if (!$this->lote->contains($lote)) {
            $this->lote[] = $lote;
            $lote->setKontratista($this);
        }

        return $this;
    }

    public function removeLote(KontratuaLote $lote): self
    {
        if ($this->lote->removeElement($lote)) {
            // set the owning side to null (unless already changed)
            if ($lote->getKontratista() === $this) {
                $lote->setKontratista(null);
            }
        }

        return $this;
    }
}
