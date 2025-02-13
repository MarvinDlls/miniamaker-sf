<?php

namespace App\Service;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig\Environment;

class LoginEventService implements EventSubscriberInterface
{
    private MailerInterface $mailer;
    private Environment $twig;

    // Injection du service MailerInterface et du service Twig
    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * Envoie un email à l'utilisateur après sa connexion.
     */
    public function onLogin(InteractiveLoginEvent $event): void
    {
        $user = $event->getAuthenticationToken()->getUser();
        $loginHistorie = $user->getLoginHistories()->last();
        
        if ($user && method_exists($user, 'getEmail')) {
            $htmlContent = $this->twig->render('login/login_notification_email.html.twig', [
                'user' => $user, 
                'loginHistory' => $loginHistorie,  // Passer l'utilisateur au template
            ]);

            $email = (new Email())
                ->from('contact@miniamaker.com')
                ->to($user->getEmail())
                ->subject('Connexion réussie à votre compte')
                ->html($htmlContent);  

            // Envoi de l'email
            $this->mailer->send($email);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            InteractiveLoginEvent::class => 'onLogin',
        ];
    }
}