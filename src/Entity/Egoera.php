<?php

namespace App\Entity;

use App\Repository\EgoeraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: EgoeraRepository::class)]
class Egoera
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

    #[ORM\OneToMany(mappedBy: 'egoera', targetEntity: Kontratua::class)]
    private $kontratua;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nameEs;

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
            $kontratua->setEgoera($this);
        }

        return $this;
    }

    public function removeKontratua(Kontratua $kontratua): self
    {
        if ($this->kontratua->removeElement($kontratua)) {
            // set the owning side to null (unless already changed)
            if ($kontratua->getEgoera() === $this) {
                $kontratua->setEgoera(null);
            }
        }

        return $this;
    }

    public function getNameEs(): ?string
    {
        return $this->nameEs;
    }

    public function setNameEs(?string $nameEs): self
    {
        $this->nameEs = $nameEs;

        return $this;
    }
}
