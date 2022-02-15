<?php

namespace App\Controller;

use App\Entity\Fitxategia;
use App\Form\FitxategiaType;
use App\Repository\FitxategiaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fitxategia')]
class FitxategiaController extends AbstractController
{
    #[Route('/', name: 'fitxategia_index', methods: ['GET'])]
    public function index(FitxategiaRepository $fitxategiaRepository): Response
    {
        return $this->render('fitxategia/index.html.twig', [
            'fitxategias' => $fitxategiaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'fitxategia_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fitxategium = new Fitxategia();
        $form = $this->createForm(FitxategiaType::class, $fitxategium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fitxategium);
            $entityManager->flush();

            return $this->redirectToRoute('fitxategia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fitxategia/new.html.twig', [
            'fitxategium' => $fitxategium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'fitxategia_show', methods: ['GET'])]
    public function show(Fitxategia $fitxategium): Response
    {
        return $this->render('fitxategia/show.html.twig', [
            'fitxategium' => $fitxategium,
        ]);
    }

    #[Route('/{id}/edit', name: 'fitxategia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fitxategia $fitxategium, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FitxategiaType::class, $fitxategium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('fitxategia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fitxategia/edit.html.twig', [
            'fitxategium' => $fitxategium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'fitxategia_delete', methods: ['POST'])]
    public function delete(Request $request, Fitxategia $fitxategium, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fitxategium->getId(), $request->request->get('_token'))) {
            $entityManager->remove($fitxategium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fitxategia_index', [], Response::HTTP_SEE_OTHER);
    }
}
