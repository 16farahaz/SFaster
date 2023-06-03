<?php

namespace App\Controller;

use App\Entity\History;
use App\Entity\GammeUsinage;
use App\Form\GammeUsinageType;
use Symfony\Component\Mercure\Update;
use App\Repository\GammeUsinageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\PublisherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/gamme/usinage")
 */
class GammeUsinageController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="gamme_usinage_index", methods={"GET"})
     */
    public function index(GammeUsinageRepository $gammeUsinageRepository): Response
    {
        return $this->render('gamme_usinage/index.html.twig', [
            'gamme_usinages' => $gammeUsinageRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="gamme_usinage_new", methods={"GET","POST"})
     */
    public function new(Request $request,PublisherInterface $publisher): Response
    {
        $gammeUsinage = new GammeUsinage();
        $form = $this->createForm(GammeUsinageType::class, $gammeUsinage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Created a new GammeUsinage.";
            $history->setMessage($msg);
            $entityManager->persist($history);
            
            $entityManager->persist($gammeUsinage);
            $entityManager->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
            return $this->redirectToRoute('gamme_usinage_index');
        }

        return $this->render('gamme_usinage/new.html.twig', [
            'gamme_usinage' => $gammeUsinage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="gamme_usinage_show", methods={"GET"})
     */
    public function show(GammeUsinage $gammeUsinage): Response
    {
        return $this->render('gamme_usinage/show.html.twig', [
            'gamme_usinage' => $gammeUsinage,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="gamme_usinage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GammeUsinage $gammeUsinage,PublisherInterface $publisher): Response
    {
        $form = $this->createForm(GammeUsinageType::class, $gammeUsinage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Modified GammeUsinage Number: ".$gammeUsinage->getId();
            $history->setMessage($msg);
            $this->getDoctrine()->getManager()->persist($history);
            $this->getDoctrine()->getManager()->flush();

            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);

            return $this->redirectToRoute('gamme_usinage_index');
        }

        return $this->render('gamme_usinage/edit.html.twig', [
            'gamme_usinage' => $gammeUsinage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="gamme_usinage_delete", methods={"POST"})
     */
    public function delete(Request $request, GammeUsinage $gammeUsinage,PublisherInterface $publisher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gammeUsinage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Deleted GammeUsinage number: ".$gammeUsinage->getid();
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->remove($gammeUsinage);
            $entityManager->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
        }

        return $this->redirectToRoute('gamme_usinage_index');
    }
}
