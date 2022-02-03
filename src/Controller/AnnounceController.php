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
     * @Route("/", name="annouce_index", methods={"GET"})
     */
    public function index(AnnounceRepository $announceRepository): Response
    {
        return $this->render('annouce/index.html.twig', [
            'announces' => $announceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="annouce_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $announce = new Announce();
        $form = $this->createForm(AnnounceType::class, $announce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($announce);
            $entityManager->flush();

            return $this->redirectToRoute('annouce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annouce/new.html.twig', [
            'announce' => $announce,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="annouce_show", methods={"GET"})
     */
    public function show(Announce $announce): Response
    {
        return $this->render('annouce/show.html.twig', [
            'announce' => $announce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="annouce_edit", methods={"GET", "POST"})
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
     * @Route("/{id}", name="annouce_delete", methods={"POST"})
     */
    public function delete(Request $request, Announce $announce, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$announce->getId(), $request->request->get('_token'))) {
            $entityManager->remove($announce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('annouce_index', [], Response::HTTP_SEE_OTHER);
    }
}
