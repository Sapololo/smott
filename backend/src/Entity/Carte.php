<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cartes")
 * @ORM\Entity(repositoryClass="App\Repository\CarteRepository")
 */
class Carte {

  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  public $id;

  /**
   * @ORM\Column(type="decimal", precision=16, scale=14, nullable=true)
   */
  public $latitude;

  /**
   * @ORM\Column(type="decimal", precision=16, scale=14, nullable=true)
   */
  public $longitude;

  /**
   * @ORM\Column(name="club_id", type="string", length=8, nullable=true)
   */
  public $clubId;

  /**
   * @ORM\Column(name="slug", type="string", length=255, nullable=true)
   */
  public $slug;

  /**
   * @ORM\Column(name="nom", type="string", length=255, nullable=true)
   */
  public $nom;

  /**
   * @ORM\Column(name="email", type="string", length=255, nullable=true)
   */
  public $email;

  /**
   * @ORM\Column(name="contenu", nullable=true)
   */
  public $contenu;

  /**
   * @ORM\Column(name="lien", type="string", length=255, nullable=true)
   */
  public $lien;

  /**
   * @ORM\Column(name="nomsalle", type="string", length=255, nullable=true)
   */
  public $nomsalle;

  /**
   * @ORM\Column(name="adressesalle1", type="string", length=255, nullable=true)
   */
  public $adressesalle1;

  /**
   * @ORM\Column(name="adressesalle2", type="string", length=255, nullable=true)
   */
  public $adressesalle2;

  /**
   * @ORM\Column(name="adressesalle3", type="string", length=255, nullable=true)
   */
  public $adressesalle3;

  /**
   * @ORM\Column(name="codepsalle", type="string", length=5, nullable=true)
   */
  public $codepsalle;

  /**
   * @ORM\Column(name="villesalle", type="string", length=255, nullable=true)
   */
  public $villesalle;

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
   * @return mixed
   */
  public function getLatitude() {
    return $this->latitude;
  }

  /**
   * @param mixed $latitude
   */
  public function setLatitude($latitude): void {
    $this->latitude = $latitude;
  }

  /**
   * @return mixed
   */
  public function getLongitude() {
    return $this->longitude;
  }

  /**
   * @param mixed $longitude
   */
  public function setLongitude($longitude): void {
    $this->longitude = $longitude;
  }

  /**
   * @return mixed
   */
  public function getClubId() {
    return $this->clubId;
  }

  /**
   * @param mixed $clubId
   */
  public function setClubId($clubId): void {
    $this->clubId = $clubId;
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
  public function getNom() {
    return $this->nom;
  }

  /**
   * @param mixed $nom
   */
  public function setNom($nom): void {
    $this->nom = $nom;
  }

  /**
   * @return mixed
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * @param mixed $email
   */
  public function setEmail($email): void {
    $this->email = $email;
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
  public function getNomsalle() {
    return $this->nomsalle;
  }

  /**
   * @param mixed $nomsalle
   */
  public function setNomsalle($nomsalle): void {
    $this->nomsalle = $nomsalle;
  }

  /**
   * @return mixed
   */
  public function getAdressesalle1() {
    return $this->adressesalle1;
  }

  /**
   * @param mixed $adressesalle1
   */
  public function setAdressesalle1($adressesalle1): void {
    $this->adressesalle1 = $adressesalle1;
  }

  /**
   * @return mixed
   */
  public function getAdressesalle2() {
    return $this->adressesalle2;
  }

  /**
   * @param mixed $adressesalle2
   */
  public function setAdressesalle2($adressesalle2): void {
    $this->adressesalle2 = $adressesalle2;
  }

  /**
   * @return mixed
   */
  public function getAdressesalle3() {
    return $this->adressesalle3;
  }

  /**
   * @param mixed $adressesalle3
   */
  public function setAdressesalle3($adressesalle3): void {
    $this->adressesalle3 = $adressesalle3;
  }

  /**
   * @return mixed
   */
  public function getCodepsalle() {
    return $this->codepsalle;
  }

  /**
   * @param mixed $codepsalle
   */
  public function setCodepsalle($codepsalle): void {
    $this->codepsalle = $codepsalle;
  }

  /**
   * @return mixed
   */
  public function getVillesalle() {
    return $this->villesalle;
  }

  /**
   * @param mixed $villesalle
   */
  public function setVillesalle($villesalle): void {
    $this->villesalle = $villesalle;
  }
}
