<?php
namespace App\Controller;

use App\Entity\Video;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

class VideoController extends ApiController
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
   * @Rest\Get("/api/videos")
   */
  public function index(VideoRepository $videoRepository)
  {
    $videos = $videoRepository->transformAll();
    return $this->respond($videos);
  }

  /**
   * @Rest\View()
   * @Rest\Post("/api/video/{id}")
   */
  public function show($id, VideoRepository $videoRepository)
  {
    $video = $videoRepository->find($id);

    if (! $video) {
      return $this->respondNotFound();
    }

    $video = $videoRepository->transformAllFields($video);
    return $this->respond($video);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/videoLast")
   */
  public function last(VideoRepository $videoRepository)
  {
    $video = $videoRepository->findOneBy( array(), array('id' => 'DESC'));
    return $this->respond($videos = $videoRepository->transform($video));
  }

  /**
   * @Rest\View()
   * @Rest\Post("/videos/category/{categoryId}")
   */
  public function category($categoryId, VideoRepository $videoRepository)
  {
    $videos = $videoRepository->findBy(['categoryId' => $categoryId, 'enLigne' => '1']);

    if (! $videos) {
      return $this->respondNotFound();
    }

    $videos = $videoRepository->transformAll($videos);
    return $this->respond($videos);
  }
}