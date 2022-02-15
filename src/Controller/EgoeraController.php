<?php

namespace App\Controller;

use App\Entity\Egoera;
use App\Form\EgoeraType;
use App\Repository\EgoeraRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/egoera')]
class EgoeraController extends AbstractController
{
    #[Route('/', name: 'egoera_index', methods: ['GET'])]
    public function index(EgoeraRepository $egoeraRepository): Response
    {
        return $this->render('egoera/index.html.twig', [
            'egoeras' => $egoeraRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'egoera_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $egoera = new Egoera();
        $form = $this->createForm(EgoeraType::class, $egoera);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($egoera);
            $entityManager->flush();

            return $this->redirectToRoute('egoera_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('egoera/new.html.twig', [
            'egoera' => $egoera,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'egoera_show', methods: ['GET'])]
    public function show(Egoera $egoera): Response
    {
        return $this->render('egoera/show.html.twig', [
            'egoera' => $egoera,
        ]);
    }

    #[Route('/{id}/edit', name: 'egoera_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Egoera $egoera, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EgoeraType::class, $egoera);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('egoera_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('egoera/edit.html.twig', [
            'egoera' => $egoera,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'egoera_delete', methods: ['POST'])]
    public function delete(Request $request, Egoera $egoera, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$egoera->getId(), $request->request->get('_token'))) {
            $entityManager->remove($egoera);
            $entityManager->flush();
        }

        return $this->redirectToRoute('egoera_index', [], Response::HTTP_SEE_OTHER);
    }
}
