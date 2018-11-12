<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FFTTApi\FFTTApi;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;
use FFTTApi\Model\JoueurDetails;

class FfttController extends ApiController {

  /** @var TokenStorageInterface */
  private $tokenStorage;

  protected $security;


  /**
   * ObservationController constructor.
   *
   * @param TokenStorageInterface $tokenStorage
   *
   * @throws \Doctrine\Common\Annotations\AnnotationException
   */
  public function __construct(TokenStorageInterface $tokenStorage, Security $security) {
    $this->tokenStorage = $tokenStorage;
    $this->user = $tokenStorage->getToken()->getUser();
    $this->security = $security;
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/statistiques")
   */
  public function statistiques() {
    // Gestion de la recharche
    $numclub = '04450026';
    $api = new FFTTApi("SW123", "87JYuK2XeR");


    if (!empty($numclub)) {
      $club = $api->getClubDetails($numclub);
      //      $players = $api->getJoueursDetailsByClub($numclub);

      //        $club['classement'] = [
      //          '5'     => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'6'    => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'7'    => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'8'    => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'9'    => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'10'   => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'11'   => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'12'   => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'13'   => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'14'   => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'15'   => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'16'   => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'17'   => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'18'   => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'19'   => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'20'   => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //          ,'N°'   => ['tradih' => 0, 'tradif' => 0, 'tradi' => 0, 'promoh' => 0, 'promof' => 0, 'promo' => 0]
      //        ];
      //
      //        // Ajout des catégories
      //        $club['categorie'] = [
      //          'Poussin'       => ['tradih'=> 0, 'tradif'=> 0, 'tradi'=> 0, 'promoh'=> 0, 'promof'=> 0, 'promo'=> 0]
      //          ,'Benjamin'     => ['tradih'=> 0, 'tradif'=> 0, 'tradi'=> 0, 'promoh'=> 0, 'promof'=> 0, 'promo'=> 0]
      //          ,'Minime'       => ['tradih'=> 0, 'tradif'=> 0, 'tradi'=> 0, 'promoh'=> 0, 'promof'=> 0, 'promo'=> 0]
      //          ,'Cadet'        => ['tradih'=> 0, 'tradif'=> 0, 'tradi'=> 0, 'promoh'=> 0, 'promof'=> 0, 'promo'=> 0]
      //          ,'Junior'       => ['tradih'=> 0, 'tradif'=> 0, 'tradi'=> 0, 'promoh'=> 0, 'promof'=> 0, 'promo'=> 0]
      //          ,'Sénior'       => ['tradih'=> 0, 'tradif'=> 0, 'tradi'=> 0, 'promoh'=> 0, 'promof'=> 0, 'promo'=> 0]
      //          ,'Vétéran 1'    => ['tradih'=> 0, 'tradif'=> 0, 'tradi'=> 0, 'promoh'=> 0, 'promof'=> 0, 'promo'=> 0]
      //          ,'Vétéran 2'    => ['tradih'=> 0, 'tradif'=> 0, 'tradi'=> 0, 'promoh'=> 0, 'promof'=> 0, 'promo'=> 0]
      //          ,'Vétéran 3'    => ['tradih'=> 0, 'tradif'=> 0, 'tradi'=> 0, 'promoh'=> 0, 'promof'=> 0, 'promo'=> 0]
      //          ,'Vétéran 4+'   => ['tradih'=> 0, 'tradif'=> 0, 'tradi'=> 0, 'promoh'=> 0, 'promof'=> 0, 'promo'=> 0]
      //        ];
      //
      //        // Ajout des totaux
      //        $club['nbjoueurs'] = $club['nbtradi'] = $club['nbpromo'] = $club['nbtradih'] = $club['nbtradif'] = $club['nbpromoh'] = $club['nbpromof'] = $club['nbh'] = $club['nbf'] = 0;
      //        foreach($joueurs as $joueur) {
      //
      //          if ($joueur['cat'] == 'V4M' || $joueur['cat'] == 'V4D'){ $joueur_cat = 'V4';} else {$joueur_cat = $joueur['cat'];};
      //          switch($joueur_cat) {
      //            case 'P': $cat = 'Poussin'; break;
      //            case 'B1': case 'B2': $cat = 'Benjamin'; break;
      //            case 'M1': case 'M2': $cat = 'Minime'; break;
      //            case 'C1': case 'C2': $cat = 'Cadet'; break;
      //            case 'J1': case 'J2': case 'J3': $cat = 'Junior'; break;
      //            case 'S': $cat = 'Sénior'; break;
      //            case 'V1': $cat = 'Vétéran 1'; break;
      //            case 'V2': $cat = 'Vétéran 2'; break;
      //            case 'V3': $cat = 'Vétéran 3'; break;
      //            case 'V4': case 'V5': case 'V6': $cat = 'Vétéran 4+'; break;
      //          }
      //          $cla = floor((float)$joueur['point']/100);
      //          if ($joueur['type'] == 'T') {
      //            if (!empty($joueur['echelon']) && !empty($joueur['place'])) {$cla = 'N°';}
      //
      //            //Calcul des points
      //            //                $data[$joueur][] = $joueur["pointm"]; // Points mensuels
      //            //                $data[$joueur][] = $joueur["apointm"]; // Anciens points mensuels
      //            //                $data[$joueur][] = $joueur["pointm"]; // Valeur initiale
      //
      //            $club['nbtradi']++;
      //            $club['classement'][$cla]['tradi']++;
      //            $club['categorie'][$cat]['tradi']++;
      //            if ($joueur['sexe'] == 'M') {
      //              $club['nbtradih']++;
      //              $club['classement'][$cla]['tradih']++;
      //              $club['categorie'][$cat]['tradih']++;
      //            } else {
      //              $club['nbtradif']++;
      //              $club['classement'][$cla]['tradif']++;
      //              $club['categorie'][$cat]['tradif']++;
      //            }
      //          } else {
      //            $club['nbpromo']++;
      //            $club['classement'][$cla]['promo']++;
      //            $club['categorie'][$cat]['promo']++;
      //            if ($joueur['sexe'] == 'M') {
      //              $club['nbpromoh']++;
      //              $club['classement'][$cla]['promoh']++;
      //              $club['categorie'][$cat]['promoh']++;
      //            } else {
      //              $club['nbpromof']++;
      //              $club['classement'][$cla]['promof']++;
      //              $club['categorie'][$cat]['promof']++;
      //            }
      //          }
      //          $club['nbjoueurs']++;
      //          if ($joueur['sexe'] == 'M') {$club['nbh']++;} else {$club['nbf']++;}
      //        }
      //
      //        $maxcla = '5';
      //        foreach($club['classement'] as $classement => $stats) {
      //          if ($stats['tradi'] > $club['classement'][$maxcla]['tradi']) {
      //            $maxcla = $classement;
      //          }
      //        }
      //
      //        $maxcat = 'Poussin';
      //        foreach($club['categorie'] as $cat => $stats) {
      //          if ($stats['tradi'] > $club['categorie'][$maxcat]['tradi']) {
      //            $maxcat = $cat;
      //          }
      //        }
      //        //            debug ($club['classement']);
      //        foreach($club['classement'] as $classement => &$stats) {
      //          $stats['pm'] = $stats['tradi'] > 0 ? round(100*$stats['tradih']/($stats['tradi']), 1) : 0;
      //          $stats['pf'] = round(100 - $stats['pm'], 1);
      //          $stats['pt'] = $stats['tradi'] > 0 ? round(100*$stats['tradi']/($club['classement'][$maxcla]['tradi']), 1) : 0;
      //          if ($stats['tradi'] > 0) {
      //            $bar_label[] = ["value" => $classement];
      //            $bar_m[] = ["value" => $stats['tradih']];
      //            $bar_f[] = ["value" => $stats['tradif']];
      //          }
      //        }
      //
      //        foreach($club['categorie'] as $cat => &$stats) {
      //          $stats['pm'] = $stats['tradi'] > 0 ? round(100*$stats['tradih']/($stats['tradi']), 1) : 0;
      //          $stats['pf'] = round(100 - $stats['pm'], 1);
      //          $stats['pt'] = $stats['tradi'] > 0 ? round(100*$stats['tradi']/($club['categorie'][$maxcat]['tradi']), 1) : 0;
      //          //                if ($stats['tradih'] > 0) {
      //          //                    $cat_label[] = ["value" => $cat];
      //          //                    $cat_m[] = ["value" => $stats['tradih']];
      //          //                    $cat_f[] = ["value" => $stats['tradif']];
      //          //                }
      //
      //          $cat_label[] = ["value" => $cat];
      //          $cat_m[] = ["value" => $stats['tradih']];
      //          $cat_f[] = ["value" => $stats['tradif']];
      //          $catp_m[] = ["value" => $stats['promoh']];
      //          $catp_f[] = ["value" => $stats['promof']];
      //        }
      //
      //        if($club['nbjoueurs'] > 0){
      //          $club['ph'] = round(100 * $club['nbh'] / $club['nbjoueurs'], 2);
      //          $club['pf'] = 100 - $club['ph'];}
      //
      //        /*  Ajout des statistiques spécifiques à Saint Marceau Orléans Tennis de Table */
      //        //            debug(Configure::read('Site.club'));
      //        if ($club['numero'] == Configure::read('Site.club'))
      //        {
      //          //                $this->loadModel('Statistiques');
      //          //
      //          //                /* Récupération des Statistiques */
      //          //                $statistiques = $this->Statistiques->find()->order(['Statistiques.saison' => 'desc']);
      //          //                foreach($statistiques as $v) {
      //          //                    $stats_licencies[] = ["x"=>$v["saison"], "y" => $v["nblicencie"]];
      //          //                    $stats_hommes[] = ["x"=>$v["saison"], "y" => $v["nb_hommes"]];
      //          //                    $stats_femmes[] = ["x"=>$v["saison"], "y" => $v["nb_femmes"]];
      //          //                }
      //          //
      //          //				$this->set(compact('statistiques'));
      //
      //          /* Récupération le nombre de stagiaire */
      //          $this->loadModel('Users');
      //          $stagiaireCount = Number::format($this->Users->find()->where('Users.stage = 1')->count());
      //
      //          /* Récupération le nombre de licencié */
      //          $licencieCount = Number::format($this->Users->find()->where('Users.fftt = 1')->count());
      //
      //          /* Récupération le nombre de licencié */
      //          $enligneCount = Number::format($this->Users->find()->where('Users.en_ligne = 1')->count());
      //
      //          $this->set(compact('statistiques', 'stagiaireCount', 'licencieCount', 'enligneCount'));
      //
      //        }

      return $this->respond($club);
      //      return $this->respond($club, $players);
      //        $this->set(compact('club','bar_label','bar_m','bar_f','cat_label','cat_m','cat_f','catp_m','catp_f'));
      //        $this->set('description', 'Retrouvez toutes les statisques du club de '.$club['nom'].', répartition par catégories, par âges, types de licence ... !');
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/clubdetail/{clubId}")
   */
  public function clubdetail($clubId) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($clubId)) {
      $club = $api->getClubDetails($clubId);
      return $this->respond($club);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/joueursDetailsByClub/{clubId}")
   */
  public function joueursDetailsByClub($clubId) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($clubId)) {
      $joueurs = $api->getJoueursDetailsByClub($clubId);
      return $this->respond($joueurs);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/joueursByNom")
   * @param Request $request
   */
  public function JoueursByNom(Request $request) {
    $token = $this->tokenStorage->getToken();
    if ($token === NULL) {
      throw new AuthenticationCredentialsNotFoundException();
    }

    if (!$this->security->isGranted('ROLE_USER')) {
      throw new AccessDeniedException();
    }

    $content = $request->getContent();
    $data = json_decode($request->getContent(), TRUE);
    $nom = $data['nom'];
    $prenom = $data['prenom'];
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($nom) || !empty($prenom)) {
      $listJoueurs = $api->getJoueursByNom($nom, $prenom);
      return $this->respond($listJoueurs);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/JoueurDetailsByLicence/{licence}")
   */
  public function JoueurDetailsByLicence($licence) {
    $token = $this->tokenStorage->getToken();
    if ($token === NULL) {
      throw new AuthenticationCredentialsNotFoundException();
    }

    if (!$this->security->isGranted('ROLE_USER')) {
      throw new AccessDeniedException();
    }

    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($licence)) {
      $joueur = $api->getJoueurDetailsByLicence($licence);
      return $this->respond($joueur);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/ClassementJoueurByLicence/{licence}")
   */
  public function ClassementJoueurByLicence($licence) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($licence)) {
      $classement = $api->getClassementJoueurByLicence($licence);
      return $this->respond($classement);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/PartiesJoueurByLicence/{licence}")
   */
  public function PartiesJoueurByLicence($licence) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($licence)) {
      $partie = $api->getPartiesJoueurByLicence($licence);
      return $this->respond($partie);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/UnvalidatedPartiesJoueurByLicence/{licence}")
   */
  public function UnvalidatedPartiesJoueurByLicence($licence) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($licence)) {
      $UnvalidatedPartie = $api->getUnvalidatedPartiesJoueurByLicence($licence);
      return $this->respond($UnvalidatedPartie);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/HistoriqueJoueurByLicence/{licence}")
   */
  public function HistoriqueJoueurByLicence($licence) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($licence)) {
      $partie = $api->getHistoriqueJoueurByLicence($licence);
      return $this->respond($partie);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/equipes/{clubId}/{type}")
   */
  public function lesquipes($clubId, $type) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($clubId)) {
      $equipes = $api->getEquipesByClub($clubId, $type);

      //        $teamsF = Servicefftt::getEquipesByClub($this->request->club, 'F');
      //        if (!empty($teamsF)) {
      //          $club['nbteamFP1'] = $club['nbteamFP2'] = 0;
      //          // Comptage du nombre d'équipes
      //          if(!empty($teamsF[0])) {
      //            foreach($teamsF as &$v) {
      //              if ($v['phase'] == 1) {$club['nbteamFP1']++;}
      //              if ($v['phase'] == 2) {$club['nbteamFP2']++;}
      //            }
      //          } else {
      //            if ($teamsF['phase'] == 1) {$club['nbteamFP1']++;}
      //            if ($teamsF['phase'] == 2) {$club['nbteamFP2']++;}
      //          }
      //          $this->set(compact('teamsF'));
      //        }

      //
      //        $this->set(compact('club'));
      //        $this->set('title_for_layout', 'Liste des equipes du club de '.$club['nom']);
      //      } else {$this->set('title_for_layout', 'Club non trouvé !');}
      //    }
      //
      return $this->respond($equipes);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/equipeClassementPoule/{lienDivision}")
   */
  public function equipeClassementPoule($lienDivision) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($lienDivision)) {
      $equipe = $api->getClassementPouleByLienDivision($lienDivision);
      return $this->respond($equipe);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/rencontrePoule/{lienDivision}")
   */
  public function rencontrePoule($lienDivision) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($lienDivision)) {
      $rencontrePoule = $api->getRencontrePouleByLienDivision($lienDivision);
      return $this->respond($rencontrePoule);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/detailsRencontre/{lienDivision}/{clubEquipeA}/{clubEquipeB}")
   */
  public function detailsRencontreByLien($lienDivision, $clubEquipeA, $clubEquipeB) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($lienDivision)) {
      $rencontreDetails = $api->getDetailsRencontreByLien($lienDivision, $clubEquipeA, $clubEquipeB);
      return $this->respond($rencontreDetails);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/actualite")
   */
  public function actualite() {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    $actu = $api->getActualite();
    return $this->respond($actu);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/statistiquesClub/{clubId}")
   */
  public function statistiquesClub($clubId) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($clubId)) {
      $stats = $api->getStatistiquesByClub($clubId);
      return $this->respond($stats);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/ClubsByDepartement/{departementId}")
   */
  public function ClubsByDepartement(string $departementId) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($departementId)) {
      $clubs = $api->getClubsByDepartement(substr($departementId,1, strlen($departementId) - 1));
      return $this->respond($clubs);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/organisme/{type}")
   */
  public function organisme($type) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($type)) {
      $organismes = $api->getOrganismes($type);
      return $this->respond($organismes);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/virtualpoints/{licence}")
   */
  public function VirtualPoints($licence) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($licence)) {
      $virtualPointWon = $api->getVirtualPoints($licence);
      return $this->respond($virtualPointWon);
    }
    else {
      return $this->respondNotFound();
    }
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/fftt/brulages/{clubId}")
   */
  public function Brulages($clubId) {
    $api = new FFTTApi("SW123", "87JYuK2XeR");
    if (!empty($clubId)) {
      //      $club = $api->getClub($clubId);
      $teams = $api->getEquipesByClub($clubId, 'M');
      $club['nbteamMP1'] = $club['nbteamMP2'] = 0;

      $lstrencontres = [];
      // Comptage du nombre d'équipes
      foreach ($teams as &$v) {
        //        print_r($v->getLibelle());
        //        if ($v->getPhase() == 1) {$club['nbteamMP1']++;}
        //        if ($v->getPhase() == 2) {$club['nbteamMP2']++;}
        //        $params = [];
        //        parse_str($v->getLienDivision(), $params);
        //        $v['idorg'] = $params['organisme_pere'];

        $rencontres = $api->getRencontrePouleByLienDivision($v->getLienDivision());
        //              Suppression des rencontres qui ne sont pas du club
        $dateNow = new \DateTime('now');
        foreach ($rencontres as $key => $r) {
          if (($r->getNomEquipeA() != $v->getLibelle() && $r->getNomEquipeB() != $v->getLibelle()) || ($r->getScoreEquipeA() == 0 && $r->getScoreEquipeB() == 0)) {
            unset($rencontres[$key]);
          }
        }
        $lstrencontres = array_merge($lstrencontres, $rencontres);
      }
    }

    $lstjournees = [];
    //    $key = 1;
    foreach ($lstrencontres as $v) {
      //      print_r($v);
      $rencontre = $api->getDetailsRencontreByLien($v->getLien());
      //      $rencontre->getDatePrevue() < $dateNow->format('Y-m-d')
      //      print_r($rencontre->getParties());
      if ($rencontre->getParties()) {

        if (substr($rencontre->getNomEquipeA(), 0, 10) == 'ST MARCEAU') {
          foreach ($rencontre->getParties() as $r) {
            if ($r->adversaireA != 'Double') {
              $lstjournees[] = [
                'joueur' => $r->adversaireA,
                'date' => $v->getDatePrevue(),
                'journee' => substr($v->getLibelle(), 19, 1),
                'equipe' => substr($rencontre->getNomEquipeA(), strlen($rencontre->getNomEquipeA()) - 1, 1),
                'phase' => 1,
              ];
            }
          }
        }
        elseif (substr($rencontre->getNomEquipeB(), 0, 10) == 'ST MARCEAU') {
          foreach ($rencontre->getParties() as $r) {
            if ($r->adversaireB != 'Double') {
              $lstjournees[] = [
                'joueur' => $r->adversaireB,
                'date' => $v->getDatePrevue(),
                'journee' => substr($v->getLibelle(), 19, 1),
                'equipe' => substr($rencontre->getNomEquipeB(), strlen($rencontre->getNomEquipeB()) - 1, 1),
                'phase' => 1,
              ];
            }
          }
        }
      }
    }

//    print_r($lstjournees);
//    usort($lstjournee, function ($p1, $p2) {
//      print_r($p1);
//      if ($p2['joueur'] > $p1['joueur']) {
//        return 1;
//      }
//      else {
//        if ($p2['joueur'] < $p1['joueur']) {
//          return -1;
//        }
//        else {
//          return strcmp($p1['journee'], $p2['journee']);
//        }
//      }
//    });

//    $keys = array_column($lstjournees, 'joueur');
//    $result = Arr::sortByKeys($lstjournees, 'joueur');
//    print_r($result);

    $lstbrulage = [];
    foreach ($lstjournees as $v) {
      //            if ($v['joueur'] != $lstbrulage=[$key]['joueur']) {
      //                $key++;
      //                $lstbrulage=[$key]['joueur'] = $v['joueur']
      //            }
      $lstbrulage[$v['joueur']] = [
        'nomJoueur' => $v['joueur'],
        'date' => $v['date'],
        'journee' => $v['journee'],
        'equipe' => $v['equipe'],
        'phase' => $v['phase'],
      ];
    }


    //    $this->set(compact('club','teams', 'lstrencontres', 'lstbrulage'));
    return $this->respond($lstbrulage);
  }

}
