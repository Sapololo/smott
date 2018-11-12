<?php

namespace App\Controller;

use App\Dto\ForgottenPasswordResponseDto;
use App\Dto\UserDto;
use App\Dto\PasswordDto;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\MailerService;
use App\Exceptions\ForgottenPasswordException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWSProvider\JWSProviderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UserController extends ApiController {

  /** @var ObjectManager */
  private $em;

  /** @var TokenStorageInterface */
  private $tokenStorage;

  protected $security;

  /** @var MailerService */
  private $mailerService;

  /** @var JWTTokenManagerInterface */
  private $jwtManager;

  /** @var JWSProviderInterface */
  private $jwsProvider;

  /** @var JWTTokenManagerInterface */
  private $jwttokenmanagerinterface;

  /**
   * UserController constructor.
   *
   * @param ObjectManager $em
   * @param TokenStorageInterface $tokenStorage
   * @param Security $security
   * @param MailerService $mailerService
   * @param JWTTokenManagerInterface $jwtManager
   * @param JWSProviderInterface $jwsProvider
   *
   * @throws \Doctrine\Common\Annotations\AnnotationException
   */
  public function __construct(ObjectManager $em,TokenStorageInterface $tokenStorage, Security $security, MailerService $mailerService, JWTTokenManagerInterface $jwtManager, JWSProviderInterface $jwsProvider
  ) {
    $this->em = $em;
    $this->tokenStorage = $tokenStorage;
    $this->user = $tokenStorage->getToken()->getUser();
    $this->security = $security;
    $this->mailerService = $mailerService;
    $this->jwtManager = $jwtManager;
    $this->jwsProvider = $jwsProvider;
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/user/profile")
   */
  public function profil(UserRepository $userRepository) {
    $token = $this->tokenStorage->getToken();
    if ($token === NULL) {
      throw new AuthenticationCredentialsNotFoundException();
    }

    if (!$this->security->isGranted('ROLE_USER')) {
      throw new AccessDeniedException();
    }

    //    $profile = $profileRepository->find($userId);
    return $this->respond($this->user);
  }

  //  /**
  //   * Change le mot de passe d'un utilisateur.
  //   *
  //   *
  //   * @View()
  //   * @Post("/users/{username}/change-password")
  //   * @Route("/api/user/modifier-password")
  //   * @Method("POST")
  //   *
  //   * @ParamConverter("data", converter="fos_rest.request_body")
  //   *
  //   * @param Request $request
  //   * @param string $username
  //   * @param UserPassword $data
  //   * @return UserModel
  //   */
  //  public function changeUserPassword(Request $request, string $username, UserPassword $data)
  //  {
  //    /**
  //     * @var UserInterface $currentUser
  //     */
  //    $currentUser = $this->getUser();
  //    /** @var User $user */
  //    $user = $this->userManager->findUserByUsername($username);
  //    $user->setPlainPassword($data->getPassword());
  //
  //    $this->userManager->updatePassword($user);
  //    $this->userManager->updateUser($user);
  //
  //    return new UserModel($user);
  //
  //  }

  /**
   * Change le mot de passe d'un utilisateur.
   *
   * @Rest\View()
   * @Rest\Post("/api/user/modifier-password")
   *
   */
//    public function modifierUserPassword(Request $request, string $username, User $data, UserManagerInterface $userManagerInterface) {
  public function modifierUserPassword($password, $oldPassword, UserPasswordEncoderInterface $encoder) {
    /** @var UserInterface $user */
    $user = $this->user;

    $passwordValid = $encoder->isPasswordValid($user, $oldPassword);
    if ($passwordValid) {
      $user->setPassword($encoder->encodePassword($user, $password));
      $this->em->persist($user);
      $this->em->flush();
    }
    else {
      //      return $this->errorResponse('Mismatch current password', $passwordValid );
      return $this->respond($user);
    }
    //    return $this->successResponse('Successfully changed password', $passwordValid );
    return $this->respond($user);
  }

  /**
   * Change le mot de passe de l'utilisateur connecté.
   *
   * @Rest\View()
   * @Rest\Put("/api/user/password")
   *
   * @ParamConverter("data", converter="fos_rest.request_body")
//   * @IsGranted("ROLE_CHANGE_PASSWORD")
   *
   * @param UserInterface $user
   * @param PasswordDto $data
   */
  public function setPassword(UserInterface $user, PasswordDto $data, UserManagerInterface $userManagerInterface, UserPasswordEncoderInterface $encoder)
  {
    $token = $this->tokenStorage->getToken();
    if ($token === NULL) {
      throw new AuthenticationCredentialsNotFoundException();
    }

    /** @var UserInterface $user */
    $user = $this->user;
    $user->setPassword($encoder->encodePassword($user, $data->getPassword()));
    $this->em->persist($user);
    $this->em->flush();

    return $this->respond($user);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/user/reset-password/{email}")
   * @throws ForgottenPasswordException
   */
  public function resetPassword(UserManagerInterface $userManagerInterface, $email, \Swift_Mailer $mailer) {
    /** @var User $user */
    try {
      $user = $userManagerInterface->findUserByEmail($email);
    } catch (UsernameNotFoundException $e) {
      throw new ForgottenPasswordException('Veuillez vérifier la saisie de votre email !');
    }

    if (!$user) {
      throw new \InvalidArgumentException("Email $email non référencé !");
    }
    elseif (!$user->isEnabled()) {
      throw new \InvalidArgumentException("Votre compte $email est désactivé !");
    }
    else {
      $token = $this->jwtManager->create($user);

//      $user->setRoles(['ROLE_CHANGE_PASSWORD']);
      $this->em->persist($user);
      $this->em->flush();
      $result = $this->mailerService->sendReinitialisationMotDePasseMail($token, $user->getEmail());
      $response = new ForgottenPasswordResponseDto($user->getUsername(), $email);

      print_r($response);
      preg_match("/(^.)(.*)(@.*$)/", $response->getEmail(), $matches);
      $maskedEmail = $matches[1] . preg_replace("/[^\\.]/", "*", $matches[2]) . $matches[3];
      $response->setEmail($maskedEmail);
      return $this->respond($response);
    }
  }

  /**
   * Mise à jour d'un utilisateur.
   *
   * @Rest\View()
   * @Rest\Put("/api/user")
   *
   * @ParamConverter("data", converter="fos_rest.request_body")
   *
   * @param UserInterface $user
   * @param UserDto $data
   *
   */
  public function editerUser(UserInterface $user, UserDto $data, UserManagerInterface $userManagerInterface) {

    try {
      $user = $userManagerInterface->findUserBy(['id' => $data->getId()]);
//      print_r($data);
//      print_r(strtoupper($data['lastName']));
//      die('stop');
      $user->setUsername($data->getUsername());
//      $user->setLastname(strtoupper($data['lastName']));
//      $user->setFirstname(strtoupper($data['firstName']));
//      $user->setLicenceId(strtoupper($data['licenceId']));
      $user->setEmail($data->getEmail());
//      $user->setRoles($data['roles']);
//      $user->setAdresse($data['adresse']);
//      $user->setCodePostal($data['codePostal']);
//      $user->setPortable($data['portable']);
//      $user->setTelephone($data['telephone']);
      ////    $user->setPassword($encoder->encodePassword($user, $password));
      //    print_r($user);
      $this->em->persist($user);
      $this->em->flush();
    } catch (UsernameNotFoundException $e) {
      throw new ForgottenPasswordException('Veuillez vérifier la saisie de votre identifiant !');
    }

    return $this->respond($user);
  }

//  /**
//   * Mise à jour du token.
//   *
//   * @Route("/api/token/refresh")
//   * @Method("POST")
//   * @param Request $request
//   *
//   * @return JsonResponse
//   */
//  public function refreshTokenAction(Request $request, JWTTokenManagerInterface $refreshTokenManager)
//  {
//    $refreshToken = $request->request->get('refresh_token', null);
//    $token = $request->request->get('token', null);
//
////    if (null === $refreshToken) {
////      throw new BadRequestHttpException('You must provide the token and the refresh_token parameters.'.$refreshToken.'a');
////    }
////    $refreshTokenManager = $this->get('app.services.jwt_refresh_manager');
//    try {
//      $refreshTokenManager->verify($token, $refreshToken);
//    } catch (\InvalidArgumentException $e) {
//      throw new AccessDeniedHttpException('The refresh token is invalid and has been revoked.', $e);
//    } finally {
//      $refreshTokenManager->delete($token);
//    }
////    $authToken = new JWTUserToken();
////    $authToken->setRawToken($refreshToken);
////    $authToken = $this->get('security.authentication.manager')->authenticate($authToken);
////    $request->attributes->set('refresh_token_key', 'refreshed');
////    return $this->get('lexik_jwt_authentication.handler.authentication_success')->onAuthenticationSuccess($request, $authToken);
////    return $this->get('lexik_jwt_authentication.handler.authentication_success')->onAuthenticationSuccess($request, $authToken);
//    return "token:".$token.' refreshToken:'.$refreshToken;
//  }

  /**
   * Liste les utilisateurs existants.
   *
   * @Rest\View()
   * @Rest\Get("/api/users")

   *
   * @return UserModel[]
   */
  public function listUsers(UserRepository $userRepository)
  {
    $users = $userRepository->transformAll();
    return $this->respond($users);
  }

  /**
   * Liste les utilisateurs existants avec les données adhérents.
   *
   * @Rest\View()
   * @Rest\Get("/api/usersDetail")

   *
   * @return UserModel[]
   */
  public function listUsersDetail(UserRepository $userRepository)
  {
    $users = $userRepository->transformAllDetail();
    return $this->respond($users);
  }

  /**
   * Liste des utilisateurs existants avec critéres.
   *
   * @Rest\View()
   * @Rest\Get("/api/usersBy/{type}")

   *
   * @return UserModel[]
   */
  public function listUsersBy(UserRepository $userRepository, $type)
  {
    switch ($type) {
      case 1:
        $users = $userRepository->transformAll();
        break;
      case 2:
        $users = $userRepository->findByTjl();
        break;
      case 3:
        $users = $userRepository->findByStage();
        break;
      case 4:
        $users = $userRepository->findByAutres(['genre' => 0]);
        break;
      case 5:
        $users = $userRepository->findByAutres(['genre' => 1]);
        break;
      case 6:
        $users = $userRepository->findByPromo();
        break;
      case 7:
        $users = $userRepository->findByTradi();
        break;
    }
    return $this->respond($users);
  }
}
