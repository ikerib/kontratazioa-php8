<?php

namespace App\Controller;

use App\Entity\Kontaktuak;
use App\Form\KontaktuakType;
use App\Repository\KontaktuakRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/kontaktuak')]
class KontaktuakController extends AbstractController
{
    #[Route('/', name: 'kontaktuak_index', methods: ['GET'])]
    public function index(KontaktuakRepository $kontaktuakRepository): Response
    {
        return $this->render('kontaktuak/index.html.twig', [
            'kontaktuaks' => $kontaktuakRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'kontaktuak_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $kontaktuak = new Kontaktuak();
        $form = $this->createForm(KontaktuakType::class, $kontaktuak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($kontaktuak);
            $entityManager->flush();

            return $this->redirectToRoute('kontaktuak_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kontaktuak/new.html.twig', [
            'kontaktuak' => $kontaktuak,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'kontaktuak_show', methods: ['GET'])]
    public function show(Kontaktuak $kontaktuak): Response
    {
        return $this->render('kontaktuak/show.html.twig', [
            'kontaktuak' => $kontaktuak,
        ]);
    }

    #[Route('/{id}/edit', name: 'kontaktuak_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Kontaktuak $kontaktuak, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(KontaktuakType::class, $kontaktuak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('kontaktuak_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kontaktuak/edit.html.twig', [
            'kontaktuak' => $kontaktuak,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'kontaktuak_delete', methods: ['POST'])]
    public function delete(Request $request, Kontaktuak $kontaktuak, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kontaktuak->getId(), $request->request->get('_token'))) {
            $entityManager->remove($kontaktuak);
            $entityManager->flush();
        }

        return $this->redirectToRoute('kontaktuak_index', [], Response::HTTP_SEE_OTHER);
    }
}
