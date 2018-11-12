<?php


namespace App\Dto;

use JMS\Serializer\Annotation as Serializer;

class EcrituretypeDto {

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $id;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $description;

  /**
   * @return int|null
   */
  public function getId(): ?int {
    return $this->id;
  }

  /**
   * @return null|string
   */
  public function getDescription(): ?string {
    return $this->description;
  }
}
