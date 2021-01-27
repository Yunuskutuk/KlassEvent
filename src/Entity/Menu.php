<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
 * @UniqueEntity("name")
 * @Vich\Uploadable
 */
class Menu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     * @Assert\NotBlank(message="Le nom du produit est obligatoire !")
     * @Assert\Length(
     * min=5,
     * max=255,
     * minMessage="Le nom du produit doit avoir au moins {{ limit }} caractères",
     * maxMessage="Le nom du produit doit avoir maximum {{ limit }} caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     * @Assert\NotBlank(message="Un prix doit être enregistré !")
     */
    private $price;

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
     * @ORM\Column(type="text")
     * @var string
     * @Assert\NotBlank(message="chaque menu doit avoir une description !")
     * @Assert\Length(
     * min=10,
     * minMessage="La description du menu doit avoir au moins {{ limit }} caractères")
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $more;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @var boolean
     */
    private $menuOfWeek;

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


    public function getMenuOfWeek(): ?bool
    {
        return $this->menuOfWeek;
    }

    public function setMenuOfWeek(bool $menuOfWeek): self
    {
        $this->menuOfWeek = $menuOfWeek;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMore(): ?string
    {
        return $this->more;
    }

    public function setMore(?string $more): self
    {
        if ($more) {
            $this->more = $more;
        }

        return $this;
    }
}
