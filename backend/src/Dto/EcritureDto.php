<?php


namespace App\Dto;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;

class EcritureDto {

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $id;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  private $dtecr;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $designation;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $commentaire;

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $paiementId;

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $ecrrubriqueId;

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $pieceId;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $titulaire;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $titulaireBanque;

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $numChq;

  /**
   * @var string|null
   * @Serializer\Type("string")
   */
  private $montant;

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $numDepot;

  /**
   * @var int|null
   * @Serializer\Type("int")
   */
  private $numReleve;

  /**
   * @var EcrrubriqueDto|null
   * @Type("array<App\Dto\EcrrubriqueDto>")
//   * @Serializer\Type("App\Dto\EcrrubriqueDto")
   */
  private $rubrique;

  /**
   * @var EcrituretypeDto|null
   * @Type("array<App\Dto\EcrituretypeDto>")
//   * @Serializer\Type("App\Dto\EcrituretypeDto")
   */
  private $type;

  /**
   * @var AdherentDto|null
   * @Type("array<App\Dto\AdherentDto>")
//   * @Serializer\Type("App\Dto\AdherentDto")
   */
  private $adherent;

  /**
   * EcritureDto constructor.
   * @param EcrrubriqueDto|null $rubrique
   * @param EcrituretypeDto|null $coordonnees
   */
  public function __construct(EcrrubriqueDto $rubrique = null, EcrituretypeDto $type = null)
  {
    $this->rubrique = $rubrique ?: new EcrrubriqueDto();
    $this->type = $type ?: new EcrituretypeDto();
  }


  /**
   * @return int|null
   */
  public function getId(): ?int {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getDtecr(): string {
    return $this->dtecr;
  }

  /**
   * @return null|string
   */
  public function getDesignation(): ?string {
    return $this->designation;
  }

  /**
   * @return null|string
   */
  public function getCommentaire(): ?string {
    return $this->commentaire;
  }

  /**
   * @return int|null
   */
  public function getEcrrubriqueId(): ?int {
    return $this->ecrrubriqueId;
  }

  /**
   * @return int|null
   */
  public function getPaiementId(): ?int {
    return $this->paiementId;
  }

  /**
   * @return int|null
   */
  public function getPieceId(): ?int {
    return $this->pieceId;
  }

  /**
   * @return null|string
   */
  public function getTitulaire(): ?string {
    return $this->titulaire;
  }

  /**
   * @return null|string
   */
  public function getTitulaireBanque(): ?string {
    return $this->titulaireBanque;
  }

  /**
   * @return int|null
   */
  public function getNumChq(): ?int {
    return $this->numChq;
  }

  /**
   * @return null|string
   */
  public function getMontant(): ?string {
    return $this->montant;
  }

  /**
   * @return int|null
   */
  public function getNumDepot(): ?int {
    return $this->numDepot;
  }

  /**
   * @return int|null
   */
  public function getNumReleve(): ?int {
    return $this->numReleve;
  }

  /**
   * @return EcrrubriqueDto|null
   */
  public function getRubrique(): ?EcrrubriqueDto {
    return $this->rubrique;
  }

  /**
   * @return EcrituretypeDto|null
   */
  public function getType(): ?EcrituretypeDto {
    return $this->type;
  }

  /**
   * @return AdherentDto|null
   */
  public function getAdherent(): ?AdherentDto {
    return $this->adherent;
  }
}
