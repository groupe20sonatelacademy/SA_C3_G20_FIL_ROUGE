<?php

namespace App\Events;

use App\Entity\Promo;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GroupePrincipalCreationSubscriber implements EventSubscriberInterface {

    public static function getSubscribedEvents() 
    {

        return [
            KernelEvents::VIEW => ['addGroupePrincipal', EventPriorities::PRE_WRITE],
        ];
     }

            public function encodePassword(ViewEvent $event)
            {
                // on capture l'element encours avant l'ecriture
                $result = $event->getControllerResult();
                $method = $event->getRequest()->getMethod();
           }

        if ($result instanceof P && ($method === "POST" || $method === "PUT")) {

            //on encode le password
            $hash = $this->encoder->encodePassword($result, $result->getPassword());

            $result->setPassword($hash);
        }


    }









