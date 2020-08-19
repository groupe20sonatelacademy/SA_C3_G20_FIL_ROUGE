<?php

namespace App\Events;

use DateTime;
use App\Entity\Promo;
use App\Entity\Groupe;
use App\Entity\Apprenant;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Expr\Value;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class GroupePrincipalCreationSubscriber implements EventSubscriberInterface {

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager =$manager;
    }

    public static function getSubscribedEvents() 
    {

        return [
            KernelEvents::VIEW => ['addGroupePrincipal', EventPriorities::PRE_WRITE],
        ];
     }

     public function addGroupePrincipal(ViewEvent $event)
    {
                // on capture l'element encours avant l'ecriture
                $result = $event->getControllerResult();
                $method = $event->getRequest()->getMethod();
            

        if($result instanceof Promo && ($method === "POST" )) 
        {
            
            $groupeprincipal= new Groupe();
            $groupeprincipal->setNom("Groupe Principal")
                            ->setDateCreation(new\DateTime())
                            ->setStatut("actif")
                            ->setType("buggg")
                            ->setArchivage(0);

           // $result->addApprenant($apprenant);
            $result->addGroupe($groupeprincipal);
            $result->setFabrique("SONATEL ACADEMY");
            $this->manager->persist($groupeprincipal);

            $this->manager->flush();


        }
    }

    public function addPromo(\Swift_Mailer $mailer, ApprenantRepository $apprenantRepository, Value $value)
    {
        //debut action
        foreach ($value['apprenant'] as $values) {

            
            if ($Apprenant = $apprenantRepository->findOneByEmail($values['email'])) {

                $result = (new \Swift_Message('Selection Sonatel Accademy'))
                    ->setFrom('usernameAdmin@gmail.com')
                    ->setTo($Apprenant->getEmail())
                    ->setBody('Bonjour Cher(e)' . $Apprenant->getPrenom() . '' . $Apprenant->getNom() .
                        ' Félicitation!!! vous avez été selectionné suite  à votre test d\'entrer à la sonatel accademy
                          Veuillez utiliser ces informations pour vous connecter à votre promo. Usermane:' . $Apprenant->getUsername() .
                        'Password:<<commonPassword>>. A bientot.');


                $mailer->send($result);
            }
        }
        

    }
//fin action

}









