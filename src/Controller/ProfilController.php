<?php

namespace App\Controller;

use App\Form\ProfilType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
    /**
     * @Route("/profil/edit", name="profil_edit")
     */
    public function edit(Request $request)
    {
        $user=$this->getUser();
        $form = $this->createForm(ProfilType::class, $user);
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        

            $entityManager = $this->getDoctrine()->getManager();
           // $plainpwd = $user->getPassword();
           //  $encoded = $this->passwordEncoder->encodePassword($user, $plainpwd);
          //  $user->setPassword($encoded);         
        
            $this->addFlash('message','Profil mis à jour ' );
            $entityManager->persist($user);
            $entityManager->flush();
           

            return $this->redirectToRoute('profil');
        }

        return $this->render('profil/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
     /**
     * @Route("/profil/mdp", name="profilmdp")
     */
    public function modifiermotdepasse(Request $request ,UserPasswordEncoderInterface $passwordEncoder)
    {
       if($request ->isMethod('POST')){
        $entityManager = $this->getDoctrine()->getManager();
        $user=$this->getUser();   
            //nverifi ken les deux mot de pass kifkif
        if($request->request->get('pass')==$request->get('pass2')){

         $user->setPassword($passwordEncoder->encodePassword($user,$request->request->get('pass')));
         $entityManager->flush();
         $this->addFlash('message','Password changed with success');
         return $this->render('profil/index.html.twig');


        }else{$this->addFlash('error',  'please confirme the password' );}

       }
        return $this->render('profil/editpwd.html.twig');
    }


}
