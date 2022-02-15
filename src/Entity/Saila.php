<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SailaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SailaRepository::class)]
#[ApiResource]
class Saila
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'saila', targetEntity: Kontaktuak::class)]
    private $kontaktuak;

    public function __construct()
    {
        $this->kontaktuak = new ArrayCollection();
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
     * @return Collection|Kontaktuak[]
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
}
