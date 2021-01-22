<?php

namespace App\Entity;

use App\Entity\Event;
use App\Entity\Option;
use App\Entity\Picture;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 * @UniqueEntity("title")
 */
class Service
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
     * @Assert\NotBlank(message="Chaque service doit être nommé !")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @var string
     * @Assert\NotBlank(message="Chaque service doit avoir une description, même courte")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Event::class, mappedBy="service", cascade={"persist", "remove"})
     * @var ArrayCollection
     */
    private $event;

    /**
     * @ORM\ManyToMany(targetEntity=Option::class, inversedBy="services", cascade={"persist", "remove"})
     * @var ArrayCollection
     */
    private $options;

    /**
     * @ORM\ManyToMany(targetEntity=picture::class, inversedBy="services", cascade={"persist", "remove"})
     * @var ArrayCollection
     */
    private $picture;

    public function __construct()
    {
        $this->event = new ArrayCollection();
        $this->options = new ArrayCollection();
        $this->picture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    /**
     * @return Collection|Event[]
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->event->contains($event)) {
            $this->event[] = $event;
            $event->addService($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->event->removeElement($event)) {
            $event->removeService($this);
        }

        return $this;
    }

    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        $this->options->removeElement($option);

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPicture(): Collection
    {
        return $this->picture;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->picture->contains($picture)) {
            $this->picture[] = $picture;
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        $this->picture->removeElement($picture);

        return $this;
    }
}
