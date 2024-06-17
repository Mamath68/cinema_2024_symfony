<?php

namespace App\Controller;

use App\Entity\Realisateurs;
use App\Form\RealisateursType;
use App\Repository\RealisateursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/realisateurs')]
class RealisateursController extends AbstractController
{
    #[Route('/', name: 'app_realisateurs', methods: ['GET'])]
    public function index(RealisateursRepository $realisateursRepository): Response
    {
        return $this->render('realisateurs/index.html.twig', [
            'realisateurs' => $realisateursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_realisateurs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $realisateur = new Realisateurs();
        $form = $this->createForm(RealisateursType::class, $realisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($realisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_realisateurs', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('realisateurs/new.html.twig', [
            'realisateur' => $realisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_realisateurs_show', methods: ['GET'])]
    public function show(Realisateurs $realisateur): Response
    {
        return $this->render('realisateurs/show.html.twig', [
            'realisateur' => $realisateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_realisateurs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Realisateurs $realisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RealisateursType::class, $realisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_realisateurs', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('realisateurs/edit.html.twig', [
            'realisateur' => $realisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_realisateurs_delete', methods: ['POST'])]
    public function delete(Request $request, Realisateurs $realisateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $realisateur->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($realisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_realisateurs', [], Response::HTTP_SEE_OTHER);
    }
}
