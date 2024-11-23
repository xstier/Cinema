<?php

namespace App\Controller;

use App\Entity\Salles;
use App\Form\SallesType;
use App\Repository\SallesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/salles')]
final class SallesController extends AbstractController
{
    #[Route(name: 'app_salles_index', methods: ['GET'])]
    public function index(SallesRepository $sallesRepository): Response
    {
        return $this->render('salles/index.html.twig', [
            'salles' => $sallesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_salles_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $salle = new Salles();
        $form = $this->createForm(SallesType::class, $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($salle);
            $entityManager->flush();

            return $this->redirectToRoute('app_salles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('salles/new.html.twig', [
            'salle' => $salle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_salles_show', methods: ['GET'])]
    public function show(Salles $salle): Response
    {
        return $this->render('salles/show.html.twig', [
            'salle' => $salle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_salles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Salles $salle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SallesType::class, $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_salles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('salles/edit.html.twig', [
            'salle' => $salle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_salles_delete', methods: ['POST'])]
    public function delete(Request $request, Salles $salle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salle->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($salle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_salles_index', [], Response::HTTP_SEE_OTHER);
    }
}
