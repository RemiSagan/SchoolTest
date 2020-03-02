<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpecialtyRepository")
 */
class Specialty
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Choose", mappedBy="specialties")
     */
    private $chooses;

    public function __construct()
    {
        $this->chooses = new ArrayCollection();
    }

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

    /**
     * @return Collection|Choose[]
     */
    public function getChooses(): Collection
    {
        return $this->chooses;
    }

    public function addChoose(Choose $choose): self
    {
        if (!$this->chooses->contains($choose)) {
            $this->chooses[] = $choose;
            $choose->addSpecialty($this);
        }

        return $this;
    }

    public function removeChoose(Choose $choose): self
    {
        if ($this->chooses->contains($choose)) {
            $this->chooses->removeElement($choose);
            $choose->removeSpecialty($this);
        }

        return $this;
    }
}
