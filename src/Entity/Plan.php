<?php

namespace App\Entity;

use App\Repository\PlanRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=PlanRepository::class)
 */
class Plan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(
     *      min = 11,   
     *      max = 12,
     *      minMessage = "ReferenceTMG must be at least {{ limit }} characters long",
     *      maxMessage = "ReferenceTMG cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $ReferenceTmg;

    /**
     * @Assert\Type("String")
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Statut;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="integer")
     */
    private $Priorite;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datelim;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferenceTmg(): ?string
    {
        return $this->ReferenceTmg;
    }

    public function setReferenceTmg(string $ReferenceTmg): self
    {
        $this->ReferenceTmg = $ReferenceTmg;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getPriorite(): ?int
    {
        return $this->Priorite;
    }

    public function setPriorite(int $Priorite): self
    {
        $this->Priorite = $Priorite;

        return $this;
    }

    public function getDatelim(): ?\DateTimeInterface
    {
        return $this->datelim;
    }

    public function setDatelim(?\DateTimeInterface $datelim): self
    {
        $this->datelim = $datelim;

        return $this;
    }

   
}
