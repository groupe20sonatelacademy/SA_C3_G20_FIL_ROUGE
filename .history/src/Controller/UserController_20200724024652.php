<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
        $user = new AUser();
        $plainPassword = 'ryanpass';
        $encoded = $encoder->encodePassword($user, $plainPassword);

        $user->setPassword($encoded);
    }


    
}
