<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $userRepository = $managerRegistry->getRepository(User::class);
        $users = $userRepository->findAll();
        $announceRepository = $managerRegistry->getRepository(Announce::class);
        $announces = $announceRepository->findAll();
        return $this->render('home/index.html.twig', [
            'users' => $users,
            'announces' => $announces,
        ]);
    }
}
