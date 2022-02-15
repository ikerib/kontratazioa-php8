<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MotaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: MotaRepository::class)]
#[ApiResource]
class Mota
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name_eus;

    #[ORM\Column(type: 'string', length: 255)]
    private $mota_es;

    #[ORM\OneToMany(mappedBy: 'mota', targetEntity: Kontratua::class)]
    private $kontratuak;

    public function __construct()
    {
        $this->kontratuak = new ArrayCollection();
    }

    public function getMotaEs(): ?string
    {
        return $this->mota_es;
    }

    public function setMotaEs(string $mota_es): self
    {
        $this->mota_es = $mota_es;

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
            $kontratuak->setMota($this);
        }

        return $this;
    }

    public function removeKontratuak(Kontratua $kontratuak): self
    {
        if ($this->kontratuak->removeElement($kontratuak)) {
            // set the owning side to null (unless already changed)
            if ($kontratuak->getMota() === $this) {
                $kontratuak->setMota(null);
            }
        }

        return $this;
    }


}
