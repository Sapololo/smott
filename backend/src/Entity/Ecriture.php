<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="ecritures")
 */
class Ecriture {

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  public $id;

  /**
   * @ORM\Column(type="date", nullable=false)
   */
  public $dtecr;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @var string|null
   */
  public $designation;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @var string|null
   */
  public $commentaire;

  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  public $piece_id;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @var string|null
   */
  public $titulaire;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @var string|null
   */
  public $titulaire_banque;

  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  public $num_chq;

  /**
   * @ORM\Column(type="decimal", precision=11, scale=2, nullable=true)
   */
  public $montant;

  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  public $num_depot;

  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  public $num_releve;

  /**
   * @ORM\Column(type="boolean", options={"default":0})
   */
  public $en_ligne;

  /**
   * @ORM\Column(type="date", nullable=true)
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
  public function getDtecr() {
    return $this->dtecr->format('Y-m-d H:i:s');
  }

  /**
   * @param mixed $dtecr
   */
  public function setDtecr($dtecr): void {
    $this->dtecr = $dtecr;
  }

  /**
   * @return null|string
   */
  public function getDesignation(): ?string {
    return $this->designation;
  }

  /**
   * @param null|string $designation
   */
  public function setDesignation(?string $designation): void {
    $this->designation = $designation;
  }

  /**
   * @return null|string
   */
  public function getCommentaire(): ?string {
    return $this->commentaire;
  }

  /**
   * @param null|string $commentaire
   */
  public function setCommentaire(?string $commentaire): void {
    $this->commentaire = $commentaire;
  }

  /**
   * @return mixed
   */
  public function getPieceId() {
    return $this->piece_id;
  }

  /**
   * @param mixed $piece_id
   */
  public function setPieceId($piece_id): void {
    $this->piece_id = $piece_id;
  }

  /**
   * @return null|string
   */
  public function getTitulaire(): ?string {
    return $this->titulaire;
  }

  /**
   * @param null|string $titulaire
   */
  public function setTitulaire(?string $titulaire): void {
    $this->titulaire = $titulaire;
  }

  /**
   * @return null|string
   */
  public function getTitulaireBanque(): ?string {
    return $this->titulaire_banque;
  }

  /**
   * @param null|string $titulaire_banque
   */
  public function setTitulaireBanque(?string $titulaire_banque): void {
    $this->titulaire_banque = $titulaire_banque;
  }

  /**
   * @return mixed
   */
  public function getNumChq() {
    return $this->num_chq;
  }

  /**
   * @param mixed $num_chq
   */
  public function setNumChq($num_chq): void {
    $this->num_chq = $num_chq;
  }

  /**
   * @return mixed
   */
  public function getMontant() {
    return $this->montant;
  }

  /**
   * @param mixed $montant
   */
  public function setMontant($montant): void {
    $this->montant = $montant;
  }

  /**
   * @return mixed
   */
  public function getNumDepot() {
    return $this->num_depot;
  }

  /**
   * @param mixed $num_depot
   */
  public function setNumDepot($num_depot): void {
    $this->num_depot = $num_depot;
  }

  /**
   * @return mixed
   */
  public function getNumReleve() {
    return $this->num_releve;
  }

  /**
   * @param mixed $num_releve
   */
  public function setNumReleve($num_releve): void {
    $this->num_releve = $num_releve;
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
   * @ORM\ManyToOne(targetEntity="App\Entity\Ecrrubrique")
   */
  private $ecrrubrique;

  public function getEcrrubrique(): ?Ecrrubrique {
    return $this->ecrrubrique;
  }

  public function setEcrrubrique(?Ecrrubrique $ecrrubrique): self {
    $this->ecrrubrique = $ecrrubrique;

    return $this;
  }

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\User")
   * @ORM\JoinColumn(name="licence_id", referencedColumnName="licence_id")
   */
  private $user;

  public function getUser(): ?User {
    return $this->user;
  }

  public function setUser(?User $user): self {
    $this->user = $user;

    return $this;
  }

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\Ecrituretype")
   * @ORM\JoinColumn(name="paiement_id", referencedColumnName="id")
   */
  private $ecrituretype;

  public function getEcrituretype(): ?Ecrituretype {
    return $this->ecrituretype;
  }

  public function setEcrituretype(?Ecrituretype $ecrituretype): self {
    $this->ecrituretype = $ecrituretype;

    return $this;
  }
}
