<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Article {

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  public $id;

  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  public $category_id;

  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  public $user_id;

  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  public $badge_id;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  public $titre;

  /**
   * @ORM\Column(type="text", nullable=true)
   */
  public $contenu;

  /**
   * @ORM\Column(type="text", nullable=true)
   */
  public $contenu_meta;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  public $slug;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  public $lien;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  public $pdf;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  public $image;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  public $page;

  /**
   * @ORM\Column(type="integer", length=1, options={"default":0})
   */
  public $en_ligne;

  /**
   * @ORM\Column(type="datetime", nullable=true)
   */
  public $creation;

  /**
   * @ORM\Column(type="datetime", nullable=true)
   */
  public $modification;

  //Getters and Setters

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id): void {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getCategorieId() {
    return $this->categorie_id;
  }

  /**
   * @param mixed $category_id
   */
  public function setCategorieId($category_id): void {
    $this->category_id = $category_id;
  }

  /**
   * @return mixed
   */
  public function getUserId() {
    return $this->user_id;
  }

  /**
   * @param mixed $user_id
   */
  public function setUserId($user_id): void {
    $this->user_id = $user_id;
  }

  /**
   * @return mixed
   */
  public function getBadgeId() {
    return $this->badge_id;
  }

  /**
   * @param mixed $badge_id
   */
  public function setBadgeId($badge_id): void {
    $this->badge_id = $badge_id;
  }

  /**
   * @return mixed
   */
  public function getTitre() {
    return $this->titre;
  }

  /**
   * @param mixed $titre
   */
  public function setTitre($titre): void {
    $this->titre = $titre;
  }

  /**
   * @return mixed
   */
  public function getContenu() {
    return $this->contenu;
  }

  /**
   * @param mixed $contenu
   */
  public function setContenu($contenu): void {
    $this->contenu = $contenu;
  }

  /**
   * @return mixed
   */
  public function getContenuMeta() {
    return $this->contenu_meta;
  }

  /**
   * @param mixed $contenu_meta
   */
  public function setContenuMeta($contenu_meta): void {
    $this->contenu_meta = $contenu_meta;
  }

  /**
   * @return mixed
   */
  public function getSlug() {
    return $this->slug;
  }

  /**
   * @param mixed $slug
   */
  public function setSlug($slug): void {
    $this->slug = $slug;
  }

  /**
   * @return mixed
   */
  public function getLien() {
    return $this->lien;
  }

  /**
   * @param mixed $lien
   */
  public function setLien($lien): void {
    $this->lien = $lien;
  }

  /**
   * @return mixed
   */
  public function getPdf() {
    return $this->pdf;
  }

  /**
   * @param mixed $pdf
   */
  public function setPdf($pdf): void {
    $this->pdf = $pdf;
  }

  /**
   * @return mixed
   */
  public function getImage() {
    return $this->image;
  }

  /**
   * @param mixed $image
   */
  public function setImage($image): void {
    $this->image = $image;
  }

  /**
   * @return mixed
   */
  public function getPage() {
    return $this->page;
  }

  /**
   * @param mixed $page
   */
  public function setPage($page): void {
    $this->page = $page;
  }

  /**
   * @return mixed
   */
  public function getEnLigne() {
    return $this->en_ligne;
  }

  /**
   * @param mixed $en_ligne
   */
  public function setEnLigne($en_ligne): void {
    $this->en_ligne = $en_ligne;
  }

  /**
   * @return mixed
   */
  public function getCreation() {
    return $this->creation;
  }

  /**
   * @param mixed $creation
   */
  public function setCreation($creation): void {
    $this->creation = $creation;
  }

  /**
   * @return mixed
   */
  public function getModification() {
    return $this->modification;
  }

  /**
   * @param mixed $modification
   */
  public function setModification($modification): void {
    $this->modification = $modification;
  }

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Badge")
   */
  private $badge;

  public function getBadge(): ?Badge
  {
    return $this->badge;
  }

  public function setBadge(?Badge $badge): self
  {
    $this->badge = $badge;

    return $this;
  }

}
