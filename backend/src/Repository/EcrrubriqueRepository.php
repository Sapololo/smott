<?php

namespace App\Repository;

use App\Entity\Ecrrubrique;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class EcrrubriqueRepository extends EntityRepository {

  public function __construct(EntityManagerInterface $em) {
    parent::__construct($em, $em->getClassMetadata(Ecrrubrique::class));
  }

  public function transformAllFields(Ecrrubrique $ecrrubrique) {
    return [
      'id' => (int) $ecrrubrique->getId(),
      'code' => (int) $ecrrubrique->getCode(),
      'titre' => (string) $ecrrubrique->getTitre(),
      'description' => (string) $ecrrubrique->getDescription(),
    ];
  }

  public function transformAll() {
    $ecrrubriques = $this->findBy([], ['id' => 'DESC']);
    $qb = $this->createQueryBuilder('e');
    $query = $qb->select('e')
      ->orderBy('e.id', 'DESC');

    $ecrrubriques = $query->getQuery()->getResult();

    $ecrrubriquesArray = [];

    foreach ($ecrrubriques as $ecrrubrique) {
      $ecrrubriquesArray[] = $this->transformAllFields($ecrrubrique);
    }

    return $ecrrubriquesArray;
  }

  public function findByCompteResultat() {

    // ->select(['code','titre', 'montant' => "(SELECT sum(Ecritures.montant) AS `Ecritures__montant` FROM ecritures Ecritures INNER JOIN ecrrubriques Ecrrubriques ON Ecrrubriques.id = (Ecritures.ecrrubrique_id) WHERE substr(Ecrrubriques.code,1,2) = substr(Rubriques.code,1,2) AND dtecr >= '$dtdebut' AND dtecr <= '$dtfin' and (commentaire like '%$commentaire%' or designation like '%$commentaire%') GROUP BY substr(Ecrrubriques.code,1,2))", 'niveau'=>'1'])
    //      ->where(['code like "$1"'])
    //      ->setParameter(1, '7%');


    $qb = $this->createQueryBuilder('r');
    $query = $qb->select('SUBSTRING(r.code,1,2)')
      ->addSelect('SUM(e.montant)')
      ->addSelect('1 as niveau')
      ->leftJoin('App:Ecriture', 'e', 'WITH', "r.id = e.ecrrubrique WHERE SUBSTRING(r.code,1,2) = SUBSTRING(r.code,1,2) AND e.dtecr >= '2018-06-01' AND e.dtecr <= '2019-05-31' GROUP BY SUBSTRING(Ecrrubriques.code,1,2))");



//      ->addSelect('SUM(e.montant)')
//      ->addSelect('(SELECT sum(e.montant) AS montant FROM App:Ecriture e INNER JOIN App:Ecrrubrique a ON a.id = (e.ecrrubrique_id) WHERE SUBSTRING(a.code,1,2) = SUBSTRING(r.code,1,2) AND e.dtecr >= "2018-06-01" AND e.dtecr <= "2019-05-31" GROUP BY SUBSTRING(a.code,1,2))')
//      ->addSelect('SELECT sum(e.montant) AS montant FROM App:Ecriture e INNER JOIN App:Ecrrubrique a ON a.id = (e.ecrrubrique_id)')
//      ->addSelect('1 as niveau')
//      ->leftJoin('App:Ecriture', 'e', 'WITH', "r.id = e.ecrrubrique WHERE SUBSTRING(r.code,1,2) = SUBSTRING(r.code,1,2) AND e.dtecr >= '2018-06-01' AND e.dtecr <= '2019-05-31' GROUP BY SUBSTRING(Ecrrubriques.code,1,2))")
//      ->orderBy( 'r.code');
//      ->groupBy('substr(r.code,1,2)');
//      ->where('r.code like ?1')
//      ->setParameter(1, "7%");

    $rubriques = $query->getQuery()->getResult();
        print_r($rubriques);
    $rubriquesArray = [];

    foreach ($rubriques as $rubrique) {
      $rubriquesArray[] = array_merge($this->transformAllFields($rubrique[0]), ['montant' => $rubrique[1]], ['niveau' => $rubrique['niveau']]);
    }

    return $rubriquesArray;
  }
}
