<?php

namespace App\Controller;

use App\Dto\EcritureDto;
use App\Service\EcritureService;
use App\Entity\Ecriture;
use App\Entity\Ecrituretype;
use App\Entity\Ecrrubrique;
use App\Repository\EcritureRepository;
use App\Repository\EcrituretypeRepository;
use App\Repository\EcrrubriqueRepository;
use App\Repository\EcrtypeRepository;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class EcritureController extends ApiController {

  /** @var ObjectManager */
  private $em;

  /**
   * EcritureController constructor.
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
   * @Rest\Get("/api/ecritures")
   */
  public function ecritures(EcritureRepository $ecritureRepository) {
    $ecritures = $ecritureRepository->transformAll();
    return $this->respond($ecritures);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/ecrituresRubrique/{id}")
   */
  public function ecrituresRubrique(EcritureRepository $ecritureRepository, int $id) {
    $ecritures = $ecritureRepository->findByRubriques($id);
    return $this->respond($ecritures);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/ecrrubriques")
   */
  public function ecrrubriques(EcrrubriqueRepository $ecrrubriqueRepository) {
    $ecrrubriques = $ecrrubriqueRepository->transformAll();
    return $this->respond($ecrrubriques);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/ecrtypes")
   */
  public function ecrtypes(EcrituretypeRepository $ecritureTypeRepository) {
    $ecrtypes = $ecritureTypeRepository->transformAll();
    return $this->respond($ecrtypes);
  }

  /**
   * @Rest\View()
   * @Rest\Post("/api/ecriture")
   * @IsGranted("ROLE_ADMIN")
   * @ParamConverter("data", converter="fos_rest.request_body")
   *
   * @param EcritureDto $data
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function createEcriture(EcritureDto $data, EntityManagerInterface $em, EcrrubriqueRepository $ecrrubriqueRepository) {

//    print_r($data);die('coucou');
    /** @var \App\Entity\Ecriture $ecriture */
    $ecriture = new Ecriture();
    $ecriture->setId(NULL);
    $ecriture->setDtecr(new \DateTime($data->getDtecr()));

    //    $ecriture->setEcrrubrique($ecrrubriqueRepository->find($data['rubrique']['id']));

    $ecriture->setDesignation($data->getDesignation());
    $ecriture->setCommentaire($data->getCommentaire());
    $ecriture->setPieceId($data->getPieceId());
    $ecriture->setTitulaire($data->getTitulaire());
    $ecriture->setTitulaireBanque($data->getTitulaireBanque());
    $ecriture->setNumChq($data->getNumChq());
    $ecriture->setMontant($data->getMontant());
    $ecriture->setNumDepot($data->getNumDepot());
    $ecriture->setNumReleve($data->getNumReleve());
    $ecriture->setEnLigne(0);
    $ecriture->setModification(new \DateTime());

    print_r($data->getType()->getId());
//    $type = new Ecrituretype();
//    $type->setId($data->getType()['id']);
//    $type->setDescription($data->getType()['description']);
//    $ecriture->setEcrituretype($type);
//    $ecriture->setEcrituretype($data->getType());

//    $ecrrubrique = new Ecrrubrique();
//    $ecrrubrique->setId($data->getRubrique()['id']);
//    $ecrrubrique->setDescription($data->getRubrique()['description']);
//    $ecrrubrique->setCode($data->getRubrique()['code']);
////    $ecrrubrique->setNiveau($data->getRubrique()['niveau']);
//    $ecrrubrique->setTitre($data->getRubrique()['titre']);
//    $ecriture->setEcrrubriqueId($data->getRubrique()->getId());

//    print_r($data->getRubrique()->getId());
    print_r($ecriture);
//    die('coucou');
    $em->persist($ecriture);
    $em->flush();

    return $this->respond('Sauvegarde de la nouvelle écriture avec id ' . $ecriture->getId());
  }

  /**
   * @Rest\View()
   * @Rest\Put("/api/ecriture/{id}")
   * @IsGranted("ROLE_ADMIN")
   * @ParamConverter("data", converter="fos_rest.request_body")
   *
   * @param EcritureDto $data
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function updateEcriture(EcritureDto $data, EntityManagerInterface $em, int $id) {

//    print_r($data);
    /** @var EcritureRepository $ecr */
    $ecr = $em->getRepository(Ecriture::class);
    $ecriture = $ecr->findOneBy(['id' => $data->getId()]);
//    $ecriture = $ecr->find($id);
    if (!$ecriture) {
      throw new NotFoundHttpException();
    }
    else {
      $ecriture->setDtecr(new \DateTime($data->getDtecr()));
      $ecriture->setModification(new \DateTime());
      $ecriture->setDesignation($data->getDesignation());
      if ($data->getCommentaire()) {
        $ecriture->setCommentaire($data->getCommentaire());
      }
      // Update type de paiement
      $ecrType = $ecriture->getEcrituretype();
      if (!$ecrType) {
        $ecrType = new Ecrituretype();
      }
      $ecrType->setId($data->getType()->getId());
      $ecrType->setDescription($data->getType()->getDescription());
      $ecriture->setEcrituretype($ecrType);

      // Update rubrique
      $ecrRubrique = $ecriture->getEcrrubrique();
      if (!$ecrRubrique) {
        $ecrRubrique = new Ecrrubrique();
      }
      $ecrRubrique->setId($data->getRubrique()->getId());
      $ecrRubrique->setCode($data->getRubrique()->getCode());
      $ecrRubrique->setNiveau($data->getRubrique()->getNiveau());
      $ecrRubrique->setTitre($data->getRubrique()->getTitre());
      $ecrRubrique->setDescription($data->getRubrique()->getDescription());
      $ecriture->setEcrrubrique($ecrRubrique);

      //      $ecriture->setEcrrubrique($data->getRubrique());
      //      //      $ecriture->setPieceId($data['pieceId']);
      if ($data->getTitulaire() !== null) {
        $ecriture->setTitulaire($data->getTitulaire());
      }
      if ($data->getTitulaireBanque()) {
        $ecriture->setTitulaireBanque($data->getTitulaireBanque());
      }
      if ($data->getNumChq() !== null) {
        $ecriture->setNumChq($data->getNumChq());
      }
      $ecriture->setMontant($data->getMontant());
      if ($data->getNumDepot() !== null) {
        $ecriture->setNumDepot($data->getNumDepot());
      }
      if ($data->getNumReleve() !== null) {
        $ecriture->setNumReleve($data->getNumReleve());
      }

//      print_r($ecriture);
      $em->persist($ecriture);
      $em->flush();
      return $this->respond('Sauvegarde de l écriture avec id ' . $ecriture->getId());
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/remise/{date}")
   * @IsGranted("ROLE_BUREAU")
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function voirRemise(EcritureRepository $ecritureRepository, string $date) {
    //    $dtremise = new \DateTime(substr($date, 4, 4) . '-' . substr($date, 2, 2) . '-' . substr($date, 0, 2));
    $dtremise = new \DateTime($date);
    $ecritures = $ecritureRepository->findByDtecr($dtremise);

    return $this->respond($ecritures);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/compteresultat/{type}")
   * @IsGranted("ROLE_BUREAU")
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function compteResultat(EcritureRepository $ecritureRepository, EcrrubriqueRepository $ecrrubriqueRepository, int $type) {
    // Gestion de la recherche
    //    $dtdebut = '2017-06-01';
    //    $dtfin = '2018-05-31';

    $results = $ecritureRepository->findByCompteResultat($type);
    return $this->respond($this->arraySort($results, 'code', SORT_ASC));
  }

  public function arraySort($array, $on, $order = SORT_ASC) {
    $new_array = [];
    $sortable_array = [];

    if (count($array) > 0) {
      foreach ($array as $k => $v) {
        if (is_array($v)) {
          foreach ($v as $k2 => $v2) {
            if ($k2 == $on) {
              $sortable_array[$k] = $v2;
            }
          }
        }
        else {
          $sortable_array[$k] = $v;
        }
      }

      switch ($order) {
        case SORT_ASC:
          asort($sortable_array);
          break;
        case SORT_DESC:
          arsort($sortable_array);
          break;
      }

      foreach ($sortable_array as $k => $v) {
        $new_array[$k] = $array[$k];
      }
    }

    return $new_array;
  }
}