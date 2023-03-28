<?php

namespace App\Entity;

use App\Repository\OfficeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfficeRepository::class)]
class Office
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $officeid = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $surface = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $duration = null;

    #[ORM\ManyToOne(inversedBy: 'officeid')]
    private ?Review $review = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'offices')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOfficeid(): ?int
    {
        return $this->officeid;
    }

    public function setOfficeid(int $officeid): self
    {
        $this->officeid = $officeid;

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

    public function getSurface(): ?string
    {
        return $this->surface;
    }

    public function setSurface(string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getReview(): ?Review
    {
        return $this->review;
    }

    public function setReview(?Review $review): self
    {
        $this->review = $review;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
