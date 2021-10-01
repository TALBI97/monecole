<?php

namespace App\Entity;

use App\Repository\LineClassEleveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LineClassEleveRepository::class)
 */
class LineClassEleve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="lineClassEleves" )
     * @ORM\JoinColumn(onDelete="CASCADE") 
     */
    private $idClasse;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="lineClassEleves") 
     * @ORM\JoinColumn(onDelete="CASCADE") 
     */
    private $idEleve;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClasse(): ?Classe
    {
        return $this->idClasse;
    }

    public function setIdClasse(?Classe $idClasse): self
    {
        $this->idClasse = $idClasse;

        return $this;
    }

    public function getIdEleve(): ?User
    {
        return $this->idEleve;
    }

    public function setIdEleve(?User $idEleve): self
    {
        $this->idEleve = $idEleve;

        return $this;
    }
}
