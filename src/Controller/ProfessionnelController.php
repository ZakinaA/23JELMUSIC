<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Professionnel;

class ProfessionnelController extends AbstractController
{
    //#[Route('/professionnel', name: 'app_professionnel')]
    public function index(): Response
    {
        return $this->render('professionnel/index.html.twig', [
            'controller_name' => 'ProfessionnelController',
        ]);
    }

    public function listerProfessionnel(ManagerRegistry $doctrine){

        $repository = $doctrine->getRepository(Professionnel::class);

        $professionnel= $repository->findAll();
        return $this->render('professionnel/lister.html.twig',[
            'pProfessionnel' => $professionnel,
        ]);

    }

    public function consulterProfessionnel(ManagerRegistry $doctrine, int $id){

        $professionnel= $doctrine->getRepository(Professionnel::class)->find($id);

        if (!$professionnel) {
            throw $this->createNotFoundException(
                'Aucun professionnel trouvé avec le numéro '.$id
            );
        }

        return $this->render('professionnel/consulter.html.twig', [
            'professionnel' => $professionnel,]);
    }
}
