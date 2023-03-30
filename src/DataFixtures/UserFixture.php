<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword($this->hasher->hashPassword($user, $faker->password));
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setAddress($faker->randomElement([$this->getReference('address')]));
            $user->setTelephoneNumber($faker->phoneNumber);
            $user->setDescription($faker->text());
            $manager->persist($user);
        }

        $this->addReference('user', $user);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AddressFixture::class,
        ];
    }
}
