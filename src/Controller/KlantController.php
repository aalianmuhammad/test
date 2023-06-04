<?php

namespace App\Controller;

use App\Entity\Mededelingen;
use App\Entity\Rijles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KlantController extends AbstractController
{
    #[Route('/klant', name: 'app_klant')]
    public function index(): Response
    {
        return $this->render('klant/index.html.twig', [
            'controller_name' => 'KlantController',
        ]);
    }

    #[Route('/klant/mededeling', name: 'app_klant_mededeling')]
    public function mededeling(EntityManagerInterface $entityManager): Response
    {
        $mededeling = $entityManager->getRepository(Mededelingen::class)->findBy(['rol' => 'klant']);
        return $this->render('klant/mededelingen.html.twig', [
            'controller_name' => 'KlantController',
            'mededeling' => $mededeling
        ]);
    }

    #[Route('/klant/rijles', name: 'app_klant_rijles')]
    public function rijles(): Response
    {
        $rijlessen = $this->getUser()->getRijles2();
        return $this->render('klant/rijles.html.twig', [
            'controller_name' => 'KlantController',
            'rijlessen' => $rijlessen
        ]);
    }

//    #[Route('/rijles', name: 'rijles')]
//    public function showRijles(EntityManagerInterface $entityManager): Response
//    {
//        $rijles = $entityManager->getRepository(Rijles::class)->findAll();
//
//        return $this->render('klant/rijles.html.twig', [
//            'rijles' => $rijles
//        ]);
//    }

//    #[Route('/detail/{id}', name: 'detail')]
//    public function detail(EntityManagerInterface $entityManager, int $id): Response
//    {
//        $rijles = $entityManager->getRepository(Rijles::class)->find($id);
//
//        return $this->render('home/detail.html.twig', [
//            'rijles' => $rijles
//
//        ]);
//
//    }
}
