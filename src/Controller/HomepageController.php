<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
                                /// CREATION DE LA HOMEPAGE ////

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('homepage/index.html.twig');
    }

    /// CREATION DU CHIFFRE RANDOM ///

    /**
     * @Route("/random", name="app_random")
     */
    public function random(): Response
    {
        $number = random_int(0, 100);

        return $this->render(
            'homepage/random.html.twig',
            ['number' => $number]
        );
    }
}

// LE CONTROLEUR REPOND A DES REQUETES //
// LE CONTROLEUR REPOND A DES REQUETES //
// LE CONTROLEUR REPOND A DES REQUETES //
// LE ROUTEUR VA SIGNALER AU CONTROLEUR QU'IL DOIT TRAITER DES OPERATIONS //
// CLI // GUI : COMMAND LINE INTERFACE : COMPOSER-BUNDLE, SYMPHONY-BUNDLE, YARD-BUNDLE, MAKER-BUNDLE
