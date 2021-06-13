<?php

namespace App\Entity;

use App\Repository\FormDataRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormDataRepository::class)
 */
class FormData
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
    private $FileNames;
    
    public function __toString()
    {
        return $this->FileNames;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $SubmittedOn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ReferenceTmg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\ManyToMany(targetEntity=DemandeO::class, inversedBy="formData")
     */
    private $files;

    public function __construct()
    {
        $this->files = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileNames(): ?string
    {
        return $this->FileNames;
    }

    public function setFileNames(string $FileNames): self
    {
        $this->FileNames = $FileNames;

        return $this;
    }

    public function getSubmittedOn(): ?\DateTimeInterface
    {
        return $this->SubmittedOn;
    }

    public function setSubmittedOn(\DateTimeInterface $SubmittedOn): self
    {
        $this->SubmittedOn = $SubmittedOn;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection|DemandeO[]
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(DemandeO $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
        }

        return $this;
    }

    public function removeFile(DemandeO $file): self
    {
        $this->files->removeElement($file);

        return $this;
    }
}
