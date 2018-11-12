<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="adherent")
 */
class Adherent {

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  public $id;

  /**
   * @var string
   * @ORM\Column(name="licence_id", type="string", length=10, nullable=false)
   */
  public $licence;

  /**
   * @var string|null
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  public $nom;

  /**
   * @var string|null
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  public $prenom;

  /**
   * @var string|null
   * @ORM\Column(type="string", length=5, nullable=true)
   */
  public $classement;

  /**
   * @var string|null
   * @ORM\Column(type="string", length=50, nullable=true)
   */
  public $type;

  /**
   * @var boolean|null
   * @ORM\Column(type="boolean", nullable=true)
   */
  public $isHomme;

  /**
   * @var string|null
   * @ORM\Column(type="string", length=6, nullable=true)
   */
  public $pointsLicence;

  /**
   * @var string|null
   * @ORM\Column(type="string", length=6, nullable=true)
   */
  public $pointsMensuel;

  /**
   * @var string|null
   * @ORM\Column(type="string", length=6, nullable=true)
   */
  public $pointsVirtuel;

  /**
   * @var string|null
   * @ORM\Column(type="integer", length=11, nullable=true)
   */
  public $numero;

  /**
   * @var string|null
   * @ORM\Column(name="type_voie", type="string", length=11, nullable=true)
   */
  public $voie;

  /**
   * @var string|null
   * @ORM\Column(name="nom_voie", type="string", length=255, nullable=true)
   */
  public $rue;

  /**
   * @var string|null
   * @ORM\Column(name="tel_perso", type="string", length=10, nullable=true)
   */
  public $perso;

  /**
   * @var string|null
   * @ORM\Column(name="tel_portable", type="string", length=10, nullable=true)
   */
  public $portable;

  /**
   * @var string|null
   * @ORM\Column(name="tel_prof", type="string", length=10, nullable=true)
   */
  public $prof;

  /**
   * @var string|null
   * @ORM\Column(name="tel_resp", type="string", length=10, nullable=true)
   */
  public $resp;

  /**
   * @var string|null
   * @ORM\Column(name="prof_1", type="string", length=255, nullable=true)
   */
  public $prof1;

  /**
   * @var string|null
   * @ORM\Column(name="prof_2", type="string", length=255, nullable=true)
   */
  public $prof2;

  /**
   * @var string|null
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  public $avatar;

  /**
   * @var string|null
   * @ORM\Column(type="string", length=200, nullable=true)
   */
  public $facebook;

  /**
   * @var string|null
   * @ORM\Column(type="string", length=200, nullable=true)
   */
  public $twitter;

  /**
   * @var string|null
   * @ORM\Column(type="string", length=11, nullable=true)
   */
  public $categ;

  /**
   * @var string|null
   * @ORM\Column(type="date", nullable=true)
   */
  public $dtlicence;

  /**
   * @var string|null
   * @ORM\Column(type="date", nullable=true)
   */
  public $dtnais;

  /**
   * @var string|null
   * @ORM\Column(type="boolean", nullable=true)
   */
  public $cdnais;

  /**
   * @var boolean|null
   * @ORM\Column(type="boolean", nullable=true)
   */
  public $stage;

  /**
   * @var boolean|null
   * @ORM\Column(type="boolean", nullable=true)
   */
  public $tjl;

  /**
   * @var string|null
   * @ORM\Column(type="decimal", nullable=true)
   */
  public $lat;

  /**
   * @var float|null
   * @ORM\Column(type="decimal", nullable=true)
   */
  public $lng;

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
   * @return string
   */
  public function getLicence(): string {
    return $this->licence;
  }

  /**
   * @param string $licence
   */
  public function setLicence(string $licence): void {
    $this->licence = $licence;
  }

  /**
   * @return null|string
   */
  public function getNom(): ?string {
    return $this->nom;
  }

  /**
   * @param null|string $nom
   */
  public function setNom(?string $nom): void {
    $this->nom = $nom;
  }

  /**
   * @return null|string
   */
  public function getPrenom(): ?string {
    return $this->prenom;
  }

  /**
   * @param null|string $prenom
   */
  public function setPrenom(?string $prenom): void {
    $this->prenom = $prenom;
  }

  /**
   * @return null|string
   */
  public function getClassement(): ?string {
    return $this->classement;
  }

  /**
   * @param null|string $classement
   */
  public function setClassement(?string $classement): void {
    $this->classement = $classement;
  }

  /**
   * @return null|string
   */
  public function getType(): ?string {
    return $this->type;
  }

  /**
   * @param null|string $type
   */
  public function setType(?string $type): void {
    $this->type = $type;
  }

  /**
   * @return bool|null
   */
  public function getisHomme(): ?bool {
    return $this->isHomme;
  }

  /**
   * @param bool|null $isHomme
   */
  public function setIsHomme(?bool $isHomme): void {
    $this->isHomme = $isHomme;
  }

  /**
   * @return null|string
   */
  public function getPointsLicence(): ?string {
    return $this->pointsLicence;
  }

  /**
   * @param null|string $pointsLicence
   */
  public function setPointsLicence(?string $pointsLicence): void {
    $this->pointsLicence = $pointsLicence;
  }

  /**
   * @return null|string
   */
  public function getPointsMensuel(): ?string {
    return $this->pointsMensuel;
  }

  /**
   * @param null|string $pointsMensuel
   */
  public function setPointsMensuel(?string $pointsMensuel): void {
    $this->pointsMensuel = $pointsMensuel;
  }

  /**
   * @return null|string
   */
  public function getPointsVirtuel(): ?string {
    return $this->pointsVirtuel;
  }

  /**
   * @param null|string $pointsVirtuel
   */
  public function setPointsVirtuel(?string $pointsVirtuel): void {
    $this->pointsVirtuel = $pointsVirtuel;
  }

  /**
   * @return null|string
   */
  public function getNumero(): ?string {
    return $this->numero;
  }

  /**
   * @param null|string $numero
   */
  public function setNumero(?string $numero): void {
    $this->numero = $numero;
  }

  /**
   * @return null|string
   */
  public function getVoie(): ?string {
    return $this->voie;
  }

  /**
   * @param null|string $voie
   */
  public function setVoie(?string $voie): void {
    $this->voie = $voie;
  }

  /**
   * @return null|string
   */
  public function getRue(): ?string {
    return $this->rue;
  }

  /**
   * @param null|string $rue
   */
  public function setRue(?string $rue): void {
    $this->rue = $rue;
  }

  /**
   * @return null|string
   */
  public function getPerso(): ?string {
    return $this->perso;
  }

  /**
   * @param null|string $perso
   */
  public function setPerso(?string $perso): void {
    $this->perso = $perso;
  }

  /**
   * @return null|string
   */
  public function getPortable(): ?string {
    return $this->portable;
  }

  /**
   * @param null|string $portable
   */
  public function setPortable(?string $portable): void {
    $this->portable = $portable;
  }

  /**
   * @return null|string
   */
  public function getProf(): ?string {
    return $this->prof;
  }

  /**
   * @param null|string $prof
   */
  public function setProf(?string $prof): void {
    $this->prof = $prof;
  }

  /**
   * @return null|string
   */
  public function getResp(): ?string {
    return $this->resp;
  }

  /**
   * @param null|string $resp
   */
  public function setResp(?string $resp): void {
    $this->resp = $resp;
  }

  /**
   * @return null|string
   */
  public function getProf1(): ?string {
    return $this->prof1;
  }

  /**
   * @param null|string $prof1
   */
  public function setProf1(?string $prof1): void {
    $this->prof1 = $prof1;
  }

  /**
   * @return null|string
   */
  public function getProf2(): ?string {
    return $this->prof2;
  }

  /**
   * @param null|string $prof2
   */
  public function setProf2(?string $prof2): void {
    $this->prof2 = $prof2;
  }

  /**
   * @return null|string
   */
  public function getAvatar(): ?string {
    return $this->avatar;
  }

  /**
   * @param null|string $avatar
   */
  public function setAvatar(?string $avatar): void {
    $this->avatar = $avatar;
  }

  /**
   * @return null|string
   */
  public function getFacebook(): ?string {
    return $this->facebook;
  }

  /**
   * @param null|string $facebook
   */
  public function setFacebook(?string $facebook): void {
    $this->facebook = $facebook;
  }

  /**
   * @return null|string
   */
  public function getTwitter(): ?string {
    return $this->twitter;
  }

  /**
   * @param null|string $twitter
   */
  public function setTwitter(?string $twitter): void {
    $this->twitter = $twitter;
  }

  /**
   * @return null|string
   */
  public function getCateg(): ?string {
    return $this->categ;
  }

  /**
   * @param null|string $categ
   */
  public function setCateg(?string $categ): void {
    $this->categ = $categ;
  }

  /**
   * @return null|string
   */
  public function getDtlicence(): ?string {
    return $this->dtlicence;
  }

  /**
   * @param null|string $dtlicence
   */
  public function setDtlicence(?string $dtlicence): void {
    $this->dtlicence = $dtlicence;
  }

  /**
   * @return null|string
   */
  public function getDtnais(): ?string {
    return $this->dtnais;
  }

  /**
   * @param null|string $dtnais
   */
  public function setDtnais(?string $dtnais): void {
    $this->dtnais = $dtnais;
  }

  /**
   * @return null|string
   */
  public function getCdnais(): ?string {
    return $this->cdnais;
  }

  /**
   * @param null|string $cdnais
   */
  public function setCdnais(?string $cdnais): void {
    $this->cdnais = $cdnais;
  }

  /**
   * @return bool|null
   */
  public function getStage(): ?bool {
    return $this->stage;
  }

  /**
   * @param bool|null $stage
   */
  public function setStage(?bool $stage): void {
    $this->stage = $stage;
  }

  /**
   * @return bool|null
   */
  public function getTjl(): ?bool {
    return $this->tjl;
  }

  /**
   * @param bool|null $tjl
   */
  public function setTjl(?bool $tjl): void {
    $this->tjl = $tjl;
  }

  /**
   * @return null|string
   */
  public function getLat(): ?string {
    return $this->lat;
  }

  /**
   * @param null|string $lat
   */
  public function setLat(?string $lat): void {
    $this->lat = $lat;
  }

  /**
   * @return null|float
   */
  public function getLng(): ?float {
    return $this->lng;
  }

  /**
   * @param null|float $lng
   */
  public function setLng(?float $lng): void {
    $this->lng = $lng;
  }

  /**
   * @ORM\OneToOne(targetEntity="App\Entity\Ville")
   */
  private $ville;

  public function getVille(): ?Ville {
    return $this->ville;
  }

  public function setVille(?Ville $ville): self {
    $this->ville = $ville;

    return $this;
  }

  private $classVirtuel;

  /**
   * @return mixed
   */
  public function getClassVirtuel() {
    return $this->pointsMensuel + $this->pointsVirtuel;
  }

  private $progression;

  /**
   * @return mixed
   */
  public function getProgression() {
    return $this->pointsMensuel + $this->pointsVirtuel - $this->pointsLicence;
  }

//  /**
//   * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="User")
//   * @ORM\JoinColumn(name="licence_id", referencedColumnName="licence_id")
//   */
//  private $user;
//
//  public function getUser(): ?User {
//    return $this->user;
//  }
//
//  public function setUser(?User $user): self {
//    $this->user = $user;
//
//    return $this;
//  }
}
