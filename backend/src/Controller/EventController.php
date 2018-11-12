<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class EventController extends ApiController
{

  /** @var TokenStorageInterface */
  private $tokenStorage;

  protected $security;

  /**
   * ObservationController constructor.
   * @param TokenStorageInterface $tokenStorage
   * @throws \Doctrine\Common\Annotations\AnnotationException
   */
  public function __construct(TokenStorageInterface $tokenStorage, Security $security)
  {
    $this->tokenStorage = $tokenStorage;
    $this->user = $tokenStorage->getToken()->getUser();
    $this->security = $security;
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/events")
   */
  public function listEvents(EventRepository $eventRepository)
  {
    $events = $eventRepository->listEvents();
    return $this->respond($events);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/eventbyid/{id}")
   */
  public function eventById($id, EventRepository $eventRepository)
  {
    $event = $eventRepository->findById($id);
    if (! $event) {
      return $this->respondNotFound();
    }
    return $this->respond($event);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/events/home")
   */
  public function home(EventRepository $eventRepository)
  {
//    $token = $this->tokenStorage->getToken();
//    if ($token === null) {
//      throw new AuthenticationCredentialsNotFoundException();
//    }
//
//    if (!$this->security->isGranted('ROLE_USER')) {
//      throw new AccessDeniedException();
//    }

    $events = $eventRepository->findByHome();
    return $this->respond($events);
  }
}
