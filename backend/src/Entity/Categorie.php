<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    public $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=255, nullable=false)
     */
    public $description;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    public $slug;

    /**
     * @var bool
     *
     * @ORM\Column(name="en_ligne", type="boolean", nullable=false)
     */
    public $enLigne;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation", type="datetime", nullable=false)
     */
    public $creation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modification", type="datetime", nullable=false)
     */
    public $modification;

  /**
   * Categorie constructor.
   *
   */
  public function __construct() {
    $this->articles = new ArrayCollection();
  }


  public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getEnLigne(): ?bool
    {
        return $this->enLigne;
    }

    public function setEnLigne(bool $enLigne): self
    {
        $this->enLigne = $enLigne;

        return $this;
    }

    public function getCreation(): ?\DateTimeInterface
    {
        return $this->creation;
    }

    public function setCreation(\DateTimeInterface $creation): self
    {
        $this->creation = $creation;

        return $this;
    }

    public function getModification(): ?\DateTimeInterface
    {
        return $this->modification;
    }

    public function setModification(\DateTimeInterface $modification): self
    {
        $this->modification = $modification;

        return $this;
    }


}
