<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\OfficeRepository;
use Doctrine\DBAL\Types\DecimalType;
use Symfony\Component\HttpFoundation\JsonResponse;

class FiltreParSurfaceController extends AbstractController
{
    #[Route('/filtre/par/surface/{surface}', name: 'app_filtre_par_surface')]
    public function index(float $surface, OfficeRepository $officeRepository)
    {
        $offices = $officeRepository->findBySurface($surface);
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
