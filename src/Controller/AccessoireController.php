<?php

namespace App\Controller;

use App\Entity\History;
use App\Entity\Accessoire;
use App\Form\AccessoireType;
use Symfony\Component\Mercure\Update;
use App\Repository\AccessoireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\PublisherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/accessoire")
 */
class AccessoireController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="accessoire_index", methods={"GET"})
     */
    public function index(AccessoireRepository $accessoireRepository): Response
    {
        return $this->render('accessoire/index.html.twig', [
            'accessoires' => $accessoireRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="accessoire_new", methods={"GET","POST"})
     */
    public function new(Request $request,PublisherInterface $publisher): Response
    {
        $accessoire = new Accessoire();
        $form = $this->createForm(AccessoireType::class, $accessoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Created a new Accessoire.";
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->persist($accessoire);
            $entityManager->flush();

            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);


            return $this->redirectToRoute('accessoire_index');
        }

        return $this->render('accessoire/new.html.twig', [
            'accessoire' => $accessoire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="accessoire_show", methods={"GET"})
     */
    public function show(Accessoire $accessoire): Response
    {
        return $this->render('accessoire/show.html.twig', [
            'accessoire' => $accessoire,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="accessoire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Accessoire $accessoire,PublisherInterface $publisher): Response
    {
        $form = $this->createForm(AccessoireType::class, $accessoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Modified Accessoire Number: ".$accessoire->getId();
            $history->setMessage($msg);
            $this->getDoctrine()->getManager()->persist($history);

            $this->getDoctrine()->getManager()->flush();


            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);


            return $this->redirectToRoute('accessoire_index');
        }

        return $this->render('accessoire/edit.html.twig', [
            'accessoire' => $accessoire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="accessoire_delete", methods={"POST"})
     */
    public function delete(Request $request, Accessoire $accessoire,PublisherInterface $publisher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accessoire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Deleted Accessoire number: ".$accessoire->getid();
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->remove($accessoire);
            $entityManager->flush();
        
        
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
        
        
        }

        return $this->redirectToRoute('accessoire_index');
    }
}
