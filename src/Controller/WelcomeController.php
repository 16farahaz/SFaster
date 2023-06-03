<?php

namespace App\Controller;

use App\Repository\HistoryRepository;
use Symfony\Component\WebLink\Link;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class WelcomeController extends AbstractController
{

    /**
     * @Route("/discover", name="discover")
     */
    public function discover(Request $request)
    {
        $hubUrl = $this->getParameter('mercure.default_hub');
        $this->addLink($request, new Link('mercure', $hubUrl));
        return $this->json(["OK"]);
    }
 

    /**
     * @Route("/welcome", name="welcome")
     */
    public function index(): Response
    {
        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
        ]);
    }
}
