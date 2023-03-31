<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Office;
use App\Entity\Review;
use App\Entity\User;
use App\Form\OfficeType;
use App\Model\OfficeDetailItem;
use App\Model\OfficeItem;
use App\Model\ReviewByOfficeItem;
use App\Repository\OfficeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/offices')]
class OfficeController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    #[Route('/', name: 'app_office_index', methods: ['GET'])]
    public function index(): Response
    {
        $offices = $this->entityManager->getRepository(Office::class)->findAll();
        $officeList = [];

        if($offices)
        {
            foreach ($offices as $office)
            {
                $officeItem = new OfficeItem();
                $officeItem->setId($office->getId());
                $officeItem->setPrice($office->getPrice());
                $officeItem->setImages($office->getImage());

                if($office->getAddress())
                {
                    $addressId = $office->getAddress()->getId();
                    $address = $this->entityManager->getRepository(Address::class)->find($addressId);

                    $officeItem->setCity($address->getCity());
                    $officeItem->setCountry($address->getCountry());
                } else {
                    $address = null;
                }

                if($office->getReview())
                {
                    $reviewsAverage = $this->entityManager->getRepository(Review::class)->findAllByOfficeIdAverageNote($office->getId());
                    if($reviewsAverage)
                    {
                        $officeItem->setReviewAverage(round($reviewsAverage[0][1],2));
                    }

                } else {
                    $reviewsAverage = null;
                }

                $officeList[$office->getId()] = $officeItem;
            }
        }
        $data = $this->serializer->serialize(array_values($officeList), JsonEncoder::FORMAT);
        return new Response($data);
    }

    #[Route('/new', name: 'app_office_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OfficeRepository $officeRepository): Response
    {
        $office = new Office();
        $form = $this->createForm(OfficeType::class, $office);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $officeRepository->save($office, true);

            return $this->redirectToRoute('app_office_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('office/new.html.twig', [
            'office' => $office,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_office_show', methods: ['GET'])]
    public function show($id): Response
    {
        $office = $this->entityManager->getRepository(Office::class)->find($id);

        $reviewList = [];

        $officeDetaiItem = new OfficeDetailItem();
        $officeDetaiItem->setId($office->getId());
        $officeDetaiItem->setPrice($office->getPrice());
        $officeDetaiItem->setSurface($office->getSurface());
        $officeDetaiItem->setImages($office->getImage());
        $officeDetaiItem->setDescription($office->getDescription());
        $officeDetaiItem->setName($office->getName());
        $officeDetaiItem->setIsFiber($office->isIsFiber());
        $officeDetaiItem->setIsComputer($office->isIsComputer());
        $officeDetaiItem->setIsScreen($office->isIsScreen());
        $officeDetaiItem->setIsMouseKeyboard($office->isIsMouseKeyboard());
        $officeDetaiItem->setIsKitchen($office->isIsKitchen());

        if($office->getAddress())
        {
            $addressId = $office->getAddress()->getId();
            $address = $this->entityManager->getRepository(Address::class)->find($addressId);

            $officeDetaiItem->setAddressId($address->getId());
            $officeDetaiItem->setCountry($address->getCountry());
            $officeDetaiItem->setCity($address->getCity());
            $officeDetaiItem->setZipCode($address->getZipCode());
            $officeDetaiItem->setStreet($address->getStreet());
        }else {
            $address = null;
        }

        if($office->getReview())
        {
            $reviewsAverage = $this->entityManager->getRepository(Review::class)->findAllByOfficeIdAverageNote($office->getId());
            $reviews = $this->entityManager->getRepository(Review::class)->findAllByOfficeId($office->getId());
            if($reviewsAverage)
            {
                $officeDetaiItem->setReviewAverage(round($reviewsAverage[0][1],2));
            }else {
                $reviewsAverage = null;
            }

            if($reviews)
            {
                foreach ($reviews as $review) {
                    $reviewItem = new ReviewByOfficeItem();
                    $reviewItem->setId($review->getId());
                    $reviewItem->setTitle($review->getTitle());
                    $reviewItem->setMessage($review->getMessage());
                    $reviewItem->setNote($review->getNote());
                    if ($review->getUser())
                    {
                        $userId = $review->getUser()->getId();
                        $user = $this->entityManager->getRepository(User::class)->find($userId);
                        $reviewItem->setUserFirstName($user->getFirstName());
                        $reviewItem->setUserLastName($user->getLastName());
                        $reviewList[] = $reviewItem;
                    } else {
                        $review = null;
                    }
                }
            } else {
                $reviews = null;
            }
            $officeDetaiItem->setReviews($reviewList);
        }

        if ($office->getOwner())
        {
            $ownerId = $office->getOwner()->getId();
            $owner = $this->entityManager->getRepository(User::class)->find($ownerId);

            $officeDetaiItem->setOwnerFirstName($owner->getFirstName());
            $officeDetaiItem->setOwnerLastName($owner->getLastName());
        }else {
            $owner = null;
        }

        $data = $this->serializer->serialize($officeDetaiItem, JsonEncoder::FORMAT);
        return new Response($data);
    }

    #[Route('/{id}/edit', name: 'app_office_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Office $office, OfficeRepository $officeRepository): Response
    {
        $form = $this->createForm(OfficeType::class, $office);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $officeRepository->save($office, true);

            return $this->redirectToRoute('app_office_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('office/edit.html.twig', [
            'office' => $office,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_office_delete', methods: ['POST'])]
    public function delete(Request $request, Office $office, OfficeRepository $officeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$office->getId(), $request->request->get('_token'))) {
            $officeRepository->remove($office, true);
        }

        return $this->redirectToRoute('app_office_index', [], Response::HTTP_SEE_OTHER);
    }
}
