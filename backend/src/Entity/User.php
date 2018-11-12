<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Stmt\Return_;

/**
 * @ORM\Entity()
 */
class User extends BaseUser {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
  const ROLE_ADMIN = 'ROLE_ADMIN';
  const ROLE_USER = 'ROLE_USER';

  /**
   * @var
   *
   * @ORM\Column(name="genre", type="string", length=1, nullable=true)
   */
  public $genre;

  /**
   * @var
   *
   * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
   */
  public $firstname;

  /**
   * @var
   *
   * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
   */
  public $lastname;

  /**
   * @var
   *
   * @ORM\Column(name="licence_id", type="string", length=10, nullable=true)
   */
  public $licenceId;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * @return mixed
   */
  public function getGenre() {
    return $this->genre;
  }

  /**
   * @param mixed $genre
   */
  public function setGenre($genre): void {
    $this->genre = $genre;
  }

  /**
   * @param mixed $firstname
   */
  public function setFirstname($firstname) {
    $this->firstname = $firstname;
  }

  /**
   * @return mixed
   */
  public function getFirstname() {
    return $this->firstname;
  }

  /**
   * @param mixed $lastname
   */
  public function setLastname($lastname): void {
    $this->lastname = $lastname;
  }

  /**
   * @return mixed
   */
  public function getLastname() {
    return $this->lastname;
  }

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
  public function getLicenceId() {
    return $this->licenceId;
  }

  /**
   * @param mixed $licenceId
   */
  public function setLicenceId($licenceId): void {
    $this->licenceId = $licenceId;
  }

//  /**
//   * @ORM\OneToOne(targetEntity="App\Entity\Adherent")
//   * @ORM\JoinColumn(name="licence_id", referencedColumnName="licence_id")
//   */
//  private $adherent;
//
//  public function getAdherent(): ?Adherent
//  {
//    return $this->adherent;
//  }
//
//  public function setAdherent(?Adherent $adherent): self
//  {
//    $this->adherent = $adherent;
//
//    return $this;
//  }


}
