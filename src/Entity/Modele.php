<?php

namespace App\Entity;
use App\Entity\Matiere;
use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ModeleRepository::class)
 */
class Modele
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
     *   @Assert\Length(
     *      min = 11,
     *      max = 12,
     *      minMessage = "ReferenceBU must be at least {{ limit }} characters long",
     *      maxMessage = "ReferenceBU cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $ReferenceBU;

    /**
     * @Assert\GreaterThan(0)
     * @Assert\Positive
     * @Assert\Type("integer")
     * @Assert\NotBlank
     * @ORM\Column(type="integer")
     */
    private $NombreDePiece;

    /**
     * @Assert\NotBlank
     * @ORM\ManyToMany(targetEntity=Matiere::class, inversedBy="modeles")
     */
    private $matieres;

    /**
     * @Assert\NotBlank
     * @ORM\ManyToMany(targetEntity=GammeUsinage::class, inversedBy="modeles")
     */
    private $relation2;

    /**
     * @Assert\NotBlank
     * @ORM\ManyToMany(targetEntity=Energie::class, inversedBy="modeles")
     */
    private $energies;

    /**
     * @Assert\NotBlank
     * @ORM\ManyToMany(targetEntity=Accessoire::class, inversedBy="modeles")
     */
    private $accessoires;

    /**
     * @Assert\NotBlank
     * @ORM\ManyToMany(targetEntity=Outils::class, inversedBy="modeles")
     */
    private $outils;

    public function __construct()
    {
        $this->matieres = new ArrayCollection();
        $this->relation2 = new ArrayCollection();
        $this->energies = new ArrayCollection();
        $this->accessoires = new ArrayCollection();
        $this->outils = new ArrayCollection();
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

    public function getNombreDePiece(): ?int
    {
        return $this->NombreDePiece;
    }

    public function setNombreDePiece(int $NombreDePiece): self
    {
        $this->NombreDePiece = $NombreDePiece;

        return $this;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        $this->matieres->removeElement($matiere);

        return $this;
    }
    public function __toString() {
       return $this->Nom;
 
     }

    /**
     * @return Collection|GammeUsinage[]
     */
    public function getRelation2(): Collection
    {
        return $this->relation2;
    }

    public function addRelation2(GammeUsinage $relation2): self
    {
        if (!$this->relation2->contains($relation2)) {
            $this->relation2[] = $relation2;
        }

        return $this;
    }

    public function removeRelation2(GammeUsinage $relation2): self
    {
        $this->relation2->removeElement($relation2);

        return $this;
    }

    /**
     * @return Collection|Energie[]
     */
    public function getEnergies(): Collection
    {
        return $this->energies;
    }

    public function addEnergy(Energie $energy): self
    {
        if (!$this->energies->contains($energy)) {
            $this->energies[] = $energy;
        }

        return $this;
    }

    public function removeEnergy(Energie $energy): self
    {
        $this->energies->removeElement($energy);

        return $this;
    }

    /**
     * @return Collection|Accessoire[]
     */
    public function getAccessoires(): Collection
    {
        return $this->accessoires;
    }

    public function addAccessoire(Accessoire $accessoire): self
    {
        if (!$this->accessoires->contains($accessoire)) {
            $this->accessoires[] = $accessoire;
        }

        return $this;
    }

    public function removeAccessoire(Accessoire $accessoire): self
    {
        $this->accessoires->removeElement($accessoire);

        return $this;
    }

    /**
     * @return Collection|Outils[]
     */
    public function getOutils(): Collection
    {
        return $this->outils;
    }

    public function addOutil(Outils $outil): self
    {
        if (!$this->outils->contains($outil)) {
            $this->outils[] = $outil;
        }

        return $this;
    }

    public function removeOutil(Outils $outil): self
    {
        $this->outils->removeElement($outil);

        return $this;
    }

 
   
}
