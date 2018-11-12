<?php


namespace App\Dto;

use JMS\Serializer\Annotation as Serializer;

class EcrrubriqueDto {

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $id;

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $code;

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $niveau;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $titre;

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
   * @return int|null
   */
  public function getCode(): ?int {
    return $this->code;
  }

  /**
   * @return int|null
   */
  public function getNiveau(): ?int {
    return $this->niveau;
  }

  /**
   * @return null|string
   */
  public function getTitre(): ?string {
    return $this->titre;
  }

  /**
   * @return null|string
   */
  public function getDescription(): ?string {
    return $this->description;
  }
}
