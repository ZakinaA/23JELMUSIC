<?php

namespace App\Controller;

use App\Entity\Cours;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{
    //#[Route('/cours', name: 'app_cours')]
    public function index(): Response
    {
        return $this->render('cours/index.html.twig', [
            'controller_name' => 'CoursController',
        ]);
    }
    //#[Route('/cours/lister', name: 'coursLister')]
    public function lister(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Cours::class);

        $cours= $repository->findAll();
        return $this->render('cours/lister.html.twig', [
            'pCours' => $cours,]);
    }
}