<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Choose", mappedBy="specialty", cascade={"persist", "remove"})
     */
    private $choose;

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

    public function getChoose(): ?Choose
    {
        return $this->choose;
    }

    public function setChoose(?Choose $choose): self
    {
        $this->choose = $choose;

        // set (or unset) the owning side of the relation if necessary
        $newSpecialty = null === $choose ? null : $this;
        if ($choose->getSpecialty() !== $newSpecialty) {
            $choose->setSpecialty($newSpecialty);
        }

        return $this;
    }
}
