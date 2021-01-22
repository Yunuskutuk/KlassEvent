<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
 * @UniqueEntity("name")
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

    public function getMenuOfWeek(): ?Bool
    {
        return $this->menuOfWeek;
    }

    public function setMenuOfWeek(Boolean $menuOfWeek): self
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
