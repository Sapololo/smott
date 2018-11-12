<?php


namespace App\Dto;

use JMS\Serializer\Annotation as Serializer;

class VilleDto {

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $id;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */

  private $ville;


  /**
   * @return int|null
   */
  public function getId(): ?int {
    return $this->id;
  }

  /**
   * @param int|null $id
   */
  public function setId(?int $id): void {
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
