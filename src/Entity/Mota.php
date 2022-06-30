<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MotaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: MotaRepository::class)]
#[ApiResource]
class Mota
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $mota_eus;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $mota_es;

###< symfony/framework-bundle ###

###> doctrine/doctrine-bundle ###
# Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# IMPORTANT: You MUST configure your server version, either here or in config/packages/doctrine.yaml
#
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
    #[Pure] public function __construct()
    {
        $this->kontratuak = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->mota_eus;
    }

    #[ORM\OneToMany(mappedBy: 'mota', targetEntity: Kontratua::class)]
    private $kontratuak;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotaEus(): ?string
    {
        return $this->mota_eus;
    }

    public function setMotaEus(string $mota_eus): self
    {
        $this->mota_eus = $mota_eus;

        return $this;
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
