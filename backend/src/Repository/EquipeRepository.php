<?php

namespace App\Repository;

use App\Entity\Equipe;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class EquipeRepository extends EntityRepository {

  public function __construct(EntityManagerInterface $em)
  {
    parent::__construct($em, $em->getClassMetadata(Equipe::class));
  }

  public function transformAllFields(Equipe $equipe) {
    return [
      'id' => (int) $equipe->getId(),
      'libelle' => (string) $equipe->getLibelle(),
      'division' => (string) $equipe->getDivision(),
      'lienDivision' => (string) $equipe->getLienDivision(),
      'classement' => (string) $equipe->getClassement(),

    ];
  }

  public function transformAll() {
    $qb = $this->createQueryBuilder('e');
    $query = $qb->select('e')
      ->orderBy('e.id','ASC');

    $equipes =  $query->getQuery()->getResult();

    $equipesArray = [];

    foreach ($equipes as $equipe) {
      $equipesArray[] = $this->transformAllFields($equipe);
    }

    return $equipesArray;
  }
}
