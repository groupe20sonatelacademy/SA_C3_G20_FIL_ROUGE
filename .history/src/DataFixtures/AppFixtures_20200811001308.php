<?php

namespace App\DataFixtures;

use App\Entity\CM;
use Faker\Factory;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Promo;
use App\Entity\Groupe;
use App\Entity\Niveau;
use App\Entity\Profils;
use App\Entity\Apprenant;
use App\Entity\Formateur;
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




      //on gere les niveaux
      
       
            
        //On genere les competences
        $tabcompetence=[
            'Maquetter une application',
            'Développer une interface web dynamique', 
            'créer une base de données ',
        ];

        foreach($tabcompetence as $libelle){
        $competence= new Competence();
        $competence->setLibelle($libelle)
                ->setDescriptif($faker->text)
                ->setArchivage(0);

        $manager->persist($competence);

        for($i=1;$i<=3;$i++){ 
            $niveau = new Niveau();
            $niveau->setLibelle($libelle.$i)
                ->setGroupeDaction($faker->text)
                ->setCritereDevaluation($faker->text)
                ->setArchivage(0);
            $manager->persist($niveau);
           $competence->addNiveau($niveau);

          }

     }
      
        //on genere les groupes de competences
         $tabgroupecompetence=[
            'Créer une base de données ',
            'Développer les composants d’accès aux données',
            'Developper une application durable'
                    ];
                foreach($tabgroupecompetence as $libelle){
            $tabtag = ['HTML5', 'JAVA', 'CMS', 'CSS'];

             $groupecompetence= new GroupeCompetence();
             $groupecompetence->setLibelle($libelle)
                      ->setDescriptif($faker->text)
                      ->addCompetence($competence)
                      ->setArchivage(0);

               


            // on genere les tags
           
            foreach ($tabtag as $libelle) {
                $tag = new Tag();
                $tag->setLibelle($libelle)
                    ->setDescriptif($faker->text)
                    ->setArchivage(0);
                $manager->persist($groupecompetence);
                $manager->persist($tag);
                 $groupecompetence->addTag($tag);
            }

           }    

       $manager->flush();

     //referentiel
       $tabreference=[
           'developpement web et mobile',
           'developpement de site internet',
           'developpement de data',
           'referent digital'
       ];

       foreach($tabreference as $libelle){

           $referentiel= new Referentiel();

           $referentiel->setLibelle($libelle)
                       ->setPresentation($faker->text)
                       ->setProgramme($faker->text)
                       ->setCritereEvaluation($faker->text)
                       ->setCritereAdmission($faker->text)
                       ->addGroupeCompetence($groupecompetence)
                       ->setArchivage(0);
                $manager->persist($referentiel);

            }
        $manager->flush();

     /*   //promo
        $promo = new Promo();

        $promo->setLangue($faker->randomElement(['francais','anglais','chinois','arabe']))
            ->setDescription($faker->text)
            ->setLieu($faker->region)
            ->setFabrique($faker->text)
            ->setDateDebut($faker->dateTime())
            ->setDateFin($faker->dateTime())
            ->addReferentiel($referentiel)
            ->addFormateur($user)
            ->setArchivage(0);
        $manager->persist($promo);

        $manager->flush();

     //groupe
       $groupe= new Groupe();
       $groupe->setNom($faker->lastName)
              ->setDateCreation($faker->date)
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
