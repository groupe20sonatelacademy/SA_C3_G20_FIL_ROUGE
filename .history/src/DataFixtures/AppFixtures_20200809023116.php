<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Niveau;
use App\Entity\Profils;
use App\Entity\Apprenant;
use App\Entity\Competence;
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
        $tabprofilsortie = ['Developpeur Front', 'CMS', 'Integrateur', 'Data', 'Designer', 'Fullback', 'CM'];

        foreach ($tabprofilsortie as $libelle) {
            $profilsortie = new Profilsortie();
            $profilsortie->setLibelle($libelle)
                          ->setArchivage(0);

            $manager->persist($profilsortie);

            //on genere les apprenant

            $apprenant = new Apprenant();

            $hash = $this->encoder->encodePassword($apprenant, "password");

            $apprenant->setAdresse($faker->address)
                ->setCategorie($faker->randomElement(['Faible','Abien','Exellent','Tbien']))
                ->setStatut('Actif')
                ->setInfocomplementaitre($faker->text)
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

//on gere les niveaux
$tabniveau=['niveau1','niveau2','niveau3'];
foreach($tabniveau as $libelle){
$niveau= new Niveau();
$niveau->setLibelle($libelle)
       ->setGroupeDaction($faker->text)
       ->setCritereDevaluation($faker->text)
       ->setArchivage(0);

    $manager->persist($niveau);

}

        //On genere les competences
        $tabcopemtence=[
            'Maquetter une application',
            'Développer une interface web dynamique', 
            'créer une base de données ',
        
        ];
foreach($tabcopemtence as $libelle){
$competence= new Competence();
$competence->setLibelle($libelle)
           ->setDescriptif($faker->text)
           ->addNiveau($niveau)
           ->setArchivage(1);

        $manager->persist($competence);

}
$manager->flush();

    }

}
