<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TipoIvaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: TipoIvaRepository::class)]
#[ApiResource]
class TipoIva
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'tipoiva', targetEntity: KontratuaLote::class)]
    private $loteak;

    public function __construct()
    {
        $this->loteak = new ArrayCollection();
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
     * @return Collection<int, KontratuaLote>
     */
    public function getLoteak(): Collection
    {
        return $this->loteak;
    }

    public function addLoteak(KontratuaLote $loteak): self
    {
        if (!$this->loteak->contains($loteak)) {
            $this->loteak[] = $loteak;
            $loteak->setTipoiva($this);
        }

        return $this;
    }

    public function removeLoteak(KontratuaLote $loteak): self
    {
        if ($this->loteak->removeElement($loteak)) {
            // set the owning side to null (unless already changed)
            if ($loteak->getTipoiva() === $this) {
                $loteak->setTipoiva(null);
            }
        }

        return $this;
    }
}
