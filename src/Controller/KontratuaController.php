<?php

namespace App\Controller;

use App\Entity\Kontratua;
use App\Form\KontratuaType;
use App\Repository\KontratuaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/kontratua')]
class KontratuaController extends AbstractController
{
    #[Route('/', name: 'kontratua_index', methods: ['GET'])]
    public function index(KontratuaRepository $kontratuaRepository): Response
    {
        return $this->render('kontratua/index.html.twig', [
            'kontratuas' => $kontratuaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'kontratua_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $kontratua = new Kontratua();
        $form = $this->createForm(KontratuaType::class, $kontratua);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($kontratua);
            $entityManager->flush();

            return $this->redirectToRoute('kontratua_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kontratua/new.html.twig', [
            'kontratua' => $kontratua,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'kontratua_show', methods: ['GET'])]
    public function show(Kontratua $kontratua): Response
    {
        return $this->render('kontratua/show.html.twig', [
            'kontratua' => $kontratua,
        ]);
    }

    #[Route('/{id}/edit', name: 'kontratua_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Kontratua $kontratua, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(KontratuaType::class, $kontratua);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('kontratua_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kontratua/edit.html.twig', [
            'kontratua' => $kontratua,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'kontratua_delete', methods: ['POST'])]
    public function delete(Request $request, Kontratua $kontratua, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kontratua->getId(), $request->request->get('_token'))) {
            $entityManager->remove($kontratua);
            $entityManager->flush();
        }

        return $this->redirectToRoute('kontratua_index', [], Response::HTTP_SEE_OTHER);
    }
}
