<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Dto\AdherentDto;
use App\Repository\AdherentRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FFTTApi\FFTTApi;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\IsNull;

class AdherentController extends ApiController {

  /** @var ObjectManager */
  private $em;

  /**
   * AdherentController constructor.
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
   * @Rest\Put("/api/adherent")
   * @IsGranted("ROLE_ADMIN")
   * @ParamConverter("data", converter="fos_rest.request_body")
   *
   * @param AdherentDto $data
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function updateAdherent(AdherentDto $data, EntityManagerInterface $em) {
    //    print_r($data);
    /** @var AdherentRepository $adh */
    $adh = $em->getRepository(Adherent::class);
    //    $adherent = $adh->findOneByLicence($data->getLicence());
    $adherent = $adh->findOneBy(['licence' => $data->getLicence()]);

    // Update ville
    $ville = $adherent->getVille();
    if (!$ville) {
      $ville = new Ville();
    }
    $ville->setId($data->getVille()->getId());
    $ville->setVille($data->getVille()->getVille());
    $adherent->setVille($ville);

    if ($data->getNumero() !== "") {
      $adherent->setNumero($data->getNumero());
    }
    else {
      $adherent->setNumero(NULL);
    }
    if ($data->getVoie() !== "") {
      $adherent->setVoie($data->getVoie());
    }
    else {
      $adherent->setVoie(NULL);
    }
    if ($data->getRue() !== "") {
      $adherent->setRue($data->getRue());
    }
    else {
      $adherent->setRue(NULL);
    }
    if ($data->getPerso() !== "") {
      $adherent->setPerso($data->getPerso());
    }
    else {
      $adherent->setPerso(NULL);
    }
    if ($data->getPortable() !== "") {
      $adherent->setPortable($data->getPortable());
    }
    else {
      $adherent->setPortable(NULL);
    }
    if ($data->getProf() !== "") {
      $adherent->setProf($data->getProf());
    }
    else {
      $adherent->setProf(NULL);
    }
    if ($data->getResp() !== "") {
      $adherent->setResp($data->getResp());
    }
    else {
      $adherent->setResp(NULL);
    }
//    if ($data->getProf1() !== "") {
//      $adherent->setProf1($data->getProf1());
//    }
//    else {
//      $adherent->setProf1(NULL);
//    }
//    if ($data->getProf2() !== "") {
//      $adherent->setProf2($data->getProf2());
//    }
//    else {
//      $adherent->setProf2(NULL);
//    }

//    $adherent->setStage($data->getStage());
//    $adherent->setTjl($data->getTjl());

    //    print_r($adherent);
    //    die('coucou');
    $em->persist($adherent);
    $em->flush();

    return $this->respond('Sauvegarde de l\'adherent avec id ' . $adherent->getId());
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/adherents")
   */
  public function adherents(AdherentRepository $adherentRepository) {
    $adherents = $adherentRepository->transformAll();
    return $this->respond($adherents);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/initVirtualPointAdherents")
   */
  public function initVirtualPointAdherents() {
    try {
      $qb = $this->em->createQueryBuilder('e');
      $qb->query('UPDATE e SET `points_virtuel`=null');
      $qb->commit;
    } catch (\Exception $e) {
      $qb->rollback();
    }
    return TRUE;
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/updateadherents")
   */
  public function updateadherents(AdherentRepository $adherentRepository, EntityManagerInterface $em) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    $joueurs = $api->getJoueursDetailsByClub('04450026');

    //    die('stop');
    foreach ($joueurs as $joueur) {
      //      $usr = $em->getRepository(User::class);
      //      $user = $usr->findOneBy(['licence' => $joueur->getLicence()]);
      //      if (!$user) {
      //        $user = new User();
      //        $user->setLicence($joueur->getLicence());
      //        $user->setLastname($joueur->getNom());
      //        $user->setFirstname($joueur->getPrenom());}
      //      if ($joueur->getType() === 'Traditionnelle' && $joueur->getLicence() === '451917') {
      //      if ($joueur->getType() === 'Traditionnelle') {
      //      $adherent = $adherentRepository->findBy(['licence' => $joueur->getLicence(), 'pointsVirtuel' => null]);
      /** @var AdherentRepository $adherent */
      $adh = $em->getRepository(Adherent::class);
      $adherent = $adh->findOneByLicence($joueur->getLicence());
      if (!$adherent) {
        $adherent = new Adherent();
        $adherent->setLicence($joueur->getLicence());
        $adherent->setNom($joueur->getNom());
        $adherent->setPrenom($joueur->getPrenom());
        $adherent->setClassement($joueur->getClassement());
        $adherent->setType($joueur->getType());
        $adherent->setIsHomme($joueur->getIsHomme());
        $adherent->setPointsLicence($joueur->getPointsLicence());
        $adherent->setPointsMensuel($joueur->getPointsMensuel());
        /* Recherche des points virtuel */
        //          if ($joueur->getLicence() != '4521564' && $joueur->getLicence() != '457429') {
        $pointsvirtuel = $api->getVirtualPoints($joueur->getLicence());
        //          }
        //          else {
        //            $pointsvirtuel = 0;
        //          }
        $adherent->setPointsVirtuel($pointsvirtuel);
        $this->em->persist($adherent);
        $this->em->flush();
        unset($adherent);
      }
      else {
        if (is_null($adherent->getPointsVirtuel())) {
          //        else  {
          $adherent->setPointsLicence($joueur->getPointsLicence());
          $adherent->setPointsMensuel($joueur->getPointsMensuel());
          /* Recherche des points virtuel */
          $pointsvirtuel = $api->getVirtualPoints($joueur->getLicence());
          $adherent->setPointsVirtuel($pointsvirtuel);
          $em->persist($adherent);
          $em->flush();
          unset($adherent);
        }
      }
    }
    //    }
    return $this->respond('Mise à jour effectuée !');
  }
}