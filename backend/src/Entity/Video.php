<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity()
 */
class Video
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;


  /**
   * @var int
   *
   * @ORM\Column(name="user_id", type="integer", nullable=false)
   */
  private $userId;

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
   * @ORM\Column(name="lien", type="string", length=255, nullable=true)
   */
  private $lien;

  /**
   * @var bool
   *
   * @ORM\Column(name="en_ligne", type="boolean", nullable=false)
   */
  private $enLigne;

  /**
   * @var bool
   *
   * @ORM\Column(name="important", type="boolean", nullable=false)
   */
  private $important;

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

  /**
   * @return int
   */
  public function getId(): int {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId(int $id): void {
    $this->id = $id;
  }

  /**
   * @return int
   */
  public function getUserId(): int {
    return $this->userId;
  }

  /**
   * @param int $userId
   */
  public function setUserId(int $userId): void {
    $this->userId = $userId;
  }

  /**
   * @return null|string
   */
  public function getTitre(): ?string {
    return $this->titre;
  }

  /**
   * @param null|string $titre
   */
  public function setTitre(?string $titre): void {
    $this->titre = $titre;
  }

  /**
   * @return null|string
   */
  public function getSlug(): ?string {
    return $this->slug;
  }

  /**
   * @param null|string $slug
   */
  public function setSlug(?string $slug): void {
    $this->slug = $slug;
  }

  /**
   * @return null|string
   */
  public function getLien(): ?string {
    return $this->lien;
  }

  /**
   * @param null|string $lien
   */
  public function setLien(?string $lien): void {
    $this->lien = $lien;
  }

  public function getEnLigne(): ?bool
  {
    return $this->enLigne;
  }


  /**
   * @param bool $enLigne
   */
  public function setEnLigne(bool $enLigne): void {
    $this->enLigne = $enLigne;
  }

  /**
   * @return bool
   */
  public function isImportant(): bool {
    return $this->important;
  }

  /**
   * @param bool $important
   */
  public function setImportant(bool $important): void {
    $this->important = $important;
  }

  /**
   * @return \DateTime|null
   */
  public function getCreation(): ?\DateTime {
    return $this->creation;
  }

  /**
   * @param \DateTime|null $creation
   */
  public function setCreation(?\DateTime $creation): void {
    $this->creation = $creation;
  }

  /**
   * @return \DateTime|null
   */
  public function getModification(): ?\DateTime {
    return $this->modification;
  }

  /**
   * @param \DateTime|null $modification
   */
  public function setModification(?\DateTime $modification): void {
    $this->modification = $modification;
  }

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Categorie")
   */
  private $categorie;

  public function getCategorie(): ?Categorie
  {
    return $this->categorie;
  }

  public function setCategorie(?Categorie $categorie): self
  {
    $this->categorie = $categorie;

    return $this;
  }
}
