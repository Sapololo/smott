<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Partenaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId;

    /**
     * @var bool
     *
     * @ORM\Column(name="en_ligne", type="boolean", nullable=false)
     */
    private $enLigne;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer", nullable=false)
     */
    private $ordre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="titre", type="string", length=250, nullable=true)
     */
    private $titre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug", type="string", length=250, nullable=true)
     */
    private $slug;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=true)
     */
    private $contenu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lien", type="string", length=255, nullable=true)
     */
    private $lien;

    /**
     * @var string|null
     *
     * @ORM\Column(name="taille", type="string", length=250, nullable=true)
     */
    private $taille;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=250, nullable=true)
     */
    private $image;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image_large", type="string", length=250, nullable=true)
     */
    private $imageLarge;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image_nb", type="string", length=250, nullable=true)
     */
    private $imageNb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lat", type="decimal", precision=9, scale=7, nullable=true)
     */
    private $lat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lng", type="decimal", precision=9, scale=7, nullable=true)
     */
    private $lng;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="creation", type="datetime", nullable=true)
     */
    private $creation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="modification", type="datetime", nullable=true)
     */
    private $modification;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorieId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategorieId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

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

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(?string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(?string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageLarge(): ?string
    {
        return $this->imageLarge;
    }

    public function setImageLarge(?string $imageLarge): self
    {
        $this->imageLarge = $imageLarge;

        return $this;
    }

    public function getImageNb(): ?string
    {
        return $this->imageNb;
    }

    public function setImageNb(?string $imageNb): self
    {
        $this->imageNb = $imageNb;

        return $this;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function setLat($lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng()
    {
        return $this->lng;
    }

    public function setLng($lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getCreation(): ?\DateTimeInterface
    {
        return $this->creation;
    }

    public function setCreation(?\DateTimeInterface $creation): self
    {
        $this->creation = $creation;

        return $this;
    }

    public function getModification(): ?\DateTimeInterface
    {
        return $this->modification;
    }

    public function setModification(?\DateTimeInterface $modification): self
    {
        $this->modification = $modification;

        return $this;
    }


}
