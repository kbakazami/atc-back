<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ReservationFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i = 0; $i < 10; $i++) {
            $reservation = new Reservation();
            $reservation->setOffice($faker->randomElement([$this->getReference('office')]));
            $reservation->setUser($faker->randomElement([$this->getReference('user')]));
            $reservation->setTimeSlot($faker->randomElement(['matin', 'après-midi', 'journée']));
            $reservation->setDate($faker->dateTime);
            $manager->persist($reservation);
        }

        $this->addReference('reservation', $reservation);
        $manager->flush();    }
    public function getDependencies(): array
    {
        return [
            OfficeFixture::class,
            UserFixture::class,
        ];
    }
}