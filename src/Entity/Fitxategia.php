<?php

namespace App\Entity;

use App\Repository\FitxategiaRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: FitxategiaRepository::class)]
#[Vich\Uploadable]
class Fitxategia
{
    Use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id=null;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[Vich\UploadableField(mapping: 'uploads', fileNameProperty: 'fileName', size: 'fileSize')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string')]
    private ?string $fileName = null;

    #[ORM\Column(type: 'integer')]
    private ?int $fileSize = null;

    /******************************************************************************************************************/
    /******************************************************************************************************************/
    /******************************************************************************************************************/

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $uploadFile = null): void
    {
        $this->uploadFile = $uploadFile;

        if (null !== $uploadFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getUploadFile(): ?File
    {
        return $this->uploadFile;
    }

    #[ORM\ManyToOne(targetEntity: FitxategiMota::class, inversedBy: 'fitxategiak')]
    private $fitxategiMota;

    #[ORM\ManyToOne(targetEntity: Kontratua::class, inversedBy: 'fitxategiak')]
    private $kontratua;

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


    public function getFitxategiMota(): ?FitxategiMota
    {
        return $this->fitxategiMota;
    }

    public function setFitxategiMota(?FitxategiMota $fitxategiMota): self
    {
        $this->fitxategiMota = $fitxategiMota;

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

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    public function setFileSize(int $fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }
}
