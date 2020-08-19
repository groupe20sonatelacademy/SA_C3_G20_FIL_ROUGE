

<?php

namespace App\Controller;
use App\Entity\PasswordEnder;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordEnder implements EventSubscriberInterface {

    /**
     * @var UsePasswordEncoderInterface
     */
private $encoder;

}
