<?php

namespace App\Entity;

use App\Repository\TranslateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=TranslateRepository::class)
 * @UniqueEntity(
 * fields = {"yamlKey"},
 * message = "Cette clé existe déjà."
 * )
 */
class Translate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @var string
     */
    private $yamlKey;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $french;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $turkish;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYamlKey(): ?string
    {
        return $this->yamlKey;
    }

    public function setYamlKey(string $yamlKey): self
    {
        $this->yamlKey = $yamlKey;

        return $this;
    }

    public function getFrench(): ?string
    {
        return $this->french;
    }

    public function setFrench(string $french): self
    {
        $this->french = $french;

        return $this;
    }

    public function getTurkish(): ?string
    {
        return $this->turkish;
    }

    public function setTurkish(string $turkish): self
    {
        $this->turkish = $turkish;

        return $this;
    }
}
