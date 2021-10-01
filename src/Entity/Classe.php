<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
class Classe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="classes")
     * @ORM\JoinColumn(onDelete="CASCADE")

     */
    private $instituteur;

    /**
     * @ORM\OneToMany(targetEntity=LineClassEleve::class, mappedBy="idClasse", cascade={"remove"})
     */
    private $lineClassEleves;

    public function __construct()
    {
        $this->lineClassEleves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getInstituteur(): ?User
    {
        return $this->instituteur;
    }

    public function setInstituteur(?User $instituteur): self
    {
        $this->instituteur = $instituteur;

        return $this;
    }

    /**
     * @return Collection|LineClassEleve[]
     */
    public function getLineClassEleves(): Collection
    {
        return $this->lineClassEleves;
    }

    public function addLineClassElefe(LineClassEleve $lineClassElefe): self
    {
        if (!$this->lineClassEleves->contains($lineClassElefe)) {
            $this->lineClassEleves[] = $lineClassElefe;
            $lineClassElefe->setIdClasse($this);
        }

        return $this;
    }

    public function removeLineClassElefe(LineClassEleve $lineClassElefe): self
    {
        if ($this->lineClassEleves->removeElement($lineClassElefe)) {
            // set the owning side to null (unless already changed)
            if ($lineClassElefe->getIdClasse() === $this) {
                $lineClassElefe->setIdClasse(null);
            }
        }

        return $this;
    }
}
