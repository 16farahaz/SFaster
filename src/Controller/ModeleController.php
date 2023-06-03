<?php

namespace App\Controller;

use App\Entity\Modele;
use App\Entity\History;
use App\Form\ModeleType;
use App\Repository\ModeleRepository;
use Symfony\Component\Mercure\Update;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\PublisherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/modele")
 */
class ModeleController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="modele_index", methods={"GET"})
     */
    public function index(ModeleRepository $modeleRepository): Response
    {
        return $this->render('modele/index.html.twig', [
            'modeles' => $modeleRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="modele_new", methods={"GET","POST"})
     */
    public function new(Request $request,PublisherInterface $publisher): Response
    {
        $modele = new Modele();
        $form = $this->createForm(ModeleType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Created a new Modele.";
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->persist($modele);
            $entityManager->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
            return $this->redirectToRoute('modele_index');
        }

        return $this->render('modele/new.html.twig', [
            'modele' => $modele,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="modele_show", methods={"GET"})
     */
    public function show(Modele $modele): Response
    {
        return $this->render('modele/show.html.twig', [
            'modele' => $modele,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="modele_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Modele $modele,PublisherInterface $publisher): Response
    {
        $form = $this->createForm(ModeleType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Modified Modele Number: ".$modele->getId();
            $history->setMessage($msg);
            $this->getDoctrine()->getManager()->persist($history);

            $this->getDoctrine()->getManager()->flush();

            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);

            return $this->redirectToRoute('modele_index');
        }

        return $this->render('modele/edit.html.twig', [
            'modele' => $modele,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="modele_delete", methods={"POST"})
     */
    public function delete(Request $request, Modele $modele,PublisherInterface $publisher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modele->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();


            $history = new History();
            $msg=$this->getUser()->getFullName(). " Deleted Modele number: ".$modele->getid();
            $history->setMessage($msg);
            $entityManager->persist($history);
            
            $entityManager->remove($modele);
            $entityManager->flush();

            
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
        }

        return $this->redirectToRoute('modele_index');
    }
}
