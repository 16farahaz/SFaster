<?php

namespace App\Entity;

use App\Repository\GammeUsinageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=GammeUsinageRepository::class)
 */
class GammeUsinage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Type("string")
     * @ORM\Column(type="string", length=255)
     */
    private $Operation;

    /**
     * @Assert\Type("string")
     * @ORM\Column(type="string", length=255)
     */
    private $Machine;

    
    /**
     * @ORM\ManyToMany(targetEntity=Modele::class, mappedBy="relation2")
     */
    private $modeles;

    /**
     * @Assert\Positive
     * @ORM\Column(type="float")
     */
    private $PuissanceMachine;

    public function __construct()
    {
        $this->modeles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOperation(): ?string
    {
        return $this->Operation;
    }

    public function setOperation(string $Operation): self
    {
        $this->Operation = $Operation;

        return $this;
    }

    public function getMachine(): ?string
    {
        return $this->Machine;
    }

    public function setMachine(string $Machine): self
    {
        $this->Machine = $Machine;

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
            $modele->addRelation2($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): self
    {
        if ($this->modeles->removeElement($modele)) {
            $modele->removeRelation2($this);
        }

        return $this;
    }

    public function getPuissanceMachine(): ?float
    {
        return $this->PuissanceMachine;
    }

    public function setPuissanceMachine(float $PuissanceMachine): self
    {
        $this->PuissanceMachine = $PuissanceMachine;

        return $this;
    }
}
