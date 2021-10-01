<?php

namespace App\Entity;

use App\Repository\BulteinRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BulteinRepository::class)
 */
class Bultein
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bultein")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $Eleve;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matiere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEleve(): ?User
    {
        return $this->Eleve;
    }

    public function setEleve(User $Eleve): self
    {
        $this->Eleve = $Eleve;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(string $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }
}
