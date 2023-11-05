<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     */
    public function index(ManagerRegistry $doctrine):Response
    {
        $userList = $doctrine->getRepository(User::class)->findAll();

        return $this->render('admin/list.html.twig', [
            'data' => $userList,
        ]);
    }

     /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(User $user, Request $request, EntityManager $entityManager):Response
    {
        
        $form = $this->createForm(RegistrationFormType::class, $user);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute("homepage");

        } else if ($form->isSubmitted()) {

            $this->addFlash(
                'error',
                'Your changes were not saved'
            );

        }


        return $this->render('admin/edit.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(User $user, EntityManager $entityManager):Response
    {
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}