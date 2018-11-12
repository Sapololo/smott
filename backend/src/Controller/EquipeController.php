<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Repository\EquipeRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FFTTApi\FFTTApi;
use Doctrine\Common\Persistence\ObjectManager;

class EquipeController extends ApiController {

  /** @var ObjectManager */
  private $em;

  /**
   * UserController constructor.
   *
   * @param ObjectManager $em
   *
   * @throws \Doctrine\Common\Annotations\AnnotationException
   */
  public function __construct(ObjectManager $em) {
    $this->em = $em;
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/equipes")
   */
  public function equipes(EquipeRepository $equipeRepository)
  {
    $equipes = $equipeRepository->transformAll();
    return $this->respond($equipes);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/updateequipes")
   */
  public function updateequipes(EquipeRepository $equipeRepository) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    // Equipes Masculines
    $equipes = $api->getEquipesByClub('04450026', 'M');
    foreach ($equipes as $equipeFftt) {
      // Classement des équipes
      $classementPoule = $api->getClassementPouleByLienDivision($equipeFftt->getLienDivision());
      foreach ($classementPoule as $item) {
        if ($item->idCLub = '04450026') {$classement = $item; break;}
      }
      $equipe = $equipeRepository->findOneBy(['libelle' => $equipeFftt->getLibelle(), 'division' => $equipeFftt->getDivision(), 'lienDivision' => $equipeFftt->getLienDivision()]);
      if (empty($equipe)) {
        $equipe = new Equipe();
        $equipe->setLibelle($equipeFftt->getLibelle());
        $equipe->setLienDivision($equipeFftt->getLienDivision());
        $equipe->setDivision($equipeFftt->getDivision());
      }
      $equipe->setClassement($classement->getClassement());
      $this->em->persist($equipe);
      $this->em->flush();
      unset($equipe);
    }
    //    }
    return $this->respond('Mise à jour effectuée !');
  }
}