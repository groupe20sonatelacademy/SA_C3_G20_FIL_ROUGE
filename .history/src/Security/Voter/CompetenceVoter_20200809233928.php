<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CompetenceVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['EDIT', 'VIEW', 'ARCHIVE', 'SET'])
            && $subject instanceof \App\Entity\Competence;
    }

    protected function voteOnAttribute($attribute, $competence, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'EDIT':
                // logic to determine if the user can EDIT
                // return true or false
                if ($user->getRoles()[0] === "ROLE_Administrateur") {
                    return true;
                }
                break;
            case 'VIEW':
                // logic to determine if the user can VIEW
                // return true or false
                if ($user->getRoles()[0] === "ROLE_Admin"|) {
                    return true;
                }
                break;
            case 'ARCHIVE':
                // logic to determine if the user can ARCHIVE
                // return false or true
                if ($user->getRoles()[0] === 'ROLE_Administrateur') {
                    return true;
                }
                break;
            case 'SET':
                // logic to determine if the user can SET
                // return false or true
                if ($user->getRoles()[0] === "ROLE_Administrateur") {
                    return true;
                }
        }

        return false;
    }
}