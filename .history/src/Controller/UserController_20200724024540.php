<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }




    public function register(UserPasswordEncoderInterface $encoder)
    {
        // whatever *your* User object is
        $user = new App\Entity\User();
        $plainPassword = 'ryanpass';
        $encoded = $encoder->encodePassword($user, $plainPassword);

        $user->setPassword($encoded);
    }


    
}
