<?php

namespace App\Controller;

use App\Entity\TipoIva;
use App\Form\TipoIvaType;
use App\Repository\TipoIvaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tipo/iva')]
class TipoIvaController extends AbstractController
{
    #[Route('/', name: 'tipo_iva_index', methods: ['GET'])]
    public function index(TipoIvaRepository $tipoIvaRepository): Response
    {
        return $this->render('tipo_iva/index.html.twig', [
            'tipo_ivas' => $tipoIvaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'tipo_iva_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tipoIva = new TipoIva();
        $form = $this->createForm(TipoIvaType::class, $tipoIva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tipoIva);
            $entityManager->flush();

            return $this->redirectToRoute('tipo_iva_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tipo_iva/new.html.twig', [
            'tipo_iva' => $tipoIva,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'tipo_iva_show', methods: ['GET'])]
    public function show(TipoIva $tipoIva): Response
    {
        return $this->render('tipo_iva/show.html.twig', [
            'tipo_iva' => $tipoIva,
        ]);
    }

    #[Route('/{id}/edit', name: 'tipo_iva_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TipoIva $tipoIva, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TipoIvaType::class, $tipoIva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('tipo_iva_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tipo_iva/edit.html.twig', [
            'tipo_iva' => $tipoIva,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'tipo_iva_delete', methods: ['POST'])]
    public function delete(Request $request, TipoIva $tipoIva, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoIva->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tipoIva);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tipo_iva_index', [], Response::HTTP_SEE_OTHER);
    }
}
