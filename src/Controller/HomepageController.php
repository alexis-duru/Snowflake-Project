<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('homepage/index.html.twig');
    }

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
