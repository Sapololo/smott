<?php

namespace App\Repository;

use App\Entity\Adherent;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @method Ville|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method Ville|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method Ville[]    findAll()
 * @method Ville[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class AdherentRepository extends EntityRepository {

  public function __construct(EntityManagerInterface $em)
  {
    parent::__construct($em, $em->getClassMetadata(Adherent::class));
  }

  public function transformFields(Adherent $adherent) {
    return [
      'id' => (int) $adherent->getId(),
      'licence' => (string) $adherent->getLicence(),
      'nom' => (string) $adherent->getNom(),
      'prenom' => (string) $adherent->getPrenom(),
      'classement' => (string) $adherent->getClassement(),
      'type' => (string) $adherent->getType(),
      'isHomme' => (boolean) $adherent->getisHomme(),
      'pointsLicence' => (string) $adherent->getPointsLicence(),
      'pointsMensuel' => (string) $adherent->getPointsMensuel(),
      'pointsVirtuel' => (string) $adherent->getPointsVirtuel(),
      'classVirtuel' => (string) $adherent->getClassVirtuel(),
      'progression' => (string) $adherent->getProgression(),
      'ville' => (array) $adherent->getVille(),
      'numero' => (integer) $adherent->getNumero(),
      'voie' => (string) $adherent->getVoie(),
      'rue' => (string) $adherent->getRue(),
      'perso' => (string) $adherent->getPerso(),
      'portable' => (string) $adherent->getPortable(),
      'prof' => (string) $adherent->getProf(),
      'resp' => (string) $adherent->getResp(),
      'prof1' => (string) $adherent->getProf1(),
      'prof2' => (string) $adherent->getProf2(),
      'avatar' => (string) $adherent->getAvatar(),
      'facebook' => (string) $adherent->getFacebook(),
      'twitter' => (string) $adherent->getTwitter(),
      'categ' => (string) $adherent->getCateg(),
      'dtLicence' => (string) $adherent->getDtlicence(),
//      'dtLicence' => (string) $adherent->getDtlicence()->format('d/m/Y'),
//      'dtNais' => (string) $adherent->getDtNais()->format('d/m/Y'),
      'cdnais' => (boolean) $adherent->getCdnais(),
      'stage' => (boolean) $adherent->getStage(),
      'tjl' => (boolean) $adherent->getTjl(),
      'lat' => (float) $adherent->getLat(),
      'lng' => (float) $adherent->getLng(),
    ];
  }

public function transformAllFields(Adherent $adherent) {
    return [
      'id' => (int) $adherent->getId(),
      'licence' => (string) $adherent->getLicence(),
      'nom' => (string) $adherent->getNom(),
      'prenom' => (string) $adherent->getPrenom(),
      'classement' => (string) $adherent->getClassement(),
      'type' => (string) $adherent->getType(),
      'isHomme' => (boolean) $adherent->getisHomme(),
      'pointsLicence' => (string) $adherent->getPointsLicence(),
      'pointsMensuel' => (string) $adherent->getPointsMensuel(),
      'pointsVirtuel' => (string) $adherent->getPointsVirtuel(),
      'classVirtuel' => (string) $adherent->getClassVirtuel(),
      'progression' => (string) $adherent->getProgression(),
      'ville' => (array) $adherent->getVille(),
//      'user' => (array) $adherent->getUser(),
      'numero' => (integer) $adherent->getNumero(),
      'voie' => (string) $adherent->getVoie(),
      'rue' => (string) $adherent->getRue(),
      'perso' => (string) $adherent->getPerso(),
      'portable' => (string) $adherent->getPortable(),
      'prof' => (string) $adherent->getProf(),
      'resp' => (string) $adherent->getResp(),
      'prof1' => (string) $adherent->getProf1(),
      'prof2' => (string) $adherent->getProf2(),
      'avatar' => (string) $adherent->getAvatar(),
      'facebook' => (string) $adherent->getFacebook(),
      'twitter' => (string) $adherent->getTwitter(),
      'categ' => (string) $adherent->getCateg(),
      'dtLicence' => (string) $adherent->getDtlicence(),
//      'dtLicence' => (string) $adherent->getDtlicence()->format('d/m/Y'),
//      'dtNais' => (string) $adherent->getDtNais()->format('d/m/Y'),
      'cdnais' => (boolean) $adherent->getCdnais(),
      'stage' => (boolean) $adherent->getStage(),
      'tjl' => (boolean) $adherent->getTjl(),
      'lat' => $adherent->getLat(),
      'lng' => $adherent->getLng(),
    ];
  }

  public function transformAll() {
    $qb = $this->createQueryBuilder('a');
    $query = $qb->select('a')
      ->addSelect('v')
//      ->addSelect('u')
      ->leftJoin('a.ville', 'v');
//      ->leftJoin('a.user', 'u');
    $adherents =  $query->getQuery()->getResult();
//    print_r($adherents);
    $adherentsArray = [];

    foreach ($adherents as $adherent) {
      $adherentsArray[] = $this->transformAllFields($adherent);
    }

    return $adherentsArray;
  }

  public function findOneByLicence(string $licence) {

    $qb = $this->createQueryBuilder('a');
    $query = $qb->select('a')
      ->addSelect('v')
      ->leftJoin('a.villeId', 'v')
      ->where('a.licence_id = ?1')
      ->setParameter(1, $licence);

    $adherent =  $query->getQuery()->getResult();
    print_r($adherent);
    return $this->transformFields($adherent);
  }
}
