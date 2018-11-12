<?php

namespace App\Dto;

use JMS\Serializer\Annotation as Serializer;

class EmailDto {

  /**
   * @Serializer\Type("integer")
   *
   * @var integer
   */
  private $id;

  /**
   * @Serializer\Type("string")
   *
   * @var string
   */
  private $email;


  /**
   * @Serializer\Type("string")
   *
   * @var string
   */
  private $message;

  /**
   * @Serializer\Type("string")
   *
   * @var string
   */
  private $name;

  /**
   * @Serializer\Type("string")
   *
   * @var string
   */
  private $sujet;

  /**
   * @return int
   */
  public function getId(): int {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getEmail(): string {
    return $this->email;
  }

  /**
   * @return string
   */
  public function getMessage(): string {
    return $this->message;
  }

  /**
   * @return string
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * @return string
   */
  public function getSujet(): string {
    return $this->sujet;
  }


}