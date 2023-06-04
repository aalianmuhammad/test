<?php

namespace App\Controller;

use App\Entity\Mededelingen;
use App\Entity\Rijles;
use App\Entity\User;
use App\Form\RijlesType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstructeurController extends AbstractController
{
    #[Route('/instructeur', name: 'app_instructeur')]
    public function index(): Response
    {
        return $this->render('instructeur/index.html.twig', [
            'controller_name' => 'InstructeurController',
        ]);
    }
    #[Route('/instructeur/mededeling', name: 'app_instructeur_mededeling')]
    public function mededeling(EntityManagerInterface $entityManager): Response
    {
        $mededeling = $entityManager->getRepository(Mededelingen::class)->findBy(['rol' => 'instructeur']);
        return $this->render('instructeur/mededeling-instructeur.html.twig', [
            'controller_name' => 'InstructeurController',
            'mededeling' => $mededeling
        ]);
    }

    #[Route('/instructeur/rijles', name: 'app_instructeur_rijles')]
    public function showRijlessen(EntityManagerInterface $entityManager): Response
    {
        $rijlessen = $entityManager->getRepository(Rijles::class)->findAll();

        return $this->render('instructeur/rijles.html.twig', [
            'controller_name' => 'InstructeurController',
            'rijlessen' => $rijlessen
        ]);
    }

    #[Route('/instructeur/rijles-detail/{id}', name: 'rijles-detail')]
    public function showRijles(EntityManagerInterface $entityManager, int $id): Response
    {
        $rijles = $entityManager->getRepository(Rijles::class)->find($id);
        //dd($rijles);

        return $this->render('instructeur/rijles-detail.html.twig', [
            'rijles' => $rijles
        ]);
    }

    #[Route('/instructeur/rijles-create', name: 'rijles-create')]
    public function createRijles(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rijles = new Rijles();

        $form = $this->createForm(RijlesType::class, $rijles);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $rijles = $form->getData();
            $rijles->setInstructeur($this->getUser());
            $entityManager->persist($rijles);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Nieuwe rijles aangemaakt.'
            );
            return $this->redirectToRoute('app_instructeur_rijles');
        }

        return $this->renderForm('instructeur/rijles-form.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/instructeur/rijles-edit/{id}', name: 'rijles-edit')]
    public function editRijles(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $rijles = $entityManager->getRepository(Rijles::class)->find($id);

        $form = $this->createForm(RijlesType::class, $rijles);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $rijles = $form->getData();
            $entityManager->persist($rijles);
            $entityManager->flush();
            $this->addFlash(
                'info',
                'Rijles aangepast.'
            );
            return $this->redirectToRoute('app_instructeur_rijles', ['id' => $id]);
        }

        return $this->renderForm('instructeur/rijles-form.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/instructeur/rijles-delete/{id}', name: 'rijles-delete')]
    public function deleteRijles(EntityManagerInterface $entityManager, int $id){
        $rijles = $entityManager->getRepository(Rijles::class)->find($id);
        $entityManager->remove($rijles);
        $entityManager->flush();
        $this->addFlash(
            'danger',
            'Rijles verwijderd.'
        );

        return $this->redirectToRoute('app_instructeur_rijles');
    }
}


