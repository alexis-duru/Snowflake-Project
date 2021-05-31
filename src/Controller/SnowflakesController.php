<?php

namespace App\Controller;

use App\Entity\Snowflake;
use App\Form\CreateSnowflakeType;
use App\Repository\SnowflakeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SnowflakesController extends AbstractController
{
    /// AFFICHAGE DE TOUS LES ARTICLES ////

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

    //// AFFICHAGE D'UN SEUL ARTICLE SINGLE ////

    /**
     * @Route("/snowflakes/{id<\d+>}", name="app_snowflakes_show", methods="GET")
     *
     * @param mixed $id
     */
    public function find(SnowflakeRepository $SnowflakeRepository, $id): Response
    {
        $snowflake = $SnowflakeRepository->find($id);

        return $this->render('snowflakes/single.html.twig', [
            'snowflakes' => $snowflake,
            // $SnowflakeRepository->findAll(), (chemin identique à $snowflakes)
        ]);
    }

    ///// CREATION DU FORMULAIRE////

    /**
     * @Route("/snowflakes/new", name="app_snowflakes_new", methods="GET|POST")
     */
    public function createEntity(EntityManagerInterface $em, Request $request)
    {
        $entity = new Snowflake();
        $form = $this->createForm(CreateSnowflakeType::class, $entity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->addFlash('success', 'Your __entity__ has been created successfully.');

            return $this->redirectToRoute('app_snowflakes');
        }

        //PERMET DE CRER LA VUE DU FORMULAIRE//
        return $this->render('snowflakes/addsnowflake.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/snowflakes/{id<\d+>}", name="app_snowflakes_delete", methods="DELETE")
     */
    public function delete(Snowflake $snowflake, Request $request, EntityManagerInterface $em)
    {
        if ($this->isCsrfTokenValid('snowflake_delete'.$snowflake->getId(), $request->request->get('csrf_token'))) {
            $em->remove($snowflake);
            $em->flush();
        }

        return $this->redirectToRoute('app_snowflakes');
    }
}
