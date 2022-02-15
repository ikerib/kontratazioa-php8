<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FitxategiMotaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FitxategiMotaRepository::class)]
#[ApiResource]
class FitxategiMota
{
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
        $this->fitxategiak = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    #[ORM\OneToMany(mappedBy: 'fitxategiMota', targetEntity: Fitxategia::class)]
    private $fitxategiak;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/


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
     * @return Collection|Fitxategia[]
     */
    public function getFitxategiak(): Collection
    {
        return $this->fitxategiak;
    }

    public function addFitxategiak(Fitxategia $fitxategiak): self
    {
        if (!$this->fitxategiak->contains($fitxategiak)) {
            $this->fitxategiak[] = $fitxategiak;
            $fitxategiak->setFitxategiMota($this);
        }

        return $this;
    }

    public function removeFitxategiak(Fitxategia $fitxategiak): self
    {
        if ($this->fitxategiak->removeElement($fitxategiak)) {
            // set the owning side to null (unless already changed)
            if ($fitxategiak->getFitxategiMota() === $this) {
                $fitxategiak->setFitxategiMota(null);
            }
        }

        return $this;
    }
}
