<?php

namespace App\Controller;

use App\Entity\History;
use App\Entity\DemandeO;
use App\Entity\FormData;
use App\Form\FormDataType;
use Symfony\Component\Mercure\Update;
use App\Controller\DemandeOController;
use App\Repository\FormDataRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\PublisherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/form/data")
 */
class FormDataController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/", name="form_data_index", methods={"GET"})
     */
    public function index(FormDataRepository $formDataRepository): Response
    {
        return $this->render('form_data/index.html.twig', [
            'form_datas' => $formDataRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/new", name="form_data_new", methods={"GET","POST"})
     */
    public function new(Request $request,PublisherInterface $publisher): Response
    {
        $formDatum = new FormData();
        $form = $this->createForm(FormDataType::class, $formDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Created a new FormData.";
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->persist($formDatum);
            $entityManager->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);

            return $this->redirectToRoute('demande_o_new');
        }

        return $this->render('form_data/new.html.twig', [
            'form_datum' => $formDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="form_data_show", methods={"GET"})
     */
    public function show(FormData $formDatum): Response
    {
        return $this->render('form_data/show.html.twig', [
            'form_datum' => $formDatum,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}/edit", name="form_data_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FormData $formDatum,PublisherInterface $publisher): Response
    {
        $form = $this->createForm(FormDataType::class, $formDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Modified FormData Number: ".$formDatum->getId();
            $history->setMessage($msg);
            $this->getDoctrine()->getManager()->persist($history);

            $this->getDoctrine()->getManager()->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
            return $this->redirectToRoute('form_data_index');
        }

        return $this->render('form_data/edit.html.twig', [
            'form_datum' => $formDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="form_data_delete", methods={"POST"})
     */
    public function delete(Request $request, FormData $formDatum,PublisherInterface $publisher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formDatum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Deleted FormData number: ".$formDatum->getid();
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->remove($formDatum);
            $entityManager->flush();

            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
        

        }

        return $this->redirectToRoute('form_data_index');
    }
}
