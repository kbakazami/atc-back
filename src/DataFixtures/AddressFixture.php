<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AddressFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i = 0; $i < 10; $i++) {
            $address = new Address();
            $address->setStreet($faker->streetName);
            $address->setCity($faker->city);
            $address->setZipcode($faker->postcode);
            $address->setCountry("France");
            $manager->persist($address);
        }

        $this->addReference('address', $address);
        $manager->flush();
    }
}
