<?php

namespace App\Repository;

use App\Entity\Ecriture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @method Ecriture|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Ecriture|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Ecriture[]    findAll()
 * @method Ecriture[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class EcritureRepository extends EntityRepository {

  public function __construct(EntityManagerInterface $em) {
    parent::__construct($em, $em->getClassMetadata(Ecriture::class));
  }

  public function transformFields(Ecriture $ecriture) {
    return [
      'dtecr' => (string) $ecriture->getDtecr(),
      'montant' => (float) $ecriture->getMontant(),
      'titulaire' => (string) $ecriture->getTitulaire(),
      'titulaireBanque' => (string) $ecriture->getTitulaireBanque(),
      'numChq' => (string) $ecriture->getNumChq()
    ];
  }

  public function transformAllFields(Ecriture $ecriture) {
    return [
      'id' => (int) $ecriture->getId(),
      'dtecr' => (string) $ecriture->getDtecr(),
      'rubrique' => (array) $ecriture->getEcrrubrique(),
      'designation' => (string) $ecriture->getDesignation(),
      'commentaire' => (string) $ecriture->getCommentaire(),
      'pieceId' => (integer) $ecriture->getPieceId(),
      'type' => (array) $ecriture->getEcrituretype(),
      'titulaire' => (string) $ecriture->getTitulaire(),
      'titulaireBanque' => (string) $ecriture->getTitulaireBanque(),
      'numChq' => (integer) $ecriture->getNumChq(),
      'montant' => (float) $ecriture->getMontant(),
      'numDepot' => (string) $ecriture->getNumDepot(),
      'numReleve' => (string) $ecriture->getNumReleve(),
      'user' => (array) $ecriture->getUser(),
      'enLigne' => (integer) $ecriture->getEnLigne(),
      'modification' => (array) $ecriture->getModification(),
    ];
  }

  public function transformAll() {
    //    $ecritures = $this->findAll()
    $qb = $this->createQueryBuilder('e');
    $query = $qb->select('e')
//      ->addSelect('r', 'u')
      ->addSelect('r', 'u', 't')
      ->leftJoin('e.ecrrubrique', 'r')
      ->leftJoin('e.user', 'u')
      ->leftJoin('e.ecrituretype', 't')
      ->orderBy('e.dtecr', 'ASC');

    $ecritures = $query->getQuery()->getResult();
    //    print_r($ecritures);
    $ecrituresArray = [];

    foreach ($ecritures as $ecriture) {
      $ecrituresArray[] = $this->transformAllFields($ecriture);
    }

    return $ecrituresArray;
  }

  public function findByDtecr(\DateTime $dtremise) {
    $qb = $this->createQueryBuilder('e');
    $query = $qb->select('e.dtecr', 't.id', 'e.titulaire', 'e.titulaire_banque', 'e.num_chq', 'SUM(e.montant) as montant')
      ->leftJoin('e.ecrituretype', 't')
      ->where('e.dtecr = ?1')
      ->andWhere('t.id = 1')
      ->orderBy('e.dtecr', 'ASC')
      ->groupBy('e.dtecr', 'e.titulaire', 'e.titulaire_banque', 'e.num_chq')
      ->setParameter(1, $dtremise);

    $ecritures = $query->getQuery()->getResult();

    if (!$ecritures) {
      throw new NotFoundHttpException();
    }

    $ecrituresArray = [];
    $sum = 0;
    foreach ($ecritures as $ecriture) {
//      print_r($ecriture);
      $ecrituresArray[] = array_merge(['dtecr' => (array) $ecriture['dtecr']], ['titulaire' => $ecriture['titulaire']], ['titulaireBanque' => (string) $ecriture['titulaire_banque']],
        ['paiementId' => (float) $ecriture['id']], ['numChq' => (float) $ecriture['num_chq']], ['montant' => (float) $ecriture['montant']]);
      $sum = $sum + $ecriture['montant'];
//      $ecrituresArray[] = $this->transformFields($ecriture);
    }
    $ecrituresArray[] = array_merge(['titulaire' => 'total'], ['montant' => (float) $sum]);
    return $ecrituresArray;
  }

  public function findByCompteResultat(int $type) {

    $qb = $this->createQueryBuilder('e');
    $query = $qb->select('SUBSTRING(r.code,1,2) as code')
      //      ->addSelect('r.titre')
      ->addSelect('(SELECT rub.titre from App:Ecrrubrique as rub where rub.code = SUBSTRING(r.code,1,2)) as titre', '1 as niveau')
      ->addSelect('SUM(e.montant) as montant')
      ->leftJoin('App:Ecrrubrique', 'r', 'WITH', "r.id = e.ecrrubrique WHERE SUBSTRING(r.code,1,1) = " . $type . " AND e.dtecr >= '2018-06-01' AND e.dtecr <= '2019-05-31'")
      ->groupBy('code');
    $rubriques = $query->getQuery()->getResult();

    $rubriquesArray = [];

    foreach ($rubriques as $rubrique) {

      $qb = $this->createQueryBuilder('e');
      $query = $qb->select('r.code as code')
        ->addSelect('r.titre')
        ->addSelect('2 as niveau')
        ->addSelect('SUM(e.montant) as montant')
        ->leftJoin('App:Ecrrubrique', 'r', 'WITH', "r.id = e.ecrrubrique WHERE SUBSTRING(r.code,1,2) like '" . $rubrique['code'] . "%' AND r.code = r.code AND e.dtecr >= '2018-06-01' AND e.dtecr <= '2019-05-31'")
        ->groupBy('code');
      $ecritures = $query->getQuery()->getResult();

      $ecrituresArray = [];

      foreach ($ecritures as $ecriture) {
        $ecrituresArray[] = array_merge(['code' => (int) $ecriture['code']], ['titre' => $ecriture['titre']], ['niveau' => (int) $ecriture['niveau']], ['montant' => (float) $ecriture['montant']]);
      }
      $rubriquesArray[] = array_merge(['code' => (int) $rubrique['code'] . '000'], ['titre' => $rubrique['titre']], ['niveau' => (int) $rubrique['niveau']], ['montant' => (float) $rubrique['montant']], ['data' => $ecrituresArray]);
    }
    return $rubriquesArray;
  }

  public function findByRubriques(int $rubrique) {
    //    $ecritures = $this->findAll()
    $qb = $this->createQueryBuilder('e');
    $query = $qb->select('e')
      //      ->addSelect('r', 'u')
      ->addSelect('r', 'u', 't')
      ->leftJoin('e.ecrrubrique', 'r')
      ->leftJoin('e.user', 'u')
      ->leftJoin('e.ecrituretype', 't')
      ->where('r.id = ?1')
      ->orderBy('e.dtecr', 'ASC')
      ->setParameter(1, $rubrique);

    $ecritures = $query->getQuery()->getResult();
    //    print_r($ecritures);
    $ecrituresArray = [];

    foreach ($ecritures as $ecriture) {
      $ecrituresArray[] = $this->transformAllFields($ecriture);
    }

    return $ecrituresArray;
  }

  public function findByAdherent(int $licenceId) {
    $qb = $this->createQueryBuilder('e');
    $query = $qb->select('e')
      ->addSelect('r', 'u', 't')
      ->leftJoin('e.ecrrubrique', 'r')
      ->leftJoin('e.user', 'u')
      ->leftJoin('e.ecrituretype', 't')
      ->where('u.licenceId = ?1')
      ->orderBy('e.dtecr', 'ASC')
      ->setParameter(1, $licenceId);

    $ecritures = $query->getQuery()->getResult();
    $ecrituresArray = [];

    foreach ($ecritures as $ecriture) {
      $ecrituresArray[] = $this->transformAllFields($ecriture);
    }

    return $ecrituresArray;
  }
}
