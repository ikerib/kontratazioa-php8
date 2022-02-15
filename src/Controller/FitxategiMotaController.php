<?php

namespace App\Controller;

use App\Entity\FitxategiMota;
use App\Form\FitxategiMotaType;
use App\Repository\FitxategiMotaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fitxategi/mota')]
class FitxategiMotaController extends AbstractController
{
    #[Route('/', name: 'fitxategi_mota_index', methods: ['GET'])]
    public function index(FitxategiMotaRepository $fitxategiMotaRepository): Response
    {
        return $this->render('fitxategi_mota/index.html.twig', [
            'fitxategi_motas' => $fitxategiMotaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'fitxategi_mota_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fitxategiMotum = new FitxategiMota();
        $form = $this->createForm(FitxategiMotaType::class, $fitxategiMotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fitxategiMotum);
            $entityManager->flush();

            return $this->redirectToRoute('fitxategi_mota_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fitxategi_mota/new.html.twig', [
            'fitxategi_motum' => $fitxategiMotum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'fitxategi_mota_show', methods: ['GET'])]
    public function show(FitxategiMota $fitxategiMotum): Response
    {
        return $this->render('fitxategi_mota/show.html.twig', [
            'fitxategi_motum' => $fitxategiMotum,
        ]);
    }

    #[Route('/{id}/edit', name: 'fitxategi_mota_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FitxategiMota $fitxategiMotum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FitxategiMotaType::class, $fitxategiMotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('fitxategi_mota_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fitxategi_mota/edit.html.twig', [
            'fitxategi_motum' => $fitxategiMotum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'fitxategi_mota_delete', methods: ['POST'])]
    public function delete(Request $request, FitxategiMota $fitxategiMotum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fitxategiMotum->getId(), $request->request->get('_token'))) {
            $entityManager->remove($fitxategiMotum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fitxategi_mota_index', [], Response::HTTP_SEE_OTHER);
    }
}
