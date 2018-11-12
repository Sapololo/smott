<?php


namespace App\Dto;

use JMS\Serializer\Annotation as Serializer;

class AdherentDto {

  /**
   * @var string
   * @Serializer\Type("string")
   */
  private $licence;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  private $nom;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  private $prenom;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  private $classement;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  private $type;

  /**
   * @var boolean
   * @Serializer\Type("boolean")
   */
  private $isHomme;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  private $pointLicence;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  private $pointMensuel;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  private $pointVirtuel;

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $villeId;

  /**
   * @var VilleDto|null
   * @Serializer\Type("App\Dto\VilleDto")
   */
  private $ville;

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $numero;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $voie;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $rue;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $perso;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $portable;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $prof;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $resp;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $prof1;

  /**
   * @var int|null
   * @Serializer\Type("string")
   */
  private $prof2;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $avatar;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $facebook;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $twitter;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $categ;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $dtlicence;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $dtnais;

  /**
   * @var string
   * @Serializer\Type("boolean")
   */
  private $cdnais;

  /**
   * @var boolean
   * @Serializer\Type("boolean")
   */
  private $stage;

  /**
   * @var boolean
   * @Serializer\Type("boolean")
   */
  private $tjl;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $lat;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $lng;

  /**
   * @var UserDto|null
   * @Serializer\Type("App\Dto\UserDto")
   */
  private $user;

  /**
   * AdherentDto constructor.
   * @param VilleDto|null $ville
   * @param UserDto|null $user
   */
  public function __construct(VilleDto $ville = null, UserDto $user = null)
  {
    $this->ville = $ville ?: new VilleDto();
    $this->user = $user ?: new UserDto();
  }

  /**
   * @return string
   */
  public function getLicence(): string {
    return $this->licence;
  }

  /**
   * @return string
   */
  public function getNom(): string {
    return $this->nom;
  }

  /**
   * @return string
   */
  public function getPrenom(): string {
    return $this->prenom;
  }

  /**
   * @return string
   */
  public function getClassement(): string {
    return $this->classement;
  }

  /**
   * @return string
   */
  public function getType(): string {
    return $this->type;
  }

  /**
   * @return string
   */
  public function getisHomme(): string {
    return $this->isHomme;
  }

  /**
   * @return string
   */
  public function getPointLicence(): string {
    return $this->pointLicence;
  }

  /**
   * @return string
   */
  public function getPointMensuel(): string {
    return $this->pointMensuel;
  }

  /**
   * @return string
   */
  public function getPointVirtuel(): string {
    return $this->pointVirtuel;
  }

  /**
   * @return int|null
   */
  public function getVilleId(): ?int {
    return $this->villeId;
  }

  /**
   * @return int|null
   */
  public function getNumero(): ?int {
    return $this->numero;
  }

  /**
   * @return null|string
   */
  public function getVoie(): ?string {
    return $this->voie;
  }

  /**
   * @return null|string
   */
  public function getRue(): ?string {
    return $this->rue;
  }

  /**
   * @return null|string
   */
  public function getPerso(): ?string {
    return $this->perso;
  }

  /**
   * @return null|string
   */
  public function getPortable(): ?string {
    return $this->portable;
  }

  /**
   * @return null|string
   */
  public function getProf(): ?string {
    return $this->prof;
  }

  /**
   * @return null|string
   */
  public function getResp(): ?string {
    return $this->resp;
  }

  /**
   * @return null|string
   */
  public function getProf1(): ?string {
    return $this->prof1;
  }

  /**
   * @return int|null
   */
  public function getProf2(): ?int {
    return $this->prof2;
  }

  /**
   * @return null|string
   */
  public function getAvatar(): ?string {
    return $this->avatar;
  }

  /**
   * @return null|string
   */
  public function getFacebook(): ?string {
    return $this->facebook;
  }

  /**
   * @return null|string
   */
  public function getTwitter(): ?string {
    return $this->twitter;
  }

  /**
   * @return null|string
   */
  public function getCateg(): ?string {
    return $this->categ;
  }

  /**
   * @return null|string
   */
  public function getDtlicence(): ?string {
    return $this->dtlicence;
  }

  /**
   * @return null|string
   */
  public function getDtnais(): ?string {
    return $this->dtnais;
  }

  /**
   * @return string
   */
  public function getCdnais(): string {
    return $this->cdnais;
  }

  /**
   * @return boolean
   */
  public function getStage(): boolean {
    return $this->stage;
  }

  /**
   * @return boolean
   */
  public function getTjl(): boolean {
    return $this->tjl;
  }

  /**
   * @return null|string
   */
  public function getLat(): ?string {
    return $this->lat;
  }

  /**
   * @return null|string
   */
  public function getLng(): ?string {
    return $this->lng;
  }

  /**
   * @return \App\Dto\UserDto|null
   */
  public function getUser(): ?\App\Dto\UserDto {
    return $this->user;
  }

  /**
   * @return VilleDto|null
   */
  public function getVille(): ?VilleDto {
    return $this->ville;
  }
}
