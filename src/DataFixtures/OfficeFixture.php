<?php

namespace App\DataFixtures;

use App\Entity\Office;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class OfficeFixture extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i = 0; $i < 10; $i++) {
            $office = new Office();
            $office->setAddress($faker->randomElement([$this->getReference('address')]));
            $office->setPrice($faker->randomNumber(3));
            $office->setSurface($faker->randomNumber(2));
            $office->setDuration($faker->randomElement(['matin', 'midi', 'journée']));
            $office->setImage($faker->imageUrl(640, 480, 'office'));
            $office->setUser($faker->randomElement([$this->getReference('user')]));
            $office->setName($faker->name());
            $office->setDescription($faker->text());
            $manager->persist($office);
        }

        $this->addReference('office', $office);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AddressFixture::class,
            UserFixture::class,
        ];
    }
}
