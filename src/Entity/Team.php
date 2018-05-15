<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="team")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    public function __construct()
    {
        $this->name = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getName(): Collection
    {
        return $this->name;
    }

    public function addName(User $name): self
    {
        if (!$this->name->contains($name)) {
            $this->name[] = $name;
            $name->setTeam($this);
        }

        return $this;
    }

    public function removeName(User $name): self
    {
        if ($this->name->contains($name)) {
            $this->name->removeElement($name);
            // set the owning side to null (unless already changed)
            if ($name->getTeam() === $this) {
                $name->setTeam(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
