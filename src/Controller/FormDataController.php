<?php

namespace App\Controller;

use App\Entity\FormData;
use App\Entity\DemandeO;
use App\Controller\DemandeOController;
use App\Form\FormDataType;
use App\Repository\FormDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/form/data")
 */
class FormDataController extends AbstractController
{
    /**
     * @Route("/", name="form_data_index", methods={"GET"})
     */
    public function index(FormDataRepository $formDataRepository): Response
    {
        return $this->render('form_data/index.html.twig', [
            'form_datas' => $formDataRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="form_data_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formDatum = new FormData();
        $form = $this->createForm(FormDataType::class, $formDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formDatum);
            $entityManager->flush();

            return $this->redirectToRoute('demande_o_new');
        }

        return $this->render('form_data/new.html.twig', [
            'form_datum' => $formDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="form_data_show", methods={"GET"})
     */
    public function show(FormData $formDatum): Response
    {
        return $this->render('form_data/show.html.twig', [
            'form_datum' => $formDatum,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="form_data_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FormData $formDatum): Response
    {
        $form = $this->createForm(FormDataType::class, $formDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('form_data_index');
        }

        return $this->render('form_data/edit.html.twig', [
            'form_datum' => $formDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="form_data_delete", methods={"POST"})
     */
    public function delete(Request $request, FormData $formDatum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formDatum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formDatum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('form_data_index');
    }
}
