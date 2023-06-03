<?php

namespace App\Controller;

use App\Entity\History;
use App\Entity\Matiere;
use App\Form\MatiereType;
use App\Repository\MatiereRepository;
use Symfony\Component\Mercure\Update;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mercure\PublisherInterface;

/**
 * @Route("/matiere")
 */
class MatiereController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="matiere_index", methods={"GET"})
     */
    public function index(MatiereRepository $matiereRepository): Response
    {
        return $this->render('matiere/index.html.twig', [
            'matieres' => $matiereRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="matiere_new", methods={"GET","POST"})
     */
    public function new(Request $request,PublisherInterface $publisher): Response
    {
        $matiere = new Matiere();
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            
            $history = new History();
            $msg=$this->getUser()->getFullName(). " Created a new Matiere.";
            $history->setMessage($msg);
            $entityManager->persist($history);
            
            $entityManager->persist($matiere);
            $entityManager->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
            
            return $this->redirectToRoute('matiere_index');
        }

        return $this->render('matiere/new.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="matiere_show", methods={"GET"})
     */
    public function show(Matiere $matiere): Response
    {
        return $this->render('matiere/show.html.twig', [
            'matiere' => $matiere,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="matiere_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Matiere $matiere,PublisherInterface $publisher): Response
    {
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Modified Matiere Number: ".$matiere->getId();
            $history->setMessage($msg);
            $this->getDoctrine()->getManager()->persist($history);
            
            $this->getDoctrine()->getManager()->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
            

            return $this->redirectToRoute('matiere_index');
        }

        return $this->render('matiere/edit.html.twig', [
            'matiere' => $matiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="matiere_delete", methods={"POST"})
     */
    public function delete(Request $request, Matiere $matiere,PublisherInterface $publisher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Deleted Matiere number: ".$matiere->getid();
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->remove($matiere);
            $entityManager->flush();

            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
        }

        return $this->redirectToRoute('matiere_index');
    }
}
