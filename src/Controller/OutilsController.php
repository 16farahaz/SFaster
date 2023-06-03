<?php

namespace App\Controller;

use App\Entity\Outils;
use App\Entity\History;
use App\Form\OutilsType;
use App\Form\SearchAnnonceType;
use App\Repository\OutilsRepository;
use Symfony\Component\Mercure\Update;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\PublisherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/outils")
 */
class OutilsController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="outils_index", methods={"GET"})
     */
    public function index(OutilsRepository $outilsRepository , Request $request): Response
    {
        $form = $this->createForm(SearchAnnonceType::class);
        
        $search = $form->handleRequest($request);

        return $this->render('outils/index.html.twig', [
            'outils' => $outilsRepository->findAll(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="outils_new", methods={"GET","POST"})
     */
    public function new(Request $request,PublisherInterface $publisher): Response
    {
        $outil = new Outils();
        $form = $this->createForm(OutilsType::class, $outil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Created a new Outil.";
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->persist($outil);
            $entityManager->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
            return $this->redirectToRoute('outils_index');
        }

        return $this->render('outils/new.html.twig', [
            'outil' => $outil,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="outils_show", methods={"GET"})
     */
    public function show(Outils $outil): Response
    {
        return $this->render('outils/show.html.twig', [
            'outil' => $outil,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="outils_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Outils $outil,PublisherInterface $publisher): Response
    {
        $form = $this->createForm(OutilsType::class, $outil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Modified Outil Number: ".$outil->getId();
            $history->setMessage($msg);
            $this->getDoctrine()->getManager()->persist($history);

            $this->getDoctrine()->getManager()->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
            return $this->redirectToRoute('outils_index');
        }

        return $this->render('outils/edit.html.twig', [
            'outil' => $outil,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="outils_delete", methods={"POST"})
     */
    public function delete(Request $request, Outils $outil,PublisherInterface $publisher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$outil->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $history = new History();
            $msg=$this->getUser()->getFullName(). " Deleted Outil number: ".$outil->getid();
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->remove($outil);
            $entityManager->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
        }

        return $this->redirectToRoute('outils_index');
    }
}
