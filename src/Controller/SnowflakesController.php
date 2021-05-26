<?php
namespace App\Controller;
use App\Repository\SnowflakeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SnowflakesController extends AbstractController
{
    /**
     * @Route("/snowflakes", name="app_snowflakes")
     */
    public function snowflake(SnowflakeRepository $SnowflakeRepository): Response
    {
        $snowflakes = $SnowflakeRepository->findAll();

        return $this->render('snowflakes/index.html.twig', [
            'snowflakes' => $snowflakes,
            // $SnowflakeRepository->findAll(), (chemin identique à $snowflakes)
        ]);
    }
    /**
     * @Route("/snowflakes/{id}", name="app_snowflakes_show")
     */
    
    public function show(SnowflakeRepository $SnowflakeRepository): Response
    {
        $snowflakes = $SnowflakeRepository->findAll();

        return $this->render('snowflakes/index.html.twig', [
            'snowflakes' => $snowflakes,
            // $SnowflakeRepository->findAll(), (chemin identique à $snowflakes)
        ]);
    }
}
