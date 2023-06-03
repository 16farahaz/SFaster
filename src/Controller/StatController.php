<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Matiere;
use App\Repository\DemandeORepository;
use App\Repository\MatiereRepository;

class StatController extends AbstractController
{
    /**
     * @Route("/stat", name="stat")
     */
    public function statistiques(MatiereRepository $matrepo, DemandeORepository $demrepo)
    {
        //on va chercher tous les matieres.
        $matieres = $matrepo->findAll();
        $matnom=[];
        $matcolor=[];
        $matcount=[];

//on demonte les onnées pour les séparer tel qu'attendu par chartJS

        foreach($matieres as $matiere){
                    $matnom[]=$matiere->getNom();
                    $matcolor[]=$matiere->getColor();
                    $matcount[]=count($matiere-> getModeles());


        }



//on va chercher le nombre des demandes ajouté par  date 
    $demandes = $demrepo->countByDate();
    $dates=[];
    $demandesCount=[];
    foreach($demandes as $demande){


        $dates[]= $demande['date_demande'];
        $demandesCount[]= $demande['count'];



 }


       return $this-> render('stat/index.html.twig',[

             'matnom'=>json_encode($matnom),
             'matcolor'=>json_encode ($matcolor),
             'matcount'=> json_encode($matcount),
             'dates'=> json_encode($dates),
             'demandesCount'=> json_encode($demandesCount),

             


       ]);

    }
    

 
}

