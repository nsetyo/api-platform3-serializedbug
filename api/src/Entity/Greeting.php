<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(normalizationContext: [
    'groups' => ['read']
])]
#[ORM\Entity]
class Greeting
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    #[Groups('read')]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups('read')]
    private string $name = '';

    #[ORM\ManyToOne]
    #[Groups('read')]
    private ?Organization $org = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOrg(): ?Organization
    {
        return $this->org;
    }

    public function setOrg(?Organization $org): self
    {
        $this->org = $org;

        return $this;
    }
}
