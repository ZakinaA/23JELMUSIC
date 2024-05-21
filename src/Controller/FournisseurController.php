<?php

namespace App\Controller;

use App\Entity\Fournisseur;
use App\Entity\Instrument;
use App\Form\FournisseurAjouterType;
use App\Form\InstrumentAjouterType;
use App\Form\InstrumentModifierType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FournisseurController extends AbstractController
{

    public function consulterFournisseur(ManagerRegistry $doctrine , int $id){

        $fournisseur = $doctrine->getRepository(Fournisseur::class)->find($id);

        if(!$fournisseur){
            throw $this->createNotFoundException('Aucun fournisseur trouvé avec le numéro '.$id);
        }

        return $this->render('fournisseur/consulter.html.twig', [
            'fournisseur' => $fournisseur,
        ]);
    }

    public function listerFournisseur(ManagerRegistry $doctrine){
        $repository = $doctrine->getRepository(Fournisseur::class);

        $fournisseurs = $repository->findAll();
        return $this->render('fournisseur/lister.html.twig', ['pFournisseurs' => $fournisseurs,]);
    }

    public function ajouterFournisseur(ManagerRegistry $doctrine,Request $request){
        $fournisseur = new Fournisseur();
        $form = $this->createForm(FournisseurAjouterType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $fournisseur = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($fournisseur);
            $entityManager->flush();

            return $this->render('fournisseur/consulter.html.twig', ['fournisseur' => $fournisseur,]);
        } else {
            return $this->render('fournisseur/ajouter.html.twig', array('form' => $form->createView(),));
        }
    }

    public function modifierInstrument(ManagerRegistry $doctrine, $id, Request $request){

        $instrument = $doctrine->getRepository(Instrument::class)->find($id);

        $repository = $doctrine->getRepository(Instrument::class);
        $instruments = $repository->findAll();

        if (!$instrument) {
            throw $this->createNotFoundException('Aucun etudiant trouvé avec le numéro '.$id);
        }
        else
        {
            $form = $this->createForm(InstrumentModifierType::class, $instrument);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $instrument = $form->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($instrument);
                $entityManager->flush();
                return $this->render('instrument/consulter.html.twig', ['instrument' => $instrument, 'pInstruments' => $instruments]);
            }
            else{
                return $this->render('instrument/modifier.html.twig', array('form' => $form->createView(), 'instrument' => $instrument,));
            }
        }
    }
}
