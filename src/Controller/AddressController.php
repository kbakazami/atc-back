<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use App\Repository\AddressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\SerializerInterface;

#[Route('/address')]
class AddressController extends AbstractController
{

    #[Route('/', name: 'app_address_index', methods: ['GET'])]
    public function index(AddressRepository $addressRepository, SerializerInterface $serializer): JsonResponse
    {
        $addressList = $addressRepository->findAll();
        $jsonAddressList = $serializer->serialize($addressList, 'json', []);
        return new JsonResponse($jsonAddressList, Response::HTTP_OK, [], true);
    }

    #[Route('/new', name: 'app_address_new', methods: ['POST'])]
    public function new(Request $request, AddressRepository $addressRepository): Response
    {
        $parameters = json_decode($request->getContent(), true);

        $address = new Address();
        $address->setCountry($parameters['country']);
        $address->setCity($parameters['city']);
        $address->setZipCode($parameters['zipCode']);
        $address->setStreet($parameters['street']);

        $addressRepository->save($address, true);

        return new Response(status: 200);
    }

    #[Route('/{id}', name: 'app_address_show', methods: ['GET'])]
    public function show(Address $address, SerializerInterface $serializer): JsonResponse
    {
        $jsonAddress = $serializer->serialize($address, 'json', []);
        return new JsonResponse($jsonAddress, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}/edit', name: 'app_address_edit', methods: ['POST'])]
    public function edit(Request $request, Address $address, AddressRepository $addressRepository): Response
    {
        $parameters = json_decode($request->getContent(), true);

        $address->setCountry($parameters['country']);
        $address->setCity($parameters['city']);
        $address->setZipCode($parameters['zipCode']);
        $address->setStreet($parameters['street']);

        $addressRepository->save($address, true);

        return new Response(status: 200);
    }

    #[Route('/{id}', name: 'app_address_delete', methods: ['DELETE'])]
    public function delete(Request $request, Address $address, AddressRepository $addressRepository): Response
    {
//        if ($this->isCsrfTokenValid('delete' . $address->getId(), $request->request->get('_token'))) {}
        $addressRepository->remove($address, true);

        return new Response(status: 200);
    }
}
