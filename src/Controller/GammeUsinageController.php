<?php

namespace App\Controller;

use App\Entity\GammeUsinage;
use App\Form\GammeUsinageType;
use App\Repository\GammeUsinageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/gamme/usinage")
 */
class GammeUsinageController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="gamme_usinage_index", methods={"GET"})
     */
    public function index(GammeUsinageRepository $gammeUsinageRepository): Response
    {
        return $this->render('gamme_usinage/index.html.twig', [
            'gamme_usinages' => $gammeUsinageRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="gamme_usinage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gammeUsinage = new GammeUsinage();
        $form = $this->createForm(GammeUsinageType::class, $gammeUsinage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gammeUsinage);
            $entityManager->flush();

            return $this->redirectToRoute('gamme_usinage_index');
        }

        return $this->render('gamme_usinage/new.html.twig', [
            'gamme_usinage' => $gammeUsinage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="gamme_usinage_show", methods={"GET"})
     */
    public function show(GammeUsinage $gammeUsinage): Response
    {
        return $this->render('gamme_usinage/show.html.twig', [
            'gamme_usinage' => $gammeUsinage,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="gamme_usinage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GammeUsinage $gammeUsinage): Response
    {
        $form = $this->createForm(GammeUsinageType::class, $gammeUsinage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gamme_usinage_index');
        }

        return $this->render('gamme_usinage/edit.html.twig', [
            'gamme_usinage' => $gammeUsinage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="gamme_usinage_delete", methods={"POST"})
     */
    public function delete(Request $request, GammeUsinage $gammeUsinage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gammeUsinage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gammeUsinage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gamme_usinage_index');
    }
}
