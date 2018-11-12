<?php

namespace App\Repository;

use App\Entity\Banque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Banque|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Banque|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Banque[]    findAll()
 * @method Banque[]    findBy(array $criteria, array $orderBy = NULL, $limit =  NULL) NULL, $offset = NULL)
 */
class BanqueRepository extends ServiceEntityRepository {

  public function __construct(RegistryInterface $registry) {
    parent::__construct($registry, Banque::class);
  }

  public function transformAllFields(Banque $banque) {
    return [
      'id' => (int) $banque->getId(),
      'dtoperation' => (array) $banque->getDtoperation(),
      'dtvaleur' => (array) $banque->getDtvaleur(),
      'libelle' => (string) $banque->getLibelle(),
      'debit' => (string) $banque->getDebit(),
      'credit' => (string) $banque->getCredit(),
      'solde' => (string) $banque->getSolde(),
      'ecriture' => (array) $banque->getEcriture(),
    ];
  }

  public function transformFieldsWithoutEcriture(Banque $banque) {
    return [
      'id' => (int) $banque->getId(),
      'dtoperation' => (array) $banque->getDtoperation(),
      'dtvaleur' => (array) $banque->getDtvaleur(),
      'libelle' => (string) $banque->getLibelle(),
      'debit' => (string) $banque->getDebit(),
      'credit' => (string) $banque->getCredit(),
      'solde' => (string) $banque->getSolde(),
    ];
  }

  public function transformAll() {

    $qb = $this->createQueryBuilder('b');
    $query1 = $qb->select('b')
      ->addSelect('e.id')
//      ->leftJoin('App:Ecriture','e','WITH',"((e.montant = abs(b.debit) OR e.montant = b.credit) and e.dtecr = b.dtoperation and e.paiement_id <> 1) OR (e.paiement_id = 1 AND e.montant = abs(b.debit) and CONCAT('CHEQUE ',e.num_chq, '%') like b.libelle)")
      ->leftJoin('App:Ecriture','e','WITH',"((e.montant = abs(b.debit) OR e.montant = b.credit) and e.dtecr = b.dtoperation and e.ecrituretype <> 1) OR (e.ecrituretype = 1 AND e.montant = abs(b.debit) and CONCAT('CHEQUE ',e.num_chq) = b.libelle)")
//      ->where('b.libelle not like :libelle')
//      ->setParameter('libelle', 'REM CHQ%')
      ->orderBy('b.id','ASC');
    $banques =  $query1->getQuery()->getResult();

//    $query2 = $qb->select('b')
//      ->addSelect('id')
//      ->where('b.libelle like :libelle')
//      ->orderBy('b.dtvaleur','ASC')
//      ->setParameter('libelle', 'REM CHQ%');
//
//    $banques = array_merge($query1,$query2);

    $banquesArray = [];

    foreach ($banques as $banque) {
//      $banquesArray[] = $this->transformAllFields($banque);
      $banquesArray[] = array_merge ($this->transformFieldsWithoutEcriture($banque[0]), ['ecritureId' => $banque['id']]);
    }

    return $banquesArray;
  }
}
