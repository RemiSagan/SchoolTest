<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChooseRepository")
 */
class Choose
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="choose", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Specialty", inversedBy="choose", cascade={"persist", "remove"})
     */
    private $specialty;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSpecialty(): ?Specialty
    {
        return $this->specialty;
    }

    public function setSpecialty(?Specialty $specialty): self
    {
        $this->specialty = $specialty;

        return $this;
    }
}
