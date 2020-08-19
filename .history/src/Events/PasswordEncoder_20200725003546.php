

<?php

namespace App\Controller;
use App\Entity\UsePasswordEncoderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class PasswordEnder implements EventSubscriberInterface {

    /**
     * @var UsePasswordEncoderInterface
     */
private $encoder;

}
