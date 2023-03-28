<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $message = null;

    #[ORM\OneToMany(mappedBy: 'review', targetEntity: User::class)]
    private Collection $userid;

    #[ORM\OneToMany(mappedBy: 'review', targetEntity: Office::class)]
    private Collection $officeid;

    public function __construct()
    {
        $this->userid = new ArrayCollection();
        $this->officeid = new ArrayCollection();
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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserid(): Collection
    {
        return $this->userid;
    }

    public function addUserid(User $userid): self
    {
        if (!$this->userid->contains($userid)) {
            $this->userid->add($userid);
            $userid->setReview($this);
        }

        return $this;
    }

    public function removeUserid(User $userid): self
    {
        if ($this->userid->removeElement($userid)) {
            // set the owning side to null (unless already changed)
            if ($userid->getReview() === $this) {
                $userid->setReview(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Office>
     */
    public function getOfficeid(): Collection
    {
        return $this->officeid;
    }
}
