<?php

namespace App\Entity;

use App\Repository\AccessoireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity(
 *     fields={"ReferenceTMG", "ReferenceBU"},
 *     errorPath="ReferenceTMG",
 *     message="This Accesssory is already in data."
 * )
 * @ORM\Entity(repositoryClass=AccessoireRepository::class)
 */
class Accessoire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *  @Assert\Length(
     *      min = 11,   
     *      max = 12,
     *      minMessage = "ReferenceTMG must be at least {{ limit }} characters long",
     *      maxMessage = "ReferenceTMG cannot be longer than {{ limit }} characters"
     * )
     *
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $ReferenceTMG;

    /**
     * @Assert\Length(
     *      min = 11,   
     *      max = 12,
     *      minMessage = "ReferenceTMG must be at least {{ limit }} characters long",
     *      maxMessage = "ReferenceTMG cannot be longer than {{ limit }} characters"
     * )
     *
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $ReferenceBU;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $ReferenceMag;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $EmplacementMag;

    /**
     * @ORM\ManyToMany(targetEntity=Modele::class, mappedBy="accessoires")
     */
    private $modeles;

    /**
     * @Assert\NotBlank
     * @Assert\Positive
     * @Assert\Type("float")
     * @ORM\Column(type="float")
     */
    private $PrixA;

    public function __construct()
    {
        $this->modeles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferenceTMG(): ?string
    {
        return $this->ReferenceTMG;
    }

    public function setReferenceTMG(string $ReferenceTMG): self
    {
        $this->ReferenceTMG = $ReferenceTMG;

        return $this;
    }

    public function getReferenceBU(): ?string
    {
        return $this->ReferenceBU;
    }

    public function setReferenceBU(string $ReferenceBU): self
    {
        $this->ReferenceBU = $ReferenceBU;

        return $this;
    }

    public function getReferenceMag(): ?string
    {
        return $this->ReferenceMag;
    }

    public function setReferenceMag(string $ReferenceMag): self
    {
        $this->ReferenceMag = $ReferenceMag;

        return $this;
    }

    public function getEmplacementMag(): ?string
    {
        return $this->EmplacementMag;
    }

    public function setEmplacementMag(string $EmplacementMag): self
    {
        $this->EmplacementMag = $EmplacementMag;

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
            $modele->addAccessoire($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): self
    {
        if ($this->modeles->removeElement($modele)) {
            $modele->removeAccessoire($this);
        }

        return $this;
    }
    public function __toString() {       return $this->ReferenceTMG;    }

    public function getPrixA(): ?float
    {
        return $this->PrixA;
    }

    public function setPrixA(float $PrixA): self
    {
        $this->PrixA = $PrixA;

        return $this;
    }

    
}
