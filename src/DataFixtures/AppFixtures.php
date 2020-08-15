<?php

namespace App\DataFixtures;

use App\Entity\Apprenants;
use App\Entity\Competences;
use App\Entity\Formateur;
use App\Entity\GroupeCompetences;
use App\Entity\Niveau;
use App\Entity\Referentiel;
use App\Entity\Tags;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Profils;
use App\Entity\ProfilsDeSortie;
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

        //On instancie Faker qui gère les fausses données
        $faker = Factory::create('fr_FR');

        $profils = ['Administrateur', 'CM', 'Formateur', 'Apprenant'];

        foreach ($profils as $libelle) {

            $profil = new Profils();
            $profil->setLibelle($libelle)
                ->setArchivage(0);
            $manager->persist($profil);
            //$manager->flush();

            //Si le libelle est un apprenant
            if ($libelle === "Apprenant") {


                //On initialise les ProfilsDeSortie
                $tabProfilsDeSortie = ["Développeur front", "Développeur back", "Développeur fullstack", "CMS", "Intégrateur", "Designer", "CM", "DataArtisant"];

                foreach ($tabProfilsDeSortie as $libelle) {

                    $profilsDeSortie = new ProfilsDeSortie();
                    $profilsDeSortie->setLibelle($libelle)
                        ->setArchivage(0);
                    $manager->persist($profilsDeSortie);

                    for ($i = 0; $i < 3; $i++) {

                        //On génère les apprenants
                        $apprenant = new Apprenants();

                        $hash = $this->encoder->encodePassword($apprenant, "password");

                        $apprenant->setAdresse($faker->address)
                            ->setStatut("actif")
                            ->setInfoComplementaire($faker->text)
                            ->setCategorie($faker->randomElement(['Faible', 'Bien', 'A Bien', 'Excellent']))
                            ->setProfilDeSortie($profilsDeSortie)
                            ->setNom($faker->lastName)
                            ->setPrenom($faker->firstName)
                            ->setGenre($faker->randomElement(['Homme', 'Femmme']))
                            ->setUsername($faker->userName)
                            ->setPassword($hash)
                            ->setEmail($faker->email)
                            ->setTelephone($faker->phoneNumber)
                            ->setPhoto("default.png")
                            ->setProfil($profil)
                            ->setArchivage(0);


                        $manager->persist($apprenant);
                    }
                }

            } elseif ($libelle === "Formateur"){

                //On génère les formateurs

                for ($i = 0; $i < 3; $i++) {

                $formateur = new Formateur();

                $hash = $this->encoder->encodePassword($formateur,"password");

                    $formateur->setNom($faker->lastName)
                        ->setPrenom($faker->firstName)
                        ->setGenre($faker->randomElement(['Homme', 'Femmme']))
                        ->setUsername($faker->userName)
                        ->setPassword($hash)
                        ->setEmail($faker->email)
                        ->setTelephone($faker->phoneNumber)
                        ->setPhoto("default.png")
                        ->setProfil($profil)
                        ->setArchivage(0);

                    $manager->persist($formateur);
                }
            } else {
                for ($i = 0; $i < 3; $i++) {

                    $user = new User();

                    $hash = $this->encoder->encodePassword($user, "password");

                    $user->setNom($faker->lastName)
                        ->setPrenom($faker->firstName)
                        ->setGenre($faker->randomElement(['Homme', 'Femmme']))
                        ->setUsername($faker->userName)
                        ->setPassword($hash)
                        ->setEmail($faker->email)
                        ->setTelephone($faker->phoneNumber)
                        ->setPhoto("default.png")
                        ->setProfil($profil)
                        ->setArchivage(0);

                    $manager->persist($user);
                }
            }

        }


        ///On ajouter les fixtures des competences
        $competenceTable = ["Créer une base de données","Développer les composants d'accès d'une base de donnée",
        "Développer les composants d'ApiPlatform"];

        //On ajoute les référentiels
        $referentiel = new Referentiel();

        $referentiel->setLibelle("Référentiel 1")
                    ->setPresentation("$faker->text")
                    ->setProgramme($faker->text)
                    ->setCritereEvaluation($faker->text)
                    ->setCompetencesVisees($faker->text)
                    ->setCritereAdmission($faker->text);

        $groupeCompetence = new GroupeCompetences();

        foreach ($competenceTable as $competenceLibelle){

            $competence = new Competences();
            $competence->setLibelle($competenceLibelle)
                    ->setDescriptif("Pas d'informations")
                    ->setArchivage(false);


            //On ajoute les niveaux en fonctions des compétences
            for($i=1;$i<=3;$i++){
                $niveau = new Niveau();
                $niveau->setLibelle('Niveau '.$i)
                        ->setGroupeActions("Pas d'actions")
                        ->setCritereEvaluation("Pas de critères")
                        ->setArchivage(false);
                $manager->persist($niveau);
                $competence->addNiveau($niveau);
            }

            $manager->persist($competence);

            $referentiel->addCompetence($competence);

            $manager->persist($referentiel);

            //On génère un groupe de compétence
            $groupeCompetence->setLibelle("Développement web")
                            ->setDescriptif("Pas d'infos")
                            ->addCompetence($competence)
                            ->setArchivage(false);
            $manager->persist($groupeCompetence);

        }

        //On ajoute les fixtures de tags
        $tagTable = ['PHP', 'JS', 'HTML5', 'SQL', 'CSS3', 'JQUERY', 'SYMFONY', 'ApiPlatform'];

        foreach ($tagTable as $tagLibelle) {
            $tag = new Tags();
            $tag->setLibelle($tagLibelle)
                ->setDescriptif("Pas d'informations")
                ->setArchivage(false);

            $manager->persist($tag);
            //On ajoute les tags dans notre objet GroupeCompetence
            $groupeCompetence->addTag($tag);
            $manager->persist($groupeCompetence);
        }




        $manager->flush();


    }
}
