<?php

namespace App\Controller;

use App\Repository\KontratuaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(KontratuaRepository $kontratuaRepository): Response
    {

        return $this->render('default/index.html.twig', [

            'kontratuakAll' => $kontratuaRepository->countAll(),
            'kontratuakOpen' => $kontratuaRepository->countOpen(),
            'chart1' => $kontratuaRepository->countBySaila(),
            'chart2' => $kontratuaRepository->countByEgoera(),
            'chart3' => $kontratuaRepository->countByMota(),
            'chart4' => $kontratuaRepository->countByProzedura(),
            'chart5' => $kontratuaRepository->countByArduraduna(),
            'chart6' => $kontratuaRepository->countByYear(),

        ]);
    }
}
