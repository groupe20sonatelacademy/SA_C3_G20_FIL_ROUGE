

<?php

namespace App\Controller;

use App\Entity\PasswordEncoder;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordEncoder implements EventSubscriberInterface {

    /**
     * @var UserPasswordEncoderInterface
     */
private $encoder;

Public function __construct(UserPasswordEncoderInterface $encoder)
{
    $this->encoder=$encoder,
}









}
