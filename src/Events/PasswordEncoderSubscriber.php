<?php

namespace App\Events;

use App\Entity\User;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

//Kernel va lui envoyer un évenement
class PasswordEncoderSubscriber implements EventSubscriberInterface {

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    

    /**
     * Undocumented function
     * @return void
     *Répond à symfony en lui passant les méthode
     */
    public static function getSubscribedEvents()
    {
        //Symfony: Tu m'as appelé, qu'attends-tu de moi ?
        //Class: Je veut intervenir à cet évement (evenement VIEW) !
        //Symfony: Ok, quand et que veux tu que je fasse ?
        //Class: Je veux que tu m'excute cette méthode (encodePassword) avant l'écriture.
        return [
            KernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE]
        ];

    }

    //Notre fonction encodePassword
    public function encodePassword(ViewEvent $event)
    {
        //On capture l'élément en cours de traitement avant écriture
        $result = $event->getControllerResult();
        
        //On récupère notre méthode
        $method=$event->getRequest()->getMethod();

        //Exécute si et seulement si notre résult est de type USER (entity)
        if($result instanceof User && ($method === "POST" || $method === "PUT"))
        {
            //On encode le password 
            $hash = $this->encoder->encodePassword($result,$result->getPassword());
            $result->setPassword($hash);
        }    

    }

}