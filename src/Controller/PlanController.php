<?php

namespace App\Controller;

use App\Entity\Plan;
use App\Form\PlanType;
use App\Entity\History;
use App\Repository\PlanRepository;
use Symfony\Component\Mercure\Update;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/plan")
 */
class PlanController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/", name="plan_index", methods={"GET"})
     */
    public function index(PlanRepository $planRepository): Response
    {
        return $this->render('plan/index.html.twig', [
            'plans' => $planRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="plan_new", methods={"GET","POST"})
     */
    public function new(Request $request,PublisherInterface $publisher): Response
    {
        $plan = new Plan();
        $form = $this->createForm(PlanType::class, $plan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();


            $history = new History();
            $msg=$this->getUser()->getFullName(). " Created a new Plan.";
            $history->setMessage($msg);
            $entityManager->persist($history);
            
            $entityManager->persist($plan);
            $entityManager->flush();
            
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);

            return $this->redirectToRoute('plan_index');
        }

        return $this->render('plan/new.html.twig', [
            'plan' => $plan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="plan_show", methods={"GET"})
     */
    public function show(Plan $plan): Response
    {
        return $this->render('plan/show.html.twig', [
            'plan' => $plan,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="plan_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Plan $plan,PublisherInterface $publisher): Response
    {
        $form = $this->createForm(PlanType::class, $plan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Modified Plan Number: ".$plan->getId();
            $history->setMessage($msg);
            $this->getDoctrine()->getManager()->persist($history);

            $this->getDoctrine()->getManager()->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);
            return $this->redirectToRoute('plan_index');
        }

        return $this->render('plan/edit.html.twig', [
            'plan' => $plan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="plan_delete", methods={"POST"})
     */
    public function delete(Request $request, Plan $plan,PublisherInterface $publisher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $history = new History();
            $msg=$this->getUser()->getFullName(). " Deleted Plan number: ".$plan->getid();
            $history->setMessage($msg);
            $entityManager->persist($history);


            $entityManager->remove($plan);
            $entityManager->flush();
            $update = new Update(
                "notif",
                json_encode(['message' => $msg]),
                false
            );
            $publisher($update);


        }

        return $this->redirectToRoute('plan_index');
    }
}
