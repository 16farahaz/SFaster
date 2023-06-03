<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Entity\History;
use App\Form\FactureType;
use App\Repository\FactureRepository;
use Symfony\Component\Mercure\Update;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\PublisherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/facture")
 */
class FactureController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="facture_index", methods={"GET"})
     */
    public function index(FactureRepository $factureRepository): Response
    {
        return $this->render('facture/index.html.twig', [
            'factures' => $factureRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="facture_new", methods={"GET","POST"})
     */
    public function new(Request $request,PublisherInterface $publisher): Response
    {
        $facture = new Facture();
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Created a new invoice.";
            $history->setMessage($msg);
            
            $entityManager->persist($history);
            $entityManager->persist($facture);
            $entityManager->flush();
            
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
            return $this->redirectToRoute('facture_index');
        }

        return $this->render('facture/new.html.twig', [
            'facture' => $facture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="facture_show", methods={"GET"})
     */
    public function show(Facture $facture): Response
    {
        return $this->render('facture/show.html.twig', [
            'facture' => $facture,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="facture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Facture $facture,PublisherInterface $publisher): Response
    {
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Modified facture Number: ".$facture->getId();
            $history->setMessage($msg);
            $this->getDoctrine()->getManager()->persist($history);

            $this->getDoctrine()->getManager()->flush();

            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);

            return $this->redirectToRoute('facture_index');
        }

        return $this->render('facture/edit.html.twig', [
            'facture' => $facture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="facture_delete", methods={"POST"})
     */
    public function delete(Request $request, Facture $facture,PublisherInterface $publisher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$facture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();


            $history = new History();
            $msg=$this->getUser()->getFullName(). " Deleted facture number: ".$facture->getid();
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->remove($facture);
            $entityManager->flush();

            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);

        }

        return $this->redirectToRoute('facture_index');
    }
}
