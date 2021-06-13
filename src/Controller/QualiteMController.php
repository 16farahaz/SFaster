<?php

namespace App\Controller;

use App\Entity\QualiteM;
use App\Form\QualiteMType;
use App\Repository\QualiteMRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/qualite/m")
 */
class QualiteMController extends AbstractController
{
    /**
     * @Route("/", name="qualite_m_index", methods={"GET"})
     */
    public function index(QualiteMRepository $qualiteMRepository): Response
    {
        return $this->render('qualite_m/index.html.twig', [
            'qualite_ms' => $qualiteMRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="qualite_m_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $qualiteM = new QualiteM();
        $form = $this->createForm(QualiteMType::class, $qualiteM);
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid() ) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($qualiteM);
            $entityManager->flush();

            return $this->redirectToRoute('qualite_m_index');
        }

        return $this->render('qualite_m/new.html.twig', [
            'qualite_m' => $qualiteM,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="qualite_m_show", methods={"GET"})
     */
    public function show(QualiteM $qualiteM): Response
    {
        return $this->render('qualite_m/show.html.twig', [
            'qualite_m' => $qualiteM,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="qualite_m_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, QualiteM $qualiteM): Response
    {
        $form = $this->createForm(QualiteMType::class, $qualiteM);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('qualite_m_index');
        }

        return $this->render('qualite_m/edit.html.twig', [
            'qualite_m' => $qualiteM,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="qualite_m_delete", methods={"POST"})
     */
    public function delete(Request $request, QualiteM $qualiteM): Response
    {
        if ($this->isCsrfTokenValid('delete'.$qualiteM->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($qualiteM);
            $entityManager->flush();
        }

        return $this->redirectToRoute('qualite_m_index');
    }
}
