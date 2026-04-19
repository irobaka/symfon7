<?php

namespace App\Entity;

use App\Repository\StarshipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use Gedmo\Mapping\Annotation\Slug;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: StarshipRepository::class)]
class Starship
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: false)]
    #[Slug(fields: ['name'])]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $captain = null;

    #[ORM\Column(length: 255)]
    private ?string $class = null;

    #[ORM\Column(enumType: StarshipStatus::class)]
    private ?StarshipStatus $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $arrivedAt = null;

    /**
     * @var Collection<int, StarshipPart>
     */
    #[ORM\OneToMany(targetEntity: StarshipPart::class, mappedBy: 'starship', fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[OrderBy(['name' => 'ASC'])]
    private Collection $starshipParts;

    public function __construct()
    {
        $this->starshipParts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCaptain(): ?string
    {
        return $this->captain;
    }

    public function setCaptain(string $captain): static
    {
        $this->captain = $captain;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): static
    {
        $this->class = $class;

        return $this;
    }

    public function getStatus(): ?StarshipStatus
    {
        return $this->status;
    }

    public function setStatus(StarshipStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getArrivedAt(): ?\DateTimeImmutable
    {
        return $this->arrivedAt;
    }

    public function setArrivedAt(\DateTimeImmutable $arrivedAt): static
    {
        $this->arrivedAt = $arrivedAt;

        return $this;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getStatusName(): string
    {
        return $this->status->value;
    }

    public function getStatusImage(): string
    {
        return $this->status->statusImage();
    }

    public function checkIn(?\DateTimeImmutable $arrivedAt = null): static
    {
        $this->arrivedAt = $arrivedAt ?? new \DateTimeImmutable();
        $this->status = StarshipStatus::WAITING;

        return $this;
    }

    /**
     * @return Collection<int, StarshipPart>
     */
    public function getStarshipParts(): Collection
    {
        return $this->starshipParts;
    }

    public function addStarshipPart(StarshipPart $starshipPart): static
    {
        if (!$this->starshipParts->contains($starshipPart)) {
            $this->starshipParts->add($starshipPart);
            $starshipPart->setStarship($this);
        }

        return $this;
    }

    public function removeStarshipPart(StarshipPart $starshipPart): static
    {
        if ($this->starshipParts->removeElement($starshipPart)) {
            // set the owning side to null (unless already changed)
            if ($starshipPart->getStarship() === $this) {
                $starshipPart->setStarship(null);
            }
        }

        return $this;
    }
}
