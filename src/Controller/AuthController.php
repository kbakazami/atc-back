<?php

namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AuthController extends AbstractController
{

    /**
     * @Route("/api/login_check", name="login_check")
     */
    public function loginCheck(Request $request, UserPasswordEncoderInterface $encoder, JWTTokenManagerInterface $JWTManager)
    {
        // Récupérer les informations d'identification de la requête
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        // Récupérer l'utilisateur à partir du nom d'utilisateur
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => $username]);

        // Vérifier que l'utilisateur existe et que le mot de passe est correct
        if (!$user || !$encoder->isPasswordValid($user, $password)) {
            return new JsonResponse(['error' => 'Invalid username or password'], 401);
        }

        // Générer un token JWT pour l'utilisateur
        $token = $JWTManager->create($user);

        return new JsonResponse(['token' => $token]);
    }

    #[Route('/current_user', name: 'api_current_user')]
    public function getCurrentUser(Request $request, TokenStorageInterface $tokenStorage, JWTTokenManagerInterface $JWTManager): JsonResponse
    {
        // Récupérer le token JWT de l'utilisateur courant
        $token = $tokenStorage->getToken();

        // Vérifier que l'utilisateur est authentifié et a un token JWT valide
        if (!$token || !$JWTManager->validate($token)) {
            return new JsonResponse(['error' => 'User not authenticated'], 401);
        }

        // Récupérer les informations de l'utilisateur à partir du token JWT
        $user = $JWTManager->decode($token);

        return new JsonResponse([
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
        ]);
    }

}