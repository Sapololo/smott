<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="banques")
 */
class Banque {

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  public $id;

  /**
   * @ORM\Column(type="date", nullable=false)
   */
  public $dtoperation;

  /**
   * @ORM\Column(type="date", nullable=false)
   */
  public $dtvaleur;

  /**
   * @ORM\Column(type="string", length=255, nullable=false)
   */
  public $libelle;

  /**
   * @ORM\Column(type="decimal", precision=11, scale=2, nullable=false)
   */
  public $debit;

  /**
   * @ORM\Column(type="decimal", precision=11, scale=2, nullable=false)
   */
  public $credit;

  /**
   * @ORM\Column(type="decimal", precision=11, scale=2, nullable=false)
   */
  public $solde;

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
   * @return date
   */
  public function getDtoperation() {
    return $this->dtoperation;
  }

  /**
   * @param mixed $dtoperation
   */
  public function setDtoperation($dtoperation): void {
    $this->dtoperation = $dtoperation;
  }

  /**
   * @return date
   */
  public function getDtvaleur() {
    return $this->dtvaleur;
  }

  /**
   * @param mixed $dtvaleur
   */
  public function setDtvaleur($dtvaleur): void {
    $this->dtvaleur = $dtvaleur;
  }

  /**
   * @return mixed
   */
  public function getLibelle() {
    return $this->libelle;
  }

  /**
   * @param mixed $libelle
   */
  public function setLibelle($libelle): void {
    $this->libelle = $libelle;
  }

  /**
   * @return mixed
   */
  public function getDebit() {
    return $this->debit;
  }

  /**
   * @param mixed $debit
   */
  public function setDebit($debit): void {
    $this->debit = $debit;
  }

  /**
   * @return mixed
   */
  public function getCredit() {
    return $this->credit;
  }

  /**
   * @param mixed $credit
   */
  public function setCredit($credit): void {
    $this->credit = $credit;
  }

  /**
   * @return mixed
   */
  public function getSolde() {
    return $this->solde;
  }

  /**
   * @param mixed $solde
   */
  public function setSolde($solde): void {
    $this->solde = $solde;
  }

//  /**
//   * @ORM\OneToMany(targetEntity="App\Entity\Ecriture", mappedBy="ecriture")
//   */
//  private $ecriture;
//
//  public function getEcriture(): ?Ecriture {
//    return $this->ecriture;
//  }
//
//  public function setEcriture(?Ecriture $ecriture): self {
//    $this->ecriture = $ecriture;
//
//    return $this;
//  }

}
