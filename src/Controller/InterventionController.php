<?php

namespace App\Controller;

use App\Entity\Instrument;
use App\Entity\Intervention;
use App\Form\InstrumentAjouterType;
use App\Form\InterventionAjoutType;
use App\Form\InterventionModifierType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    public function ajouterIntervention(ManagerRegistry $doctrine,Request $request){
        $intervention = new Intervention();
        $form = $this->createForm(InterventionAjoutType::class, $intervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $instrument = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($intervention);
            $entityManager->flush();

            return $this->render('intervention/consulter.html.twig', ['intervention' => $intervention,]);
        }
        else
        {
            return $this->render('intervention/ajouter.html.twig', array('form' => $form->createView(),));
        }
    }

    public function modifierIntervention(ManagerRegistry $doctrine, $id, Request $request){


        $intervention = $doctrine->getRepository(Intervention::class)->find($id);

        $repository = $doctrine->getRepository(Intervention::class);
        $interventions = $repository->findAll();

        if (!$intervention) {
            throw $this->createNotFoundException('Aucune intervention trouvé avec le numéro '.$id);
        }
        else
        {
            $form = $this->createForm(InterventionModifierType::class, $intervention);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $intervention = $form->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($intervention);
                $entityManager->flush();
                return $this->render('intervention/consulter.html.twig', ['intervention' => $intervention, 'pInterventions' => $interventions]);
            }
            else{
                return $this->render('intervention/ajouter.html.twig', array('form' => $form->createView(),));
            }
        }
    }
}
