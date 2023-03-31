<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OfficeRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class FiltrePriceController extends AbstractController
{
    #[Route('/filtre/price/{price}', name: 'app_filtre_price')]
    public function index(int $price, OfficeRepository $officeRepository)
    {
        $offices = $officeRepository->findByPrice($price);

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
