<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    #[Route('/current_user', name: 'current_user',)]
    public function currentUser(Request $request, JWTEncoderInterface $jwtEncoder, UserRepository $userRepository): JsonResponse
    {
        $token = $request->headers->get('Authorization');
        $token = substr($token, 7);

        if($token) {
            try {
                $data = $jwtEncoder->decode($token);
                $user = $userRepository->findOneBy(['id' => $data['id']]);
                return $this->json($user);
            } catch (\Exception $e) {
                return $this->json(null);
            }
        }else{
            return $this->json(null);
        }

    }
}