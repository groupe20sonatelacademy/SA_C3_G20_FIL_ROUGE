<?php

namespace App\Events;

use App\Entity\Promo;
use App\Entity\Groupe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use DateTime;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class GroupePrincipalCreationSubscriber implements EventSubscriberInterface {

    private $manager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
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
            

        if ($result instanceof Promo && ($method === "POST" )) 
        {

            
            $groupeprincipal= new Groupe();
            $groupeprincipal->setNom("Groupe Principal")
                            ->setDateCreation(new\DateTime());
 

            $this->$manager->persist($groupeprincipal);

            $this->$manager->flush();


        }
    }

}









