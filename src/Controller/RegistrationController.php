<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class RegistrationController extends AbstractController
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    #[Route('/register', name: 'app_register', methods: ['POST'])]
    public function register(Request $request, EntityManagerInterface $manager): \Symfony\Component\HttpFoundation\JsonResponse
    {

        var_dump($request->request->get('first_name'));
        $user = new User();
//        $user->setFirstname($request->request->get('first_name'));
//        $user->setLastname($request->request->get('last_name'));
//        $user->setEmail($request->request->get('email'));
//        $user->setTelephoneNumber($request->request->get('telephone_number'));
//        $user->setPassword($this->hasher->hashPassword($user, $request->request->get('password')));
//        $user->setRoles(['ROLE_USER']);
//        $manager->persist($user);
//        $manager->flush();
//
        return $this->json($user);
    }
}
