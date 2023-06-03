<?php

namespace App\Controller;

use App\Entity\History;
use App\Form\HistoryType;
use App\Repository\HistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/history")
 */
class HistoryController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="history_index", methods={"GET"})
     */
    public function index(HistoryRepository $historyRepository): Response
    {
        return $this->render('history/index.html.twig', [
            'logs' => $historyRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="history_delete", methods={"POST"})
     */
    public function delete(Request $request, History $history): Response
    {
        if ($this->isCsrfTokenValid('delete'.$history->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($history);
            $entityManager->flush();
        }

        return $this->redirectToRoute('history_index');
    }
}
