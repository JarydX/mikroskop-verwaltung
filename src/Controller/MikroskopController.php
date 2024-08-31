<?php

namespace App\Controller;

use App\Entity\Mikroskop;
use App\Form\MikroskopType;
use App\Repository\MikroskopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mikroskop')]
final class MikroskopController extends AbstractController
{
    #[Route(name: 'app_mikroskop_index', methods: ['GET'])]
    public function index(MikroskopRepository $mikroskopRepository): Response
    {
        return $this->render('mikroskop/index.html.twig', [
            'mikroskops' => $mikroskopRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mikroskop_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mikroskop = new Mikroskop();
        $form = $this->createForm(MikroskopType::class, $mikroskop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mikroskop);
            $entityManager->flush();

            return $this->redirectToRoute('app_mikroskop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mikroskop/new.html.twig', [
            'mikroskop' => $mikroskop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mikroskop_show', methods: ['GET'])]
    public function show(Mikroskop $mikroskop): Response
    {
        return $this->render('mikroskop/show.html.twig', [
            'mikroskop' => $mikroskop,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mikroskop_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mikroskop $mikroskop, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MikroskopType::class, $mikroskop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_mikroskop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mikroskop/edit.html.twig', [
            'mikroskop' => $mikroskop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mikroskop_delete', methods: ['POST'])]
    public function delete(Request $request, Mikroskop $mikroskop, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mikroskop->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($mikroskop);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mikroskop_index', [], Response::HTTP_SEE_OTHER);
    }
}
