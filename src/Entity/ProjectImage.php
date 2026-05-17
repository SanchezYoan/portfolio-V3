<?php

namespace App\Entity;

use App\Repository\ProjectImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectImageRepository::class)]
class ProjectImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $image;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Projects $project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getProject(): Projects
    {
        return $this->project;
    }

    public function setProject(Projects $project): static
    {
        $this->project = $project;

        return $this;
    }
}
