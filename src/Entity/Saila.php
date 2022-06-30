<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SailaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: SailaRepository::class)]
#[ApiResource]
class Saila
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $izena;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    #[Pure] public function __construct()
    {
        $this->kontaktuak = new ArrayCollection();
        $this->kontratuak = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->izena;
    }

    #[ORM\OneToMany(mappedBy: 'saila', targetEntity: Kontaktuak::class)]
    private $kontaktuak;

    #[ORM\OneToMany(mappedBy: 'saila', targetEntity: Kontratua::class)]
    private $kontratuak;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIzena(): ?string
    {
        return $this->izena;
    }

    public function setIzena(string $izena): self
    {
        $this->izena = $izena;

        return $this;
    }

    /**
     * @return Collection<int, Kontaktuak>
     */
    public function getKontaktuak(): Collection
    {
        return $this->kontaktuak;
    }

    public function addKontaktuak(Kontaktuak $kontaktuak): self
    {
        if (!$this->kontaktuak->contains($kontaktuak)) {
            $this->kontaktuak[] = $kontaktuak;
            $kontaktuak->setSaila($this);
        }

        return $this;
    }

    public function removeKontaktuak(Kontaktuak $kontaktuak): self
    {
        if ($this->kontaktuak->removeElement($kontaktuak)) {
            // set the owning side to null (unless already changed)
            if ($kontaktuak->getSaila() === $this) {
                $kontaktuak->setSaila(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Kontratua>
     */
    public function getKontratuak(): Collection
    {
        return $this->kontratuak;
    }

    public function addKontratuak(Kontratua $kontratuak): self
    {
        if (!$this->kontratuak->contains($kontratuak)) {
            $this->kontratuak[] = $kontratuak;
            $kontratuak->setSaila($this);
        }

        return $this;
    }

    public function removeKontratuak(Kontratua $kontratuak): self
    {
        if ($this->kontratuak->removeElement($kontratuak)) {
            // set the owning side to null (unless already changed)
            if ($kontratuak->getSaila() === $this) {
                $kontratuak->setSaila(null);
            }
        }

        return $this;
    }


}
