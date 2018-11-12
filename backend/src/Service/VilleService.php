<?php

namespace App\Service;

use App\Dto\VilleDto;
use App\Entity\Ville;
use App\Repository\VilleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class VilleService {

  /** @var ObjectManager */
  private $em;
  /**
   * PrestationService constructor.
   *
   * @param ObjectManager $em
   */
  public function __construct(ObjectManager $em) {
    $this->em = $em;
  }

//  /**
//   * @return VilleDto[]
//   */
//  public function getVilles() {
//    /** @var VilleRepository $villeRepo */
//    $villeRepo = $this->em->getRepository(Ville::class);
//    $dbVilles = $villeRepo->findAll();
//
//    /** @var VilleDto[] $villes */
//    $villes = array_map(function ($dbVilles) {
//      $villeDTO = $this->villeDTO($dbVilles);
//      return $villeDTO;
//    }, $dbVilles);
//
//    return $villes;
//  }
//
//  /**
//   * @param Ville $dbVille
//   *
//   * @return VilleDto
//   * @throws \Doctrine\ORM\NonUniqueResultException
//   * @throws DataIntegrityException
//   */
//  public function villeDTO(Ville $dbVille)
//  {
//    /** @var Ville $dbVille */
//
//    $ville = new VilleDto();
//    $ville->setId($dbVille->getId());
//    $ville->setVille($dbVille->getVille());
//
//    return $ville;
//  }

}
