

<?php

namespace App\Controller;
use App\Entity\PasswordEncoder;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class PasswordEnder implements EventSubscriberInterface {

    /**
     * @var UsePasswordEncoderInterface
     */
private $encoder;

}
