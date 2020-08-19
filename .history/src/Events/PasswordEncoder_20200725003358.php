

<?php

namespace App\Controller;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class PasswordEnder implements EventSubscriberInterface {

    /**
     * @var UsePasswordEncoderInterface
     */
private $encoder;

}
