<?php

namespace App\Controller;

use App\Entity\DemandeO;
use App\Form\DemandeOType;
use App\Repository\DemandeORepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/demande/o")
 */
class DemandeOController extends AbstractController
{
    /**
     * @Route("/", name="demande_o_index", methods={"GET"})
     */
    public function index(DemandeORepository $demandeORepository): Response
    {
        return $this->render('demande_o/index.html.twig', [
            'demande_os' => $demandeORepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="demande_o_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $demandeO = new DemandeO();
        $form = $this->createForm(DemandeOType::class, $demandeO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
              
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($demandeO);
            $entityManager->flush();

            return $this->redirectToRoute('demande_o_index');
        }

        return $this->render('demande_o/new.html.twig', [
            'demande_o' => $demandeO,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="demande_o_show", methods={"GET"})
     */
    public function show(DemandeO $demandeO): Response
    {
        return $this->render('demande_o/show.html.twig', [
            'demande_o' => $demandeO,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="demande_o_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DemandeO $demandeO): Response
    {
        $form = $this->createForm(DemandeOType::class, $demandeO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demande_o_index');
        }

        return $this->render('demande_o/edit.html.twig', [
            'demande_o' => $demandeO,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="demande_o_delete", methods={"POST"})
     */
    public function delete(Request $request, DemandeO $demandeO): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeO->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($demandeO);
            $entityManager->flush();
        }

        return $this->redirectToRoute('demande_o_index');
    }
}
