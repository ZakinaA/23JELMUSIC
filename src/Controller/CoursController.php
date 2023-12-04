<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursModifierType;
use App\Form\CoursType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
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
    public function listerCours(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Cours::class);

        $cours= $repository->findAll();
        return $this->render('cours/lister.html.twig', [
            'pCours' => $cours,]);
    }

    //#[Route('/cours/consulter/{id}', name: 'coursConsulter')]
    public function consulterCours(ManagerRegistry $doctrine, int $id){

        $cours= $doctrine->getRepository(Cours::class)->find($id);

        if (!$cours) {
            throw $this->createNotFoundException(
                'Aucun cours trouvé avec le numéro '.$id
            );
        }

        $eleveInscrits = $cours->getInscriptions();

        //return new Response('cours : '.$cours->getLibelle());
        return $this->render('cours/consulter.html.twig', [
            'cours' => $cours,
            'eleveInscrits' => $eleveInscrits,]);
    }

    //#[Route('/cours/ajouter', name: 'coursAjouter')]
    public function ajouterCours(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cours = new Cours();
        $form = $this->createForm(CoursType::class, $cours);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cours);
            $entityManager->flush();

            $this->addFlash('success', 'Cours créé avec succès!');
            return $this->redirectToRoute('coursLister');
        }

        return $this->render('cours/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function modifierCours(ManagerRegistry $doctrine, $id, Request $request){

        $cours = $doctrine->getRepository(Cours::class)->find($id);

        $repository = $doctrine->getRepository(Cours::class);
        //$cours = $repository->findAll();

        if (!$cours) {
            throw $this->createNotFoundException('Aucun cours trouvé avec le numéro '.$id);
        }
        else
        {
            $form = $this->createForm(CoursModifierType::class, $cours);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $cours = $form->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($cours);
                $entityManager->flush();
                return $this->redirectToRoute("coursLister");
            }
            else{
                return $this->render('cours/ajouter.html.twig', array('form' => $form->createView(),));
            }
        }
    }
}