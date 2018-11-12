<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville {

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  public $id;

  /**
   * @var string
   *
   * @ORM\Column(name="ville", type="string", length=50, nullable=true)
   */
  public $ville;

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
   * @return null|string
   */
  public function getVille(): ?string {
    return $this->ville;
  }

  /**
   * @param null|string $ville
   */
  public function setVille(?string $ville): void {
    $this->ville = $ville;
  }
}
