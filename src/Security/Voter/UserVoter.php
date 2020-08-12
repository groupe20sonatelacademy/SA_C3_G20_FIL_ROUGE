<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{

    private $security = null;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * Permet de vérifie le rôle du USER
     * @param $role
     * @return bool
     */
    public function verifiyIsGranted ($role){
        return $this->security->isGranted($role);
    }

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['USER_CREATE','USER_EDIT', 'USER_VIEW'])
            && $subject instanceof \App\Entity\User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'USER_CREATE' : case 'USERS_VIEW' :
                //Création d'un utilisateur et lister tous les utilisateurs
                if($this->verifiyIsGranted('ROLE_Administrateur')){
                    return true;
                }
                break;
            case 'USER_EDIT' : case 'USER_VIEW' :
                //Modification d'un utilisateur
                if($this->verifiyIsGranted('ROLE_Administrateur') || $this->verifiyIsGranted('ROLE_Apprenant')){
                    return true;
                }
                break;

        }

        return false;
    }
}
