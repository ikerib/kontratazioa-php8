<?php

namespace App\Entity;

use App\Repository\ArduradunaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: ArduradunaRepository::class)]
class Arduraduna
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    public function __construct()
    {
        $this->kontratua = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    #[ORM\OneToMany(mappedBy: 'arduraduna', targetEntity: Kontratua::class)]
    private $kontratua;

    /**
     * @return Collection<int, Kontratua>
     */
    public function getKontratua(): Collection
    {
        return $this->kontratua;
    }

    public function addKontratua(Kontratua $kontratua): self
    {
        if (!$this->kontratua->contains($kontratua)) {
            $this->kontratua[] = $kontratua;
            $kontratua->setArduraduna($this);
        }

        return $this;
    }

    public function removeKontratua(Kontratua $kontratua): self
    {
        if ($this->kontratua->removeElement($kontratua)) {
            // set the owning side to null (unless already changed)
            if ($kontratua->getArduraduna() === $this) {
                $kontratua->setArduraduna(null);
            }
        }

        return $this;
    }

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

    /**
     * @return Collection|Kontratua[]
     */
    public function getKontratuak(): Collection
    {
        return $this->kontratuak;
    }

    public function addKontratuak(Kontratua $kontratuak): self
    {
        if (!$this->kontratuak->contains($kontratuak)) {
            $this->kontratuak[] = $kontratuak;
            $kontratuak->setArduraduna($this);
        }

        return $this;
    }

    public function removeKontratuak(Kontratua $kontratuak): self
    {
        if ($this->kontratuak->removeElement($kontratuak)) {
            // set the owning side to null (unless already changed)
            if ($kontratuak->getArduraduna() === $this) {
                $kontratuak->setArduraduna(null);
            }
        }

        return $this;
    }


}
