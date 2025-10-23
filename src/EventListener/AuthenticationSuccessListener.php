<?php

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        /** @var User $user */
        $user = $event->getUser();

        if (!$user) {
            return;
        }

        // Ajouter les infos de l'utilisateur à la réponse
        $data['user'] = [
            'id' => $user->getId(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'email' => $user->getEmail(),
            'phoneNumber' => $user->getPhoneNumber(),
            'roles' => $user->getRoles()
        ];

        $event->setData($data);
    }
}