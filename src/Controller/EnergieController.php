<?php

namespace App\Controller;

use App\Entity\Energie;
use App\Form\EnergieType;
use App\Repository\EnergieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/energie")
 */
class EnergieController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="energie_index", methods={"GET"})
     */
    public function index(EnergieRepository $energieRepository): Response
    {
        return $this->render('energie/index.html.twig', [
            'energies' => $energieRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="energie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $energie = new Energie();
        $form = $this->createForm(EnergieType::class, $energie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($energie);
            $entityManager->flush();

            return $this->redirectToRoute('energie_index');
        }

        return $this->render('energie/new.html.twig', [
            'energie' => $energie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="energie_show", methods={"GET"})
     */
    public function show(Energie $energie): Response
    {
        return $this->render('energie/show.html.twig', [
            'energie' => $energie,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="energie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Energie $energie): Response
    {
        $form = $this->createForm(EnergieType::class, $energie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('energie_index');
        }

        return $this->render('energie/edit.html.twig', [
            'energie' => $energie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="energie_delete", methods={"POST"})
     */
    public function delete(Request $request, Energie $energie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$energie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($energie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('energie_index');
    }
}
