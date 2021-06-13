<?php

namespace App\Entity;

use App\Repository\OutilsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OutilsRepository::class)
 */
class Outils
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
    private $Outil;

    /**
     * @ORM\Column(type="integer")
     */
    private $DureeDeVie;

    /**
     * @ORM\Column(type="float")
     */
    private $PrixO;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $caracteristique;

    /**
     * @ORM\ManyToMany(targetEntity=Modele::class, mappedBy="outils")
     */
    private $modeles;

    public function __construct()
    {
        $this->modeles = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOutil(): ?string
    {
        return $this->Outil;
    }

    public function setOutil(string $Outil): self
    {
        $this->Outil = $Outil;

        return $this;
    }

    public function getDureeDeVie(): ?int
    {
        return $this->DureeDeVie;
    }

    public function setDureeDeVie(int $DureeDeVie): self
    {
        $this->DureeDeVie = $DureeDeVie;

        return $this;
    }

    public function getPrixO(): ?float
    {
        return $this->PrixO;
    }

    public function setPrixO(float $PrixO): self
    {
        $this->PrixO = $PrixO;

        return $this;
    }

    public function getCaracteristique(): ?string
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(string $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    /**
     * @return Collection|Modele[]
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function addModele(Modele $modele): self
    {
        if (!$this->modeles->contains($modele)) {
            $this->modeles[] = $modele;
            $modele->addOutil($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): self
    {
        if ($this->modeles->removeElement($modele)) {
            $modele->removeOutil($this);
        }

        return $this;
    }

    
}
