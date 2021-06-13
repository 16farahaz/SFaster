<?php

namespace App\Entity;

use App\Repository\DemandeORepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=DemandeORepository::class)
 */
class DemandeO
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Responsable;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Service;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $ResponsableMag;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $RefTMG;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $RefBU;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Modele;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $BU;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Doc;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $ResponsableADMI;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Confirmation;

    
    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Statut;

    /**
     *
     * @ORM\Column(type="integer")
     */
    private $Priorite;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $ResponsableTechnique;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $confirmationDemande;

   
    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $ReferenceMag;

    /**
     * @Assert\NotBlank
     * @ORM\ManyToMany(targetEntity=FormData::class, mappedBy="files")
     */
    private $formData;

    /**
     * @ORM\ManyToOne(targetEntity=Facture::class, inversedBy="demandeOs")
     */
    private $Facture;
    

    public function __toString() {

        return $this->FileNames;
    }

    public function __construct()
    {
        $this->formData = new ArrayCollection();
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResponsable(): ?string
    {
        return $this->Responsable;
    }

    public function setResponsable(string $Responsable): self
    {
        $this->Responsable = $Responsable;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->Service;
    }

    public function setService(string $Service): self
    {
        $this->Service = $Service;

        return $this;
    }

    public function getResponsableMag(): ?string
    {
        return $this->ResponsableMag;
    }

    public function setResponsableMag(string $ResponsableMag): self
    {
        $this->ResponsableMag = $ResponsableMag;

        return $this;
    }

    public function getRefTMG(): ?string
    {
        return $this->RefTMG;
    }

    public function setRefTMG(string $RefTMG): self
    {
        $this->RefTMG = $RefTMG;

        return $this;
    }

    public function getRefBU(): ?string
    {
        return $this->RefBU;
    }

    public function setRefBU(string $RefBU): self
    {
        $this->RefBU = $RefBU;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->Modele;
    }

    public function setModele(string $Modele): self
    {
        $this->Modele = $Modele;

        return $this;
    }

    public function getBU(): ?string
    {
        return $this->BU;
    }

    public function setBU(string $BU): self
    {
        $this->BU = $BU;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDoc(): ?string
    {
        return $this->Doc;
    }

    public function setDoc(string $Doc): self
    {
        $this->Doc = $Doc;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getResponsableADMI(): ?string
    {
        return $this->ResponsableADMI;
    }

    public function setResponsableADMI(string $ResponsableADMI): self
    {
        $this->ResponsableADMI = $ResponsableADMI;

        return $this;
    }

    public function getConfirmation(): ?string
    {
        return $this->Confirmation;
    }

    public function setConfirmation(string $Confirmation): self
    {
        $this->Confirmation = $Confirmation;

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

    public function getResponsableTechnique(): ?string
    {
        return $this->ResponsableTechnique;
    }

    public function setResponsableTechnique(string $ResponsableTechnique): self
    {
        $this->ResponsableTechnique = $ResponsableTechnique;

        return $this;
    }

    public function getConfirmationDemande(): ?string
    {
        return $this->confirmationDemande;
    }

    public function setConfirmationDemande(string $confirmationDemande): self
    {
        $this->confirmationDemande = $confirmationDemande;

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

    /**
     * @return Collection|FormData[]
     */
    public function getFormData(): Collection
    {
        return $this->formData;
    }

    public function addFormData(FormData $formData): self
    {
        if (!$this->formData->contains($formData)) {
            $this->formData[] = $formData;
            $formData->addFile($this);
        }

        return $this;
    }

    public function removeFormData(FormData $formData): self
    {
        if ($this->formData->removeElement($formData)) {
            $formData->removeFile($this);
        }

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->Facture;
    }

    public function setFacture(?Facture $Facture): self
    {
        $this->Facture = $Facture;

        return $this;
    }
}
