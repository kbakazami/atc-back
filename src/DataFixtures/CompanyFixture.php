<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CompanyFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $company = new Company();
        $company->setAddress($faker->randomElement([$this->getReference('address')]));
        $company->setName('Around The Corner');
        $company->setLogo($faker->imageUrl(640, 480, 'company'));
        $company->setEmail('contact@atc.fr');
        $company->setPhoneNumber($faker->phoneNumber());
        $company->setSiret($faker->randomNumber(9));
        $manager->persist($company);

        $this->addReference('company', $company);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AddressFixture::class,
        ];
    }
}