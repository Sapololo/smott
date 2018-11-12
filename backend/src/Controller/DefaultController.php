<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controlleur REST racine permettant de tester la disponibilité de l'API.
 *
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends Controller
{
  /**
   * @View()
   * @Get("/")
   */
  public function indexAction()
  {
    return ["St Marceau Orléans Tennis Table API is ready."];
  }

}
