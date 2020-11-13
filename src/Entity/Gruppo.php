<?php

namespace App\Entity;

use App\Repository\GruppoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GruppoRepository::class)
 */
class Gruppo
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
    private $nome;

    /**
     * @ORM\Column(type="integer")
     */
    private $utenti;

    /**
     * @ORM\OneToMany(targetEntity=Utenti::class, mappedBy="gruppo")
     */
    private $utentis;

    public function __construct()
    {
        $this->utentis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getUtenti(): ?int
    {
        return $this->utenti;
    }

    public function setUtenti(int $utenti): self
    {
        $this->utenti = $utenti;

        return $this;
    }

    /**
     * @return Collection|Utenti[]
     */
    public function getUtentis(): Collection
    {
        return $this->utentis;
    }

    public function addUtenti(Utenti $utenti): self
    {
        if (!$this->utentis->contains($utenti)) {
            $this->utentis[] = $utenti;
            $utenti->setGruppo($this);
        }

        return $this;
    }

    public function removeUtenti(Utenti $utenti): self
    {
        if ($this->utentis->removeElement($utenti)) {
            // set the owning side to null (unless already changed)
            if ($utenti->getGruppo() === $this) {
                $utenti->setGruppo(null);
            }
        }

        return $this;
    }
}
