<?php

namespace App\Controller;
use App\Entity\Plan;
use App\Form\PlanType;
use App\Repository\PlanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class HomeController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/home", name="home")
     */
    public function index(PlanRepository $planRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'plans' => $planRepository->findAll(),
        ]);
    }
}

