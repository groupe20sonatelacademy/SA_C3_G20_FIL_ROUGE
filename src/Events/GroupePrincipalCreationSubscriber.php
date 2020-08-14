<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Groupe;
use App\Entity\Promotion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class GroupePrincipalCreationSubscriber implements EventSubscriberInterface
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager){
        $this->em = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['addGroupePrincipal', EventPriorities::PRE_WRITE]
        ];
    }

    public function addGroupePrincipal(ViewEvent $event)
    {
        $result = $event->getControllerResult();

        $method = $event->getRequest()->getMethod();

        if($result instanceof Promotion && $method === "POST")
        {
            $groupePrincipal = new Groupe();
            $groupePrincipal->setNom("Groupe Principal")
                            ->setDateCreation(date("Y-m-d"));
            $result->addGroupe($groupePrincipal);

            $result->setFabrique("Sonatel Academy");

            $this->em->persist($groupePrincipal);
            $this->em->flush();
        }
    }
}
