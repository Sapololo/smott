<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity()
 */
class Event {

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="IDENTITY")
   */
  private $id;

  /**
   * @var int
   *
   * @ORM\Column(name="user_id", type="integer", nullable=false)
   */
  private $userId;

  /**
   * @var string
   *
   * @ORM\Column(name="titre", type="string", length=255, nullable=false)
   */
  private $titre;

  /**
   * @var string|null
   *
   * @ORM\Column(name="contenu", type="text", length=65535, nullable=true)
   */
  private $contenu;

  /**
   * @var string
   *
   * @ORM\Column(name="contenu_meta", type="text", length=65535, nullable=false)
   */
  private $contenuMeta;

  /**
   * @var string
   *
   * @ORM\Column(name="slug", type="string", length=255, nullable=false)
   */
  private $slug;

  /**
   * @var string
   *
   * @ORM\Column(name="lien", type="string", length=255, nullable=false)
   */
  private $lien;

  /**
   * @var string
   *
   * @ORM\Column(name="image", type="string", length=255, nullable=false)
   */
  private $image;

  /**
   * @var bool
   *
   * @ORM\Column(name="en_ligne", type="boolean", nullable=false,
   *   options={"default"="1"})
   */
  private $enLigne = '1';

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="debut", type="datetime", nullable=false)
   */
  private $debut;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="fin", type="datetime", nullable=false)
   */
  private $fin;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="creation", type="datetime", nullable=false)
   */
  private $creation;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="modification", type="datetime", nullable=false)
   */
  private $modification;

  public function getId(): ?int {
    return $this->id;
  }

  public function getUserId(): ?int {
    return $this->userId;
  }

  public function setUserId(int $userId): self {
    $this->userId = $userId;

    return $this;
  }

  public function getTitre(): ?string {
    return $this->titre;
  }

  public function setTitre(string $titre): self {
    $this->titre = $titre;

    return $this;
  }

  public function getContenu(): ?string {
    return $this->contenu;
  }

  public function setContenu(?string $contenu): self {
    $this->contenu = $contenu;

    return $this;
  }

  public function getContenuMeta(): ?string {
    return $this->contenuMeta;
  }

  public function setContenuMeta(string $contenuMeta): self {
    $this->contenuMeta = $contenuMeta;

    return $this;
  }

  public function getSlug(): ?string {
    return $this->slug;
  }

  public function setSlug(string $slug): self {
    $this->slug = $slug;

    return $this;
  }

  public function getLien(): ?string {
    return $this->lien;
  }

  public function setLien(string $lien): self {
    $this->lien = $lien;

    return $this;
  }

  public function getImage(): ?string {
    return $this->image;
  }

  public function setImage(string $image): self {
    $this->image = $image;

    return $this;
  }

  public function getEnLigne(): ?bool {
    return $this->enLigne;
  }

  public function setEnLigne(bool $enLigne): self {
    $this->enLigne = $enLigne;

    return $this;
  }

  public function getDebut(): ?\DateTimeInterface {
    return $this->debut;
  }

  public function setDebut(\DateTimeInterface $debut): self {
    $this->debut = $debut;

    return $this;
  }

  public function getFin(): ?\DateTimeInterface {
    return $this->fin;
  }

  public function setFin(\DateTimeInterface $fin): self {
    $this->fin = $fin;

    return $this;
  }

  public function getCreation(): ?\DateTimeInterface {
    return $this->creation;
  }

  public function setCreation(\DateTimeInterface $creation): self {
    $this->creation = $creation;

    return $this;
  }

  public function getModification(): ?\DateTimeInterface {
    return $this->modification;
  }

  public function setModification(\DateTimeInterface $modification): self {
    $this->modification = $modification;

    return $this;
  }

  public function __construct() {
    $this->categories = new ArrayCollection();
  }

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Badge")
   */
  private $badge;

  public function getBadge(): ?Badge {
    return $this->badge;
  }

  public function setBadge(?Badge $badge): self {
    $this->badge = $badge;

    return $this;
  }

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Categorie")
   */
  private $categorie;

  public function getCategorie(): ?Categorie {
    return $this->categorie;
  }

  public function setCategorie(?Categorie $categorie): self {
    $this->categorie = $categorie;

    return $this;
  }

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Carte")
   */
  private $carte;

  public function getCarte(): ?Carte {
    return $this->carte;
  }

  public function setCarte(?Carte $carte): self {
    $this->carte = $carte;

    return $this;
  }
}
