<?php

namespace App\Controller;

use App\Entity\Arduraduna;
use App\Form\ArduradunaType;
use App\Repository\ArduradunaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/arduraduna')]
class ArduradunaController extends AbstractController
{
    #[Route('/', name: 'arduraduna_index', methods: ['GET'])]
    public function index(ArduradunaRepository $arduradunaRepository): Response
    {
        return $this->render('arduraduna/index.html.twig', [
            'arduradunas' => $arduradunaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'arduraduna_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $arduraduna = new Arduraduna();
        $form = $this->createForm(ArduradunaType::class, $arduraduna);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($arduraduna);
            $entityManager->flush();

            return $this->redirectToRoute('arduraduna_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('arduraduna/new.html.twig', [
            'arduraduna' => $arduraduna,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'arduraduna_show', methods: ['GET'])]
    public function show(Arduraduna $arduraduna): Response
    {
        return $this->render('arduraduna/show.html.twig', [
            'arduraduna' => $arduraduna,
        ]);
    }

    #[Route('/{id}/edit', name: 'arduraduna_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Arduraduna $arduraduna, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArduradunaType::class, $arduraduna);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('arduraduna_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('arduraduna/edit.html.twig', [
            'arduraduna' => $arduraduna,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'arduraduna_delete', methods: ['POST'])]
    public function delete(Request $request, Arduraduna $arduraduna, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$arduraduna->getId(), $request->request->get('_token'))) {
            $entityManager->remove($arduraduna);
            $entityManager->flush();
        }

        return $this->redirectToRoute('arduraduna_index', [], Response::HTTP_SEE_OTHER);
    }
}
