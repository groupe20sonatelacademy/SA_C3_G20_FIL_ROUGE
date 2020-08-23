<?php

namespace App\DataFixtures;

use App\Entity\CM;
use Faker\Factory;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Brief;
use App\Entity\Groupe;
use App\Entity\Niveau;
use App\Entity\Profils;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use App\Entity\GroupeTag;
use App\Entity\Competence;
use App\Entity\Referentiel;
use App\Entity\Profilsortie;
use App\Entity\GroupeCompetence;
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



        $profils = ['Admin', 'Formateur', 'Apprenant', 'CM'];
        $profilsortie = ['Developpeur Front', 'CMS', 'Integrateur', 'Data', 'Designer', 'Fullback', 'CM'];
        $tabEntity=[];
      //profilsortie
       foreach($profilsortie as $libelle){
            $profilsortie = new Profilsortie();
            $profilsortie->setLibelle($libelle)
                         ->setArchivage(0);
            $tabEntity[]= $profilsortie;
            $manager->persist($profilsortie);

         }
        //profils

        foreach($profils as $libelle) {

            $profil = new Profils();

            $profil->setLibelle($libelle)
                ->setArchivage(0);
            $manager->persist($profil);


            for ($i = 0; $i < 4; $i++) {


                //on genere apprenant
                $user = new User();

                if($libelle == "Apprenant"){

             $user= new Apprenant();
             $user->setAdresse($faker->address)
                    ->setCategorie($faker->randomElement(['Faible', 'Abien', 'Exellent', 'Tbien']))
                    ->setStatut('Actif')
                    ->setInfocomplementaitre($faker->text)
                    ->setProfilsortie($faker->randomElement($tabEntity));

                }
                // formateur
                if($libelle == "Formateur"){
                    $user= new Formateur();

                }
                 //CM
                if ($libelle == "CM") {
                    $user = new CM();
                }

               //user=admin
                $hash = $this->encoder->encodePassword($user, "password");

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
     }





        ///On ajouter les fixtures des competences
        $competenceTable = [
            "Créer une base de données", "Développer les composants d'accès d'une base de donnée",
            "Développer les composants d'ApiPlatform"
        ];

        //On ajoute les référentiels
        
        $referentiel = new Referentiel();

        $referentiel->setLibelle("nous somme des referentiels")
        ->setPresentation("$faker->text")
        ->setProgramme($faker->text)
        ->setCritereEvaluation($faker->text)
        ->setCritereAdmission($faker->text)
        ->setArchivage(0);
 
        $groupeCompetence = new GroupeCompetence();

        foreach ($competenceTable as $competenceLibelle) {
 
            $competence = new Competence();
            $competence->setLibelle($competenceLibelle)
            ->setDescriptif($faker->text)
            ->setArchivage(0);


            //On ajoute les niveaux en fonctions des compétences
            for ($i = 1; $i <= 3; $i++) {
                $niveau = new Niveau();
                $niveau->setLibelle('Niveau '. $i)
                ->setGroupeDaction($faker->text)
                ->setCritereDevaluation($faker->text)
                    ->setArchivage(0);
                $manager->persist($niveau);
                $competence->addNiveau($niveau);
            }

            $manager->persist($competence);
            $referentiel->addGroupeCompetence($groupeCompetence);
           

            $manager->persist($referentiel);

            $tabgroupecompetence = [
                'Créer une base de données ',
                'Developper une application durable',
                'Développer les composants d’accès aux données'
            ];
            foreach ($tabgroupecompetence as $libelle) {
            //On génère un groupe de compétence
            $groupeCompetence->setLibelle($libelle)
                ->setDescriptif($faker->text)
                ->addCompetence($competence)
                ->setArchivage(0);
            $manager->persist($groupeCompetence);
            }
            
        }

        //On ajoute les fixtures de tags
        $tagTable = ['PHP', 'JS', 'HTML5', 'SQL', 'CSS3', 'JQUERY', 'SYMFONY', 'ApiPlatform'
        ];

        foreach ($tagTable as $tagLibelle) {
            $tag = new Tag();
            $tag->setLibelle($tagLibelle)
                ->setDescriptif($faker->text)
                ->setArchivage(0);

            $manager->persist($tag);
            //On ajoute les tags dans notre objet GroupeCompetence
            $groupeCompetence->addTag($tag);
            $manager->persist($groupeCompetence);
        }
        $grouptag = ["Developpement web", "Systeme et reseau", "objet connecté"];

        foreach ($grouptag as $libelle) {
            $groupetag = new GroupeTag();
            $groupetag->setLibelle($libelle)
            ->addTag($tag)
            ->setArchivage(0);
            $manager->persist($groupetag);
        }


        $brief = new Brief();
        $brief->setLangue($faker->randomElement(['francais','anglais','chinois','arabe']))
               ->setTitre('je deteste les beugs')
               ->s
               ->setArchivage(0);





        $manager->flush();


       


       //promo
    /*    $promo = new Promo();
        $promo->setLangue($faker->randomElement(['francais','anglais','chinois','arabe']))
            ->setDescription($faker->text)
            ->setTitre("qui code bug,qui bug code")
            ->setLieu($faker->region)
            ->setFabrique($faker->text)
            ->setDateDebut($faker->dateTime())
            ->setDateFin($faker->dateTime())
            ->addReferentiel($referentiel)
            ->addFormateur($user)
            ->setArchivage(0);
        $manager->persist($promo);

        $manager->flush();*/

     //groupe
     /*  $groupe= new Groupe();
       $groupe->setNom($faker->lastName)
              ->setDateCreation($faker->dateTime())
              ->setStatut('actif')
              ->setType($faker->text)
              ->addPromo($promo)
              ->addFormateur($user)
              ->addApprenant($user)
              ->setArchivage(0);
            $manager->persist($groupe);

        $manager->flush();

*/
    }

}
