<?php

namespace App\DataFixtures;

use App\Entity\Apprenant;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Profils;
use App\Entity\Profilsortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     * L'encodeur de mot de pass
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create('fr_FR');

$tabprofils= ['Admin', 'Formateur', 'Apprenant'];

        foreach($tabprofils as $libelle) {

            $profil = new Profils();

            $profil->setLibelle($libelle)
                ->setArchivage(0);

            $manager->persist($profil);


                $user = new User();

                $hash = $this->encoder->encodePassword($user,"password");

                $user->setNom($faker->lastName)
                    ->setPrenom($faker->firstName)
                    ->setGenre($faker->randomElement(['Homme', 'Femme']))
                    ->setUsername($faker->userName)
                    ->setPassword($hash)
                    ->setEmail($faker->email)
                    ->setTelephone($faker->phoneNumber)
                    ->setPhoto("default.png")
                    ->setArchivage(0)
                    ->setProfil($profil);

                $manager->persist($user);

        }
        $manager->flush();


        //on genere les profils de sortie
        $tabprofilsortie = ['Developpeur Front', 'CMS', 'manager', 'Data', 'Designer', 'Fullback', 'CM'];

        foreach ($tabprofilsortie as $libelle) {
            $profilsortie = new Profilsortie();

            $manager->persist($profilsortie);
            //on genere les apprenant


            $apprenant = new Apprenant();

            $hash = $this->encoder->encodePassword($apprenant, "password");

            $apprenant->setAdresse($faker->adress)
                ->setCategorie($faker->randomElement(['Faible','Abien','Exellent','Tbien']))
                ->setStatut('Actif')
                
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setGenre($faker->randomElement(['Homme', 'Femme']))
                ->setUsername($faker->userName)
                ->setPassword($hash)
                ->setEmail($faker->email)
                ->setTelephone($faker->phoneNumber)
                ->setPhoto("default.png")
                ->setArchivage(0)
                ->setProfilsortie($profilsortie)
                ->setProfil($profil);

            $manager->persist($apprenant);

        }
        $manager->flush();
    }
}
