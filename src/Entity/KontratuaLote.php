<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\KontratuaLoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: KontratuaLoteRepository::class)]
#[ApiResource (
    collectionOperations: ['get'],
    itemOperations: ['get'],
    shortName: 'lote',
    normalizationContext: ['groups' => ['lote:read']]
)]
class KontratuaLote
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['lote:read'])]
    private ?int $id=null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['lote:read'])]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['lote:read'])]
    private ?string $zenbatekoarenUnitatea;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $aurrekontuaIva;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $aurrekontuaIvaGabe;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $sinadura;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $iraupena;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $fetxaIraupena;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $adjudikazioaIva;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $adjudikazioaIvaGabe;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $luzapena;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $isFixed=false;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    #[ORM\ManyToOne(targetEntity: Kontratua::class, inversedBy: 'lotes')]
    private ?Kontratua $kontratua;

    #[ORM\ManyToOne(targetEntity: Kontratista::class, inversedBy: 'lote')]
    private ?Kontratista $kontratista;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $prorroga1;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $prorroga2;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $prorroga3;

    #[ORM\OneToMany(mappedBy: 'lote', targetEntity: Notification::class)]
    #[ApiSubresource]
    private $notifications;

    #[ORM\ManyToOne(targetEntity: TipoIva::class, inversedBy: 'loteak')]
    private $tipoiva;

    #[Pure] public function __construct()
    {
        $this->notifications = new ArrayCollection();
    }

    public function __toString()
    {
        return ''.$this->name;
    }

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

    public function getZenbatekoarenUnitatea(): ?string
    {
        return $this->zenbatekoarenUnitatea;
    }

    public function setZenbatekoarenUnitatea(string $zenbatekoarenUnitatea): self
    {
        $this->zenbatekoarenUnitatea = $zenbatekoarenUnitatea;

        return $this;
    }

    public function getAurrekontuaIva(): ?float
    {
        return $this->aurrekontuaIva;
    }

    public function setAurrekontuaIva(?float $aurrekontuaIva): self
    {
        $this->aurrekontuaIva = $aurrekontuaIva;

        return $this;
    }

    public function getAurrekontuaIvaGabe(): ?float
    {
        return $this->aurrekontuaIvaGabe;
    }

    public function setAurrekontuaIvaGabe(?float $aurrekontuaIvaGabe): self
    {
        $this->aurrekontuaIvaGabe = $aurrekontuaIvaGabe;

        return $this;
    }

    public function getSinadura(): ?\DateTimeInterface
    {
        return $this->sinadura;
    }

    public function setSinadura(?\DateTimeInterface $sinadura): self
    {
        $this->sinadura = $sinadura;

        return $this;
    }

    public function getIraupena(): ?string
    {
        return $this->iraupena;
    }

    public function setIraupena(?string $iraupena): self
    {
        $this->iraupena = $iraupena;

        return $this;
    }

    public function getFetxaIraupena(): ?\DateTimeInterface
    {
        return $this->fetxaIraupena;
    }

    public function setFetxaIraupena(?\DateTimeInterface $fetxaIraupena): self
    {
        $this->fetxaIraupena = $fetxaIraupena;

        return $this;
    }

    public function getAdjudikazioaIva(): ?float
    {
        return $this->adjudikazioaIva;
    }

    public function setAdjudikazioaIva(?float $adjudikazioaIva): self
    {
        $this->adjudikazioaIva = $adjudikazioaIva;

        return $this;
    }

    public function getAdjudikazioaIvaGabe(): ?float
    {
        return $this->adjudikazioaIvaGabe;
    }

    public function setAdjudikazioaIvaGabe(?float $adjudikazioaIvaGabe): self
    {
        $this->adjudikazioaIvaGabe = $adjudikazioaIvaGabe;

        return $this;
    }

    public function getLuzapena(): ?string
    {
        return $this->luzapena;
    }

    public function setLuzapena(string $luzapena): self
    {
        $this->luzapena = $luzapena;

        return $this;
    }

    public function getKontratua(): ?Kontratua
    {
        return $this->kontratua;
    }

    public function setKontratua(?Kontratua $kontratua): self
    {
        $this->kontratua = $kontratua;

        return $this;
    }

    public function getKontratista(): ?Kontratista
    {
        return $this->kontratista;
    }

    public function setKontratista(?Kontratista $kontratista): self
    {
        $this->kontratista = $kontratista;

        return $this;
    }

    public function getProrroga1(): ?\DateTimeInterface
    {
        return $this->prorroga1;
    }

    public function setProrroga1(?\DateTimeInterface $prorroga1): self
    {
        $this->prorroga1 = $prorroga1;

        return $this;
    }

    public function getProrroga2(): ?\DateTimeInterface
    {
        return $this->prorroga2;
    }

    public function setProrroga2(?\DateTimeInterface $prorroga2): self
    {
        $this->prorroga2 = $prorroga2;

        return $this;
    }

    public function getProrroga3(): ?\DateTimeInterface
    {
        return $this->prorroga3;
    }

    public function setProrroga3(?\DateTimeInterface $prorroga3): self
    {
        $this->prorroga3 = $prorroga3;

        return $this;
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setLote($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getLote() === $this) {
                $notification->setLote(null);
            }
        }

        return $this;
    }

    public function getIsFixed(): ?bool
    {
        return $this->isFixed;
    }

    public function setIsFixed(?bool $isFixed): self
    {
        $this->isFixed = $isFixed;

        return $this;
    }

    public function getTipoiva(): ?TipoIva
    {
        return $this->tipoiva;
    }

    public function setTipoiva(?TipoIva $tipoiva): self
    {
        $this->tipoiva = $tipoiva;

        return $this;
    }
}
