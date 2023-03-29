<?php

namespace App\DataFixtures;

use App\Entity\Invoice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class InvoiceFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i = 0; $i < 10; $i++) {
            $invoice = new Invoice();
            $invoice->setOffice($faker->randomElement([$this->getReference('office')]));
            $invoice->setUser($faker->randomElement([$this->getReference('user')]));
            $manager->persist($invoice);
        }

        $this->addReference('invoice', $invoice);
        $manager->flush();    }
    public function getDependencies(): array
    {
        return [
            OfficeFixture::class,
            UserFixture::class,
        ];
    }
}