<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setTelephoneNumber($faker->phoneNumber);
            $manager->persist($user);
        }

        $this->addReference('user', $user);
        $manager->flush();
    }
}
