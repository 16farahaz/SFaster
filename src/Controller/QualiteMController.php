<?php

namespace App\Controller;

use App\Entity\History;
use App\Entity\QualiteM;
use App\Form\QualiteMType;
use Symfony\Component\Mercure\Update;
use App\Repository\QualiteMRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/qualite/m")
 */
class QualiteMController extends AbstractController
{
    /**
     * @IsGranted("ROLE_QUALITY")
     * @Route("/", name="qualite_m_index", methods={"GET"})
     */
    public function index(QualiteMRepository $qualiteMRepository): Response
    {
        return $this->render('qualite_m/index.html.twig', [
            'qualite_ms' => $qualiteMRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_QUALITY")
     * @Route("/new", name="qualite_m_new", methods={"GET","POST"})
     */
    public function new(Request $request,PublisherInterface $publisher): Response
    {
        $qualiteM = new QualiteM();
        $form = $this->createForm(QualiteMType::class, $qualiteM);
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid() ) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Created a new QualiteM.";
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->persist($qualiteM);
            $entityManager->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
            return $this->redirectToRoute('qualite_m_index');
        }

        return $this->render('qualite_m/new.html.twig', [
            'qualite_m' => $qualiteM,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_QUALITY")
     * @Route("/{id}", name="qualite_m_show", methods={"GET"})
     */
    public function show(QualiteM $qualiteM): Response
    {
        return $this->render('qualite_m/show.html.twig', [
            'qualite_m' => $qualiteM,
        ]);
    }

    /**
     * @IsGranted("ROLE_QUALITY")
     * @Route("/{id}/edit", name="qualite_m_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, QualiteM $qualiteM,PublisherInterface $publisher): Response
    {
        $form = $this->createForm(QualiteMType::class, $qualiteM);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Modified QualiteM Number: ".$qualiteM->getId();
            $history->setMessage($msg);
            $this->getDoctrine()->getManager()->persist($history);
            
            $this->getDoctrine()->getManager()->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
            return $this->redirectToRoute('qualite_m_index');
        }

        return $this->render('qualite_m/edit.html.twig', [
            'qualite_m' => $qualiteM,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_QUALITY")
     * @Route("/{id}", name="qualite_m_delete", methods={"POST"})
     */
    public function delete(Request $request, QualiteM $qualiteM,PublisherInterface $publisher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$qualiteM->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            
            $history = new History();
            $msg=$this->getUser()->getFullName(). " Deleted QualiteM number: ".$qualiteM->getid();
            $history->setMessage($msg);
            $entityManager->persist($history);

            $entityManager->remove($qualiteM);
            $entityManager->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
        }

        return $this->redirectToRoute('qualite_m_index');
    }
}
