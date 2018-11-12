<?php


namespace App\Dto;

use JMS\Serializer\Annotation as Serializer;

class UserDto
{

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $id;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  public $username;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  public $licenceId;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  public $email;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  public $lastname;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  public $firstname;

  /**
   * @return int|null
   */
  public function getId(): ?int {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getUsername(): string {
    return $this->username;
  }

  /**
   * @return string
   */
  public function getLicenceId(): string {
    return $this->licenceId;
  }

  /**
   * @return string
   */
  public function getEmail(): string {
    return $this->email;
  }

  /**
   * @param string $email
   */
  public function setEmail(string $email): void {
    $this->email = $email;
  }

  /**
   * @return string
   */
  public function getLastname(): string {
    return $this->lastname;
  }

  /**
   * @param string $lastname
   */
  public function setLastname(string $lastname): void {
    $this->lastname = $lastname;
  }

  /**
   * @return string
   */
  public function getFirstname(): string {
    return $this->firstname;
  }

  /**
   * @param string $firstname
   */
  public function setFirstname(string $firstname): void {
    $this->firstname = $firstname;
  }


}
