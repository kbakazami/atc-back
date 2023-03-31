<?php

namespace App\Controller;

use App\Entity\Address;
use App\Model\ReservationItem;
use DateTime;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Office;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/reservation')]
class ReservationController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }


    #[Route('/', name: 'app_reservation_index', methods: ['GET'])]
    public function index(): Response
    {
        $reservations = $this->entityManager->getRepository(Reservation::class)->findAll();
        $reservationList = [];

        if($reservations)
        {
            foreach ($reservations as $reservation)
            {
                $reservationItem = new ReservationItem();
                $reservationItem->setId($reservation->getId());
                $reservationItem->setDate($reservation->getDate());
                $reservationItem->setTimeSlot($reservation->getTimeSlot());

                if($reservation->getUser())
                {
                    $userId = $reservation->getUser()->getId();
                    $user = $this->entityManager->getRepository(User::class)->find($userId);

                    $reservationItem->setUserFirstName($user->getFirstName());
                    $reservationItem->setUserLastName($user->getLastName());
                    $reservationItem->setUserEmail($user->getEmail());
                }

                if($reservation->getOffice())
                {
                    $officeId = $reservation->getOffice()->getId();
                    $office = $this->entityManager->getRepository(Office::class)->find($officeId);

                    $ownerId = $office->getOwner()->getId();
                    $owner = $this->entityManager->getRepository(User::class)->find($ownerId);

                    $addressId = $office->getAddress()->getId();
                    $address = $this->entityManager->getRepository(Address::class)->find($addressId);

                    $reservationItem->setOwnerFirstName($owner->getFirstName());
                    $reservationItem->setOwnerLastName($owner->getLastName());
                    $reservationItem->setOwnerEmail($owner->getEmail());
                    $reservationItem->setOfficeName($office->getName());
                    $reservationItem->setOfficePrice($office->getPrice());
                    $reservationItem->setOfficeCountry($address->getCountry());
                    $reservationItem->setOfficeCity($address->getCity());
                    $reservationItem->setOfficeZipCode($address->getZipCode());
                    $reservationItem->setOfficeStreet($address->getStreet());
                }

                $reservationList[$reservation->getId()] = $reservationItem;
            }
        }
        $data = $this->serializer->serialize(array_values($reservationList), JsonEncoder::FORMAT);
        return new Response($data);
    }

    #[Route('/new', name: 'app_reservation_new', methods: ['POST'])]
    public function new(Request $request, ReservationRepository $reservationRepository): Response
    {
        $parameters = json_decode($request->getContent(), true);

        $user = $this->entityManager->getRepository(User::class)->find($parameters['user_id']);
        $office = $this->entityManager->getRepository(Office::class)->find($parameters['office_id']);
        $date = DateTime::createFromFormat("Y-m-d", $parameters['date']);

        $reservation = new Reservation();
        $reservation->setUser($user);
        $reservation->setOffice($office);
        $reservation->setDate($date);
        $reservation->setTimeSlot($parameters['duration']);

        $reservationRepository->save($reservation, true);

        return new Response(status: 200);
    }

    #[Route('/{id}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, ReservationRepository $reservationRepository): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationRepository->save($reservation, true);

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, ReservationRepository $reservationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $reservationRepository->remove($reservation, true);
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
