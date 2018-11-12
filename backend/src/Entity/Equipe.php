<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="equipes")
 */
class Equipe {

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  public $id;

  /**
   * @ORM\Column(type="string", length=255, nullable=false)
   */
  public $libelle;

  /**
   * @ORM\Column(type="string", length=255, nullable=false)
   */
  public $division;

  /**
   * @ORM\Column(type="string", length=255, nullable=false)
   */
  public $lienDivision;

  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  public $phase;

  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  public $classement;

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
  public function getDivision() {
    return $this->division;
  }

  /**
   * @param mixed $division
   */
  public function setDivision($division): void {
    $this->division = $division;
  }

  /**
   * @return mixed
   */
  public function getLienDivision() {
    return $this->lienDivision;
  }

  /**
   * @param mixed $lienDivision
   */
  public function setLienDivision($lienDivision): void {
    $this->lienDivision = $lienDivision;
  }

  /**
   * @return mixed
   */
  public function getPhase() {
    return $this->phase;
  }

  /**
   * @param mixed $phase
   */
  public function setPhase($phase): void {
    $this->phase = $phase;
  }

  /**
   * @return mixed
   */
  public function getClassement() {
    return $this->classement;
  }

  /**
   * @param mixed $classement
   */
  public function setClassement($classement): void {
    $this->classement = $classement;
  }


}
