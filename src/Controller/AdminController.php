<?php

namespace App\Controller;

use App\Entity\Mededelingen;
use App\Entity\User;
use App\Form\MededelingenType;
use App\Form\UserType;
use App\Repository\UserRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route ('/admin/beheren' , name: 'beheren')]
    public function beherenAction(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(User::class)->findInstructeur();

        return $this->render('admin/beheren.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $users
        ]);
    }

//    #[Route ('admin/beheren-user' , name: 'beheren-user')]
//    public function showUsers(EntityManagerInterface $entityManager): Response
//    {
//        $users = $entityManager->getRepository(User::class)->findAll();
//        return $this->render('admin/beheren.html.twig', [
//            'controller_name' => 'AdminController',
//            'users' => $users
//            ]);
//    }

    #[Route('/admin/beheren-detail/{id}', name: 'beheren-detail')]
    public function showUser(EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        //dd($user);

        return $this->render('admin/beheren-detail.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/admin/beheren-create', name: 'beheren-create')]
    public function createUser(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles((array)'ROLE_INSTRUCTEUR');
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Nieuwe user aangemaakt.'
            );
            return $this->redirectToRoute('beheren');
        }

        return $this->renderForm('admin/user-form.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin/beheren-edit/{id}', name: 'beheren-edit')]
    public function editUser(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash(
                'info',
                'User aangepast.'
            );
            return $this->redirectToRoute('beheren', ['id' => $id]);
        }

        return $this->renderForm('admin/user-form.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin/beheren-delete/{id}', name: 'beheren-delete')]
    public function deleteUser(EntityManagerInterface $entityManager, int $id){
        $user = $entityManager->getRepository(User::class)->find($id);
        $entityManager->remove($user);
        $entityManager->flush();
        $this->addFlash(
            'danger',
            'User verwijderd.'
        );

        return $this->redirectToRoute('beheren');
    }

//    #[Route ('/mededelingen' , name: 'mededelingen')]
//    public function mededelingen(): Response
//    {
//        return $this->render('admin/mededelingen.html.twig', [
//            'controller_name' => 'AdminController',
//        ]);
//    }

    #[Route ('mededelingen', name: 'mededelingen')]
    public function createMededelingen(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mededeling = new Mededelingen();
        $form = $this->createForm(MededelingenType::class, $mededeling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $mededeling = $form->getData();
            $entityManager->persist($mededeling);
            $entityManager->flush();
            $this->addFlash('success', 'De mededeling is aangemaakt');
            return $this->redirectToRoute('app_admin');
        }

        return $this->renderForm('admin/mededeling-form.html.twig', [
            'form' => $form
        ]);

    }
}
