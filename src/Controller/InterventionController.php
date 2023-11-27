<?php

namespace App\Controller;

use App\Entity\Intervention;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterventionController extends AbstractController
{
    //#[Route('/intervention', name: 'app_intervention')]
    public function index(): Response
    {
        return $this->render('intervention/index.html.twig', [
            'controller_name' => 'InterventionController',
        ]);
    }

    public function listerIntervention(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Intervention::class);

        $Interventions= $repository->findAll();
        return $this->render('intervention/lister.html.twig', [
            'pIntervention' => $Interventions,]);

    }

    public function consulterIntervention(ManagerRegistry $doctrine, int $id){

        $intervention= $doctrine->getRepository(Intervention::class)->find($id);

        if (!$intervention) {
            throw $this->createNotFoundException(
                'Aucune intervention trouvé avec le numéro '.$id
            );
        }

        //return new Response('Intervention : '.$Intervention->getNom());
        return $this->render('intervention/consulter.html.twig', [
            'intervention' => $intervention,]);
    }
}
