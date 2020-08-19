<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Profils;
use Faker\Factory;
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

$tabprofils= ['Admin', 'Formateur', 'Apprenant',];

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

        tabprofilsortie=['Developpeur','CMS','manager','Data'];
    }
}
