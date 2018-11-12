<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="ecrituretype")
 * @ORM\Entity(repositoryClass="App\Repository\EcrituretypeRepository")
 */
class Ecrituretype {

  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @var integer
   */
  public $id;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @var string|null
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
   * @return null|string
   */
  public function getDescription(): ?string {
    return $this->description;
  }

  /**
   * @param null|string $description
   */
  public function setDescription(?string $description): void {
    $this->description = $description;
  }

}
