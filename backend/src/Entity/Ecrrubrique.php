<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="ecrrubriques")
 * @ORM\Entity(repositoryClass="App\Repository\EcrrubriqueRepository")
 */
class Ecrrubrique {

  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  public $id;

  /**
   * @ORM\Column(type="integer", nullable=false)
   */
  public $code;


  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  public $niveau;

  /**
   * @ORM\Column(type="string", length=255, nullable=false)
   */
  public $titre;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  public $description;

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
  public function getCode() {
    return $this->code;
  }

  /**
   * @param mixed $code
   */
  public function setCode($code): void {
    $this->code = $code;
  }

  /**
   * @return mixed
   */
  public function getNiveau() {
    return $this->niveau;
  }

  /**
   * @param mixed $niveau
   */
  public function setNiveau($niveau): void {
    $this->niveau = $niveau;
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
  public function getDescription() {
    return $this->description;
  }

  /**
   * @param mixed $description
   */
  public function setDescription($description): void {
    $this->description = $description;
  }
}
