<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $modele_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $outil_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idfacture;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_outil;

    /**
     * @ORM\Column(type="integer")
     */
    private $temps;

    /**
     * @ORM\Column(type="float")
     */
    private $prixtotale;

    /**
     * @ORM\Column(type="integer")
     */
    private $gamme_usinage_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $energie_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $matieres_id;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_energie;

    /**
     * @ORM\Column(type="integer")
     */
    private $puissance_machine;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_totale_energie;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_matiere;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_totale_matiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_employer;

    /**
     * @ORM\Column(type="float")
     */
    private $salaire_employer;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_piece;

    /**
     * @ORM\Column(type="integer")
     */
    private $accessoire_id;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_accessoire;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite_accessoire;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_totale_accessoire;

    /**
     * @ORM\OneToMany(targetEntity=DemandeO::class, mappedBy="Facture")
     */
    private $demandeOs;

    public function __construct()
    {
        $this->demandeOs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModeleId(): ?int
    {
        return $this->modele_id;
    }

    public function setModeleId(int $modele_id): self
    {
        $this->modele_id = $modele_id;

        return $this;
    }

    public function getOutilId(): ?int
    {
        return $this->outil_id;
    }

    public function setOutilId(int $outil_id): self
    {
        $this->outil_id = $outil_id;

        return $this;
    }

    public function getIdfacture(): ?string
    {
        return $this->idfacture;
    }

    public function setIdfacture(string $idfacture): self
    {
        $this->idfacture = $idfacture;

        return $this;
    }

    public function getPrixOutil(): ?float
    {
        return $this->prix_outil;
    }

    public function setPrixOutil(float $prix_outil): self
    {
        $this->prix_outil = $prix_outil;

        return $this;
    }

    public function getTemps(): ?int
    {
        return $this->temps;
    }

    public function setTemps(int $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function getPrixtotale(): ?float
    {
        return $this->prixtotale;
    }

    public function setPrixtotale(float $prixtotale): self
    {
        $this->prixtotale = $prixtotale;

        return $this;
    }

    public function getGammeUsinageId(): ?int
    {
        return $this->gamme_usinage_id;
    }

    public function setGammeUsinageId(int $gamme_usinage_id): self
    {
        $this->gamme_usinage_id = $gamme_usinage_id;

        return $this;
    }

    public function getEnergieId(): ?int
    {
        return $this->energie_id;
    }

    public function setEnergieId(int $energie_id): self
    {
        $this->energie_id = $energie_id;

        return $this;
    }

    public function getMatieresId(): ?int
    {
        return $this->matieres_id;
    }

    public function setMatieresId(int $matieres_id): self
    {
        $this->matieres_id = $matieres_id;

        return $this;
    }

    public function getPrixEnergie(): ?float
    {
        return $this->prix_energie;
    }

    public function setPrixEnergie(float $prix_energie): self
    {
        $this->prix_energie = $prix_energie;

        return $this;
    }

    public function getPuissanceMachine(): ?int
    {
        return $this->puissance_machine;
    }

    public function setPuissanceMachine(int $puissance_machine): self
    {
        $this->puissance_machine = $puissance_machine;

        return $this;
    }

    public function getPrixTotaleEnergie(): ?float
    {
        return $this->prix_totale_energie;
    }

    public function setPrixTotaleEnergie(float $prix_totale_energie): self
    {
        $this->prix_totale_energie = $prix_totale_energie;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrixMatiere(): ?float
    {
        return $this->prix_matiere;
    }

    public function setPrixMatiere(float $prix_matiere): self
    {
        $this->prix_matiere = $prix_matiere;

        return $this;
    }

    public function getPrixTotaleMatiere(): ?float
    {
        return $this->prix_totale_matiere;
    }

    public function setPrixTotaleMatiere(float $prix_totale_matiere): self
    {
        $this->prix_totale_matiere = $prix_totale_matiere;

        return $this;
    }

    public function getNombreEmployer(): ?int
    {
        return $this->nombre_employer;
    }

    public function setNombreEmployer(int $nombre_employer): self
    {
        $this->nombre_employer = $nombre_employer;

        return $this;
    }

    public function getSalaireEmployer(): ?float
    {
        return $this->salaire_employer;
    }

    public function setSalaireEmployer(float $salaire_employer): self
    {
        $this->salaire_employer = $salaire_employer;

        return $this;
    }

    public function getNombrePiece(): ?int
    {
        return $this->nombre_piece;
    }

    public function setNombrePiece(int $nombre_piece): self
    {
        $this->nombre_piece = $nombre_piece;

        return $this;
    }

    public function getAccessoireId(): ?int
    {
        return $this->accessoire_id;
    }

    public function setAccessoireId(int $accessoire_id): self
    {
        $this->accessoire_id = $accessoire_id;

        return $this;
    }

    public function getPrixAccessoire(): ?float
    {
        return $this->prix_accessoire;
    }

    public function setPrixAccessoire(float $prix_accessoire): self
    {
        $this->prix_accessoire = $prix_accessoire;

        return $this;
    }

    public function getQuantiteAccessoire(): ?int
    {
        return $this->quantite_accessoire;
    }

    public function setQuantiteAccessoire(int $quantite_accessoire): self
    {
        $this->quantite_accessoire = $quantite_accessoire;

        return $this;
    }

    public function getPrixTotaleAccessoire(): ?float
    {
        return $this->prix_totale_accessoire;
    }

    public function setPrixTotaleAccessoire(float $prix_totale_accessoire): self
    {
        $this->prix_totale_accessoire = $prix_totale_accessoire;

        return $this;
    }

    /**
     * @return Collection|DemandeO[]
     */
    public function getDemandeOs(): Collection
    {
        return $this->demandeOs;
    }

    public function addDemandeO(DemandeO $demandeO): self
    {
        if (!$this->demandeOs->contains($demandeO)) {
            $this->demandeOs[] = $demandeO;
            $demandeO->setFacture($this);
        }

        return $this;
    }

    public function removeDemandeO(DemandeO $demandeO): self
    {
        if ($this->demandeOs->removeElement($demandeO)) {
            // set the owning side to null (unless already changed)
            if ($demandeO->getFacture() === $this) {
                $demandeO->setFacture(null);
            }
        }

        return $this;
    }
}
