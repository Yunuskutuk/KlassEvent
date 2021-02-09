<?php

namespace App\Entity;

use App\Repository\MenuPictureRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=MenuPictureRepository::class)
 * @UniqueEntity("path")
 * @Vich\Uploadable
 */
class MenuPicture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $path;

    /**
     * @Vich\UploadableField(mapping="upload_picture", fileNameProperty="path")
     * @var mixed
     */
    private $pathFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $alt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var dateTime
     */
    private $dateTime;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string|null
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setPathFile(File $image = null): self
    {
        $this->pathFile = $image;
        return $this;
    }


    public function getPathFile(): ?File
    {
        return $this->pathFile;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
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

    public function getDatetime(): ?DateTime
    {
        return $this->dateTime;
    }

    public function setDatetime(DateTime $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
