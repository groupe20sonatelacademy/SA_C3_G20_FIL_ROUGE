<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Profils;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create('fr_FR');


        for($i=0;$i<3;$i++) {

            $profil = new Profils();

            $profil->setLibelle($faker->unique()->randomElement(['Administrateur', 'CM', 'Formateur']))
                ->setArchivage(1);

            $manager->persist($profil);


                $user = new Users();
                $user->setNom($faker->lastName)
                    ->setPrenom($faker->firstName)
                    ->setGenre($faker->randomElement(['Homme', 'Femmme']))
                    ->setLogin($faker->userName)
                    ->setPwd($faker->password)
                    ->setEmail($faker->email)
                    ->setTelephone($faker->phoneNumber)
                    ->setPhoto("default.png")
                    ->setArchivage(1)
                    ->setProfil($profil);

                $manager->persist($user);

        }
        $manager->flush();
    }
}
