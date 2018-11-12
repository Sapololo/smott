<?php

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use FOS\UserBundle\Model\UserManagerInterface;

class JWTCreatedListener {

  /**
   * @var RequestStack
   */
  private $requestStack;

  /**
   * @var UserManagerInterface
   */
  private $userManagerInterface;


  /**
   * @param RequestStack $requestStack
   * @param UserManagerInterface $userManagerInterface
   */
  public function __construct(RequestStack $requestStack,UserManagerInterface $userManagerInterface)
  {
    $this->requestStack = $requestStack;
    $this->userManagerInterface = $userManagerInterface;
  }

  /**
   * @param JWTCreatedEvent $event
   *
   * @return void
   */
  public function onJWTCreated(JWTCreatedEvent $event)
  {
    $request = $this->requestStack->getCurrentRequest();

    // TODO: Modifier TTL si on est en train de réinitialiser le mot de passe (setHeader)
    $payload = $event->getData();
//    $username = $event->getUser();
//    $user = $provider->loadUserByUsername($user->getUsername());
    $user = $this->userManagerInterface->findUserByUsername($event->getUser());

    $payload['firstName'] = $user->getFirstname();
    $payload['lastName'] = $user->getLastname();
    $payload['email'] = $user->getEmail();
    $payload['id'] = $user->getId();
    $payload['genre'] = $user->getGenre();
    $payload['licenceId'] = $user->getLicenceId();
    
    $event->setData($payload);
  }
}