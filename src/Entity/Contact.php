<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use PHP_CodeSniffer\Generators\Text;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
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
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $senderEmail;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $receiverEmail;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $subject;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $message;

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

    public function getSenderEmail(): ?string
    {
        return $this->senderEmail;
    }

    public function setSenderEmail(string $senderEmail): self
    {
        $this->senderEmail = $senderEmail;

        return $this;
    }

    public function getReceiverEmail(): ?string
    {
        return $this->receiverEmail;
    }

    public function setReceiverEmail(string $receiverEmail): self
    {
        $this->receiverEmail = $receiverEmail;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?text
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
