<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Form\AnnounceType;
use App\Repository\AnnounceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/annouce")
 */
class AnnounceController extends AbstractController
{
    /**
     * @Route("/", name="announce_index", methods={"GET"})
     */
    public function index(AnnounceRepository $announceRepository): Response
    {
        return $this->render('announce/index.html.twig', [
            'announces' => $announceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="announce_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $announce = new Announce();
        $form = $this->createForm(AnnounceType::class, $announce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($announce);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('announce/new.html.twig', [
            'announce' => $announce,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="announce_show", methods={"GET"})
     */
    public function show(Announce $announce): Response
    {
        return $this->render('announce/show.html.twig', [
            'announce' => $announce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="announce_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Announce $announce, EntityManagerInterface $entityManager): Response
    {
        $announce = New Announce();
        $form = $this->createForm(AnnounceType::class, $announce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($announce);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('announce/edit.html.twig', [
            'announce' => $announce,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="announce_delete", methods={"POST"})
     */
    public function delete(Request $request, Announce $announce, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$announce->getId(), $request->request->get('_token'))) {
            $entityManager->remove($announce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('announce_index', [], Response::HTTP_SEE_OTHER);
    }
}
