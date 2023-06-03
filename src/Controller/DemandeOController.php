<?php

namespace App\Controller;

use App\Entity\History;
use App\Entity\DemandeO;
use App\Form\DemandeOType;
use Symfony\Component\Mercure\Update;
use App\Repository\DemandeORepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\PublisherInterface;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
    public function new(Request $request,PublisherInterface $publisher): Response
    {
        $demandeO = new DemandeO();
        $form = $this->createForm(DemandeOType::class, $demandeO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
              
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Created a new DemandeO.";
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->persist($demandeO);
            $entityManager->flush();

            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);


            return $this->redirectToRoute('demande_o_index');
        }

        return $this->render('demande_o/new.html.twig', [
            'demande_o' => $demandeO,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
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
    public function edit(Request $request, DemandeO $demandeO,PublisherInterface $publisher): Response
    {
        $form = $this->createForm(DemandeOType::class, $demandeO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $this->getDoctrine()->getManager()->flush();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Modified demandeO with Number: ".$demandeO->getId();
            $history->setMessage($msg);

            $this->getDoctrine()->getManager()->persist($history);
            $this->getDoctrine()->getManager()->flush();

            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);

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
    public function delete(Request $request, DemandeO $demandeO,PublisherInterface $publisher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeO->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Deleted demandeO number: ".$demandeO->getid();
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->remove($demandeO);
            $entityManager->flush();

            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);

        }


    
        return $this->redirectToRoute('demande_o_index');
    }
}
