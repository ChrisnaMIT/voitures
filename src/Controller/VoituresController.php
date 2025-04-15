<?php

namespace App\Controller;

use App\Entity\Voitures;
use App\Repository\VoituresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class VoituresController extends AbstractController
{
    #[Route('/voitures', name: 'app_voitures')]
    public function index(VoituresRepository $voituresRepository): Response
    {
        $voitures = $voituresRepository->findAll();

        return $this->render('voitures/index.html.twig', [

            'voitures' => $voitures,
        ]);
    }

    #[Route('/voitures/{id}', name: 'app_voitures_show')]
    public function show(Voitures $voiture): Response
    {
        return $this->render('voitures/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }


    #[Route('/voitures/{id}/delete', name: 'app_voitures_delete')]
    public function delete (Request $request, Voitures $voiture, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $em->remove($voiture);
            $em->flush();
        }
        return $this->redirectToRoute('app_voitures');
    }




}
