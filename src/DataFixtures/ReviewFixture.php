<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ReviewFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i = 0; $i < 10; $i++) {
            $review = new Review();
            $review->setOfficeid($faker->randomElement([$this->getReference('office')]));
            $review->setUserid($faker->randomElement([$this->getReference('user')]));
            $review->setTitle($faker->sentence(4));
            $review->setNote($faker->randomElement(['1', '2', '3', '4', '5']));
            $review->setMessage($faker->text(255));
            $manager->persist($review);
        }

        $this->addReference('review', $review);
        $manager->flush();    }
    public function getDependencies(): array
    {
        return [
            OfficeFixture::class,
            UserFixture::class,
        ];
    }
}