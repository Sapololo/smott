<?php
namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations as Rest;

class ArticleController extends ApiController
{
  /**
   * @Rest\View()
   * @Rest\Get("/api/articles")
   */
  public function index(ArticleRepository $articleRepository)
  {
    $articles = $articleRepository->transformAll();
    return $this->respond($articles);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/articles/home")
   */
  public function home(ArticleRepository $articleRepository)
  {
    $articles = $articleRepository->findByHome();
    return $this->respond($articles);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/article/{id}")
   */
  public function show($id, ArticleRepository $articleRepository)
  {
    $article = $articleRepository->find($id);

    if (! $article) {
      return $this->respondNotFound();
    }

    $article = $articleRepository->transformAllFields($article);

    return $this->respond($article);
  }

//  /**
//   * @Rest\View()
//   * @Rest\Put("/api/article")
//   */
//  public function create(Request $request, ArticleRepository $articleRepository, EntityManagerInterface $em)
//  {
//    $request = $this->transformJsonBody($request);
//
//    if (! $request) {
//      return $this->respondValidationError('Please provide a valid request!');
//    }
//
//    // validate the title
//    if (! $request->get('title')) {
//      return $this->respondValidationError('Please provide a title!');
//    }
//
//    // persist the new article
//    $article = new Article;
//    $article->setTitle($request->get('title'));
//    $article->setCount(0);
//    $em->persist($article);
//    $em->flush();
//
//    return $this->respondCreated($articleRepository->transform($article));
//  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/articles/{id}/count")
   */
  public function increaseCount($id, EntityManagerInterface $em, ArticleRepository $articleRepository)
  {
    $article = $articleRepository->find($id);

    if (! $article) {
      return $this->respondNotFound();
    }

    $article->setCount($article->getCount() + 1);
    $em->persist($article);
    $em->flush();

    return $this->respond([
      'count' => $article->getCount()
    ]);
  }
}