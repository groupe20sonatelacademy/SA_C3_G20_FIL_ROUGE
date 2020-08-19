<?php

namespace App\Events;

use App\Entity\User;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Flex\Unpack\Result;

class PasswordEncoderSubscriber implements EventSubscriberInterface {

    /**
     * @var UserPasswordEncoderInterface
     */
private $encoder;

public function __construct(UserPasswordEncoderInterface $encoder)
{
    $this->encoder= $encoder;
}
/**
 * Undocumented function
 *
 * @return void
 * Repond a symfony en lui posant des methodes
 */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW =>['encodePassword',EventPriorities::POST_WRITE],
        ];
    }
//symfony: pour quoi tu m'as appelé
//class :je veux intervenir a cetbevenement (eve)
//symfony : quand et que veux que je fasse
//classe : je veux que tu m'execute cette methode (encodepassword) avant l'ecriture
    public function encodePassword(ViewEvent $event)
    {
        $result = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($result instanceof User && $method ==="POST" || $method==="PUT" ) {
            $hash= $this->encoder->encodePassword($result,$result->getPassword());
            $result->setPassword($hash);
        }
    }





}