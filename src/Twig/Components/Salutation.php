<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Salutation
{

    public function getSalutation(): string
    {
        $hour = (int) date('H'); // Récupère l'heure actuelle

        if ($hour >= 5 && $hour < 18) { // Entre 5h et 18h
            return 'Bonjour';
        } elseif ($hour >= 18 && $hour < 23) { // Entre 18h et 23h
            return 'Bonsoir';
        } else { // Sinon
            return 'Il est tard le sang 😩';
        }
    }
}
