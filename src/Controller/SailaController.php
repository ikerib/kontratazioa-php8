<?php

namespace App\Controller;

use App\Entity\Saila;
use App\Form\SailaType;
use App\Repository\SailaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/saila')]
class SailaController extends AbstractController
{
    #[Route('/', name: 'saila_index', methods: ['GET'])]
    public function index(SailaRepository $sailaRepository): Response
    {
        return $this->render('saila/index.html.twig', [
            'sailas' => $sailaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'saila_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $saila = new Saila();
        $form = $this->createForm(SailaType::class, $saila);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($saila);
            $entityManager->flush();

            return $this->redirectToRoute('saila_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('saila/new.html.twig', [
            'saila' => $saila,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'saila_show', methods: ['GET'])]
    public function show(Saila $saila): Response
    {
        return $this->render('saila/show.html.twig', [
            'saila' => $saila,
        ]);
    }

    #[Route('/{id}/edit', name: 'saila_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Saila $saila, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SailaType::class, $saila);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('saila_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('saila/edit.html.twig', [
            'saila' => $saila,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'saila_delete', methods: ['POST'])]
    public function delete(Request $request, Saila $saila, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$saila->getId(), $request->request->get('_token'))) {
            $entityManager->remove($saila);
            $entityManager->flush();
        }

        return $this->redirectToRoute('saila_index', [], Response::HTTP_SEE_OTHER);
    }
}
