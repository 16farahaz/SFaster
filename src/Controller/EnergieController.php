<?php

namespace App\Controller;

use App\Entity\Energie;
use App\Entity\History;
use App\Form\EnergieType;
use App\Repository\EnergieRepository;
use Symfony\Component\Mercure\Update;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\PublisherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function new(Request $request,PublisherInterface $publisher): Response
    {
        $energie = new Energie();
        $form = $this->createForm(EnergieType::class, $energie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Created a new Energie.";
            $history->setMessage($msg);
            $entityManager->persist($history);


            $entityManager->persist($energie);
            $entityManager->flush();

            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
            
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
    public function edit(Request $request, Energie $energie,PublisherInterface $publisher): Response
    {
        $form = $this->createForm(EnergieType::class, $energie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Modified Energie Number: ".$energie->getId();
            $history->setMessage($msg);

            $this->getDoctrine()->getManager()->persist($history);
            $this->getDoctrine()->getManager()->flush();

            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);

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
    public function delete(Request $request, Energie $energie,PublisherInterface $publisher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$energie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            
            $history = new History();
            $msg=$this->getUser()->getFullName(). " Deleted Energie number: ".$energie->getid();
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->remove($energie);
            $entityManager->flush();


            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);


        }

        return $this->redirectToRoute('energie_index');
    }
}
