<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AddressRepository;
use App\Repository\OfficeRepository;

use App\Entity\Address;
use App\Entity\office;
use Doctrine\ORM\Mapping\Id;

class SelectBureauConrollerController extends AbstractController
{
    #[Route('/select/bureau/conroller/{ville}', name: 'app_select_bureau_conroller')]
    public function index(string $ville, AddressRepository $addressRepository, OfficeRepository $officeRepository)
    {
        //A faire trouver les bureaux d'une ville
        // Dans office on a id address
        // Trouver  toutes les adresses d'une ville
        $adresses = $addressRepository->findBy(['city' => $ville]);
        //Trouver  les id de ses adresses
        $id = $addressRepository->findBy(['id' => $adresses]);
        // Trouver les bureaux correspondant
        $offices  = $officeRepository->findBy(['address' => $id]);
        $data = [];
        foreach ($offices as $office) {
            $data[] = [
                'surface' => $office->getSurface(),
                'name' => $office->getName(),
                'price' => $office->getPrice(),
                'image' => $office->getImage(),
                'pays' => $office->getAddress()->getCountry(),
                'city' => $office->getAddress()->getCity(),
            ];
        }
        return new JsonResponse($data);
    }
}
