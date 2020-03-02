<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudyRepository")
 */
class Study
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
     * @ORM\Column(type="smallint")
     */
    private $duration;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Choose", mappedBy="study")
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

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

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
            $choose->setStudy($this);
        }

        return $this;
    }

    public function removeChoose(Choose $choose): self
    {
        if ($this->chooses->contains($choose)) {
            $this->chooses->removeElement($choose);
            // set the owning side to null (unless already changed)
            if ($choose->getStudy() === $this) {
                $choose->setStudy(null);
            }
        }

        return $this;
    }
}
