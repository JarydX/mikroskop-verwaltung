<?php

namespace App\Controller;

use App\Entity\Lagerort;
use App\Form\LagerortType;
use App\Repository\LagerortRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/lagerort')]
final class LagerortController extends AbstractController
{
    #[Route(name: 'app_lagerort_index', methods: ['GET'])]
    public function index(LagerortRepository $lagerortRepository): Response
    {
        return $this->render('lagerort/index.html.twig', [
            'lagerorts' => $lagerortRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lagerort_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lagerort = new Lagerort();
        $form = $this->createForm(LagerortType::class, $lagerort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lagerort);
            $entityManager->flush();

            return $this->redirectToRoute('app_lagerort_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lagerort/new.html.twig', [
            'lagerort' => $lagerort,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lagerort_show', methods: ['GET'])]
    public function show(Lagerort $lagerort): Response
    {
        return $this->render('lagerort/show.html.twig', [
            'lagerort' => $lagerort,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lagerort_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lagerort $lagerort, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LagerortType::class, $lagerort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lagerort_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lagerort/edit.html.twig', [
            'lagerort' => $lagerort,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lagerort_delete', methods: ['POST'])]
    public function delete(Request $request, Lagerort $lagerort, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lagerort->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($lagerort);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lagerort_index', [], Response::HTTP_SEE_OTHER);
    }
}
