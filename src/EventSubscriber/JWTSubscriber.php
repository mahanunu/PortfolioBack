<?php

namespace App\EventSubscriber;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Entity\User; // Assurez-vous que le namespace de votre entité User est correct

class JWTSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            'lexik_jwt_authentication.on_jwt_created' => 'onJWTCreated',
        ];
    }

    public function onJWTCreated(JWTCreatedEvent $event):
    void
    {
        $user = $event->getUser();
        $payload = $event->getData();

        if ($user instanceof User) {
            $payload['firstName'] = $user->getFirstName();
            // Vous pouvez ajouter d'autres champs ici si nécessaire, par exemple lastName ou id
            // $payload['lastName'] = $user->getLastName();
            // $payload['id'] = $user->getId();
        }

        // Assurez-vous que l'email est bien dans le payload si ce n'est pas déjà le cas via username
        // Normalement, LexikJWTAuthenticationBundle ajoute le user identifier (email ici) comme 'username' ou une clé similaire.
        // Si vous voulez explicitement une clé 'email', vous pouvez l'ajouter.
        // $payload['email'] = $user->getEmail(); 

        $event->setData($payload);
    }
} 