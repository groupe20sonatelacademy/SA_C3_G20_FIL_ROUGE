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
            KernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE],
        ];
    }









}