

<?php

namespace App/;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class PasswordEnder implements EventSubscriberInterface {

    /**
     * @var UsePasswordEncoderInterface
     */
private $encoder;

}
