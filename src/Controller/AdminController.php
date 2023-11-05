<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}