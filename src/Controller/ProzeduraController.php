<?php

namespace App\Controller;

use App\Entity\Prozedura;
use App\Form\ProzeduraType;
use App\Repository\ProzeduraRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/prozedura')]
class ProzeduraController extends AbstractController
{
    #[Route('/', name: 'prozedura_index', methods: ['GET'])]
    public function index(ProzeduraRepository $prozeduraRepository): Response
    {
        return $this->render('prozedura/index.html.twig', [
            'prozeduras' => $prozeduraRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'prozedura_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prozedura = new Prozedura();
        $form = $this->createForm(ProzeduraType::class, $prozedura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($prozedura);
            $entityManager->flush();

            return $this->redirectToRoute('prozedura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prozedura/new.html.twig', [
            'prozedura' => $prozedura,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'prozedura_show', methods: ['GET'])]
    public function show(Prozedura $prozedura): Response
    {
        return $this->render('prozedura/show.html.twig', [
            'prozedura' => $prozedura,
        ]);
    }

    #[Route('/{id}/edit', name: 'prozedura_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prozedura $prozedura, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProzeduraType::class, $prozedura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('prozedura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prozedura/edit.html.twig', [
            'prozedura' => $prozedura,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'prozedura_delete', methods: ['POST'])]
    public function delete(Request $request, Prozedura $prozedura, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prozedura->getId(), $request->request->get('_token'))) {
            $entityManager->remove($prozedura);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prozedura_index', [], Response::HTTP_SEE_OTHER);
    }
}
