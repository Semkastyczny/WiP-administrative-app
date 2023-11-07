<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserPosition;
use App\Form\UpdateFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager):Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '. $id
            );
        }

        if ($positionId = $request->query->get('idPosition', null)) {
            $position = $entityManager->getRepository(UserPosition::class)->findById($positionId);
            $user->setCategory($position);
        }

        $form = $this->createForm(UpdateFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute("homepage");

        }

        return $this->render('admin/edit.html.twig', [
            'updateForm' => $form->createView(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(int $id, EntityManagerInterface $entityManager):Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '. $id
            );
        }
        
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}