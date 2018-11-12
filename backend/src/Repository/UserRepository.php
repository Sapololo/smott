<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use function GuzzleHttp\Psr7\str;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method User|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = NULL, $limit = 5)
 *   NULL, $offset = NULL)
 */
class UserRepository extends ServiceEntityRepository {

  public function __construct(RegistryInterface $registry) {
    parent::__construct($registry, User::class);
  }

  public function transformAllFields(User $user) {
    return [
      'username' => (string) $user->getUsername(),
      'lastName' => (string) $user->getLastname(),
      'firstName' => (string) $user->getFirstname(),
      'email' => (string) $user->getEmail(),
      'roles' => (array) $user->getRoles(),
      'licenceId' => (string) $user->getLicenceId(),
    ];
  }

  public function transformAllDetailFields(User $user) {
    return [
      'id' => (int) $user->getId(),
      'username' => (string) $user->getUsername(),
      'lastName' => (string) $user->getLastname(),
      'firstName' => (string) $user->getFirstname(),
      'email' => (string) $user->getEmail(),
      'roles' => (array) $user->getRoles(),
      'licenceId' => (string) $user->getLicenceId(),
      'adherent' => (string) $user->getAdherent()
    ];
  }

  public function transformAll() {
    $users = $this->findAll();
    $usersArray = [];

    foreach ($users as $user) {
      $usersArray[] = $this->transformAllFields($user);
    }

    return $usersArray;
  }


  public function transformAllDetail() {
    $qb = $this->createQueryBuilder('u');
    $query = $qb->select('u')
      ->addSelect('a')
      ->leftJoin('App:Adherent','a','WITH',"a.licence_id = u.licence_id");
    $usersDetail =  $query->getQuery()->getResult();
    $usersDetailArray = [];

    foreach ($usersDetail as $userDetail) {
      $usersDetailArray[] = $this->transformAllDetailFields($usersDetail);
    }

    return $usersDetailArray;
  }

  public function findByTjl() {
    $qb = $this->createQueryBuilder('u');
    $query = $qb->select('u')
      ->innerJoin('App:Adherent','a','WITH',"a.licence = u.licenceId and a.tjl = 1");
    $usersDetail =  $query->getQuery()->getResult();
    $usersDetailArray = [];

    foreach ($usersDetail as $user) {
      $usersDetailArray[] = [
        'username' => (string) $user->getUsername(),
        'lastName' => (string) $user->getLastname(),
        'firstName' => (string) $user->getFirstname(),
        'email' => (string) $user->getEmail(),
        'roles' => (array) $user->getRoles(),
        'licenceId' => (string) $user->getLicenceId(),
      ];
    }

    return $usersDetailArray;
  }

  public function findByStage() {
    $qb = $this->createQueryBuilder('u');
    $query = $qb->select('u')
      ->innerJoin('App:Adherent','a','WITH',"a.licence = u.licenceId and a.stage = 1");
    $usersDetail =  $query->getQuery()->getResult();
    $usersDetailArray = [];

    foreach ($usersDetail as $user) {
      $usersDetailArray[] = [
        'username' => (string) $user->getUsername(),
        'lastName' => (string) $user->getLastname(),
        'firstName' => (string) $user->getFirstname(),
        'email' => (string) $user->getEmail(),
        'roles' => (array) $user->getRoles(),
        'licenceId' => (string) $user->getLicenceId(),
      ];
    }

    return $usersDetailArray;
  }

  public function findByPromo() {
    $qb = $this->createQueryBuilder('u');
    $query = $qb->select('u')
      ->innerJoin('App:Adherent','a','WITH',"a.licence = u.licenceId and a.type = 'Promotionnelle'");
    $usersDetail =  $query->getQuery()->getResult();
    $usersDetailArray = [];

    foreach ($usersDetail as $user) {
      $usersDetailArray[] = [
        'username' => (string) $user->getUsername(),
        'lastName' => (string) $user->getLastname(),
        'firstName' => (string) $user->getFirstname(),
        'email' => (string) $user->getEmail(),
        'roles' => (array) $user->getRoles(),
        'licenceId' => (string) $user->getLicenceId(),
      ];
    }

    return $usersDetailArray;
  }

  public function findByTradi() {
    $qb = $this->createQueryBuilder('u');
    $query = $qb->select('u')
      ->innerJoin('App:Adherent','a','WITH',"a.licence = u.licenceId and a.type = 'Traditionnelle'");
    $usersDetail =  $query->getQuery()->getResult();
    $usersDetailArray = [];

    foreach ($usersDetail as $user) {
      $usersDetailArray[] = [
        'username' => (string) $user->getUsername(),
        'lastName' => (string) $user->getLastname(),
        'firstName' => (string) $user->getFirstname(),
        'email' => (string) $user->getEmail(),
        'roles' => (array) $user->getRoles(),
        'licenceId' => (string) $user->getLicenceId(),
      ];
    }

    return $usersDetailArray;
  }


  public function findByAutres(array $type) {
    $users = $this->findBy($type);
    $usersArray = [];

    foreach ($users as $user) {
      $usersArray[] = $this->transformAllFields($user);
    }

    return $usersArray;
  }
}
