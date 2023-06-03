<?php

include "dbcon.php";


if(isset($_POST['action']) && !empty($_POST['action'])) {

  $action = $_POST['action'];
  switch($action) {
     
      case 'combolist_modele' : combolist_modele($conn);break;
      case 'ajouter_outil': ajouter_outil($conn);break;
      case 'code_action': code_action($conn);break;
      case 'combolist_outil' : combolist_outil($conn);break;
      case 'prix_outil': prix_outil($conn);break;
      case 'prix_totale': prix_totale($conn);break;
      case 'combolist_energie': combolist_energie($conn);break;
      case 'prix_energie': prix_energie($conn);break;
      case 'combolist_gamme_usinage': combolist_gamme_usinage($conn);break;
      case 'puissance_machine':  puissance_machine($conn);break;
      case 'prix_totale_energie_machine':   prix_totale_energie_machine();break;
      case 'prix_totale_matiere':  prix_totale_matiere();break;
      case 'combolist_matiere':  combolist_matiere($conn);break;
      case 'prix_matiere':  prix_matiere($conn);break;
      case 'combolist_accessoire': combolist_accessoire($conn);break;
      case 'prix_accessoire': prix_accessoire($conn);break;
      case 'prix_totale_accessoire': prix_totale_accessoire();break;
      case 'message':  message ();break;
      

  }   
}

function code_action($conn){
  // $today = ;
   $sql= "SELECT MAX(id) as max_id FROM facture";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {  
        $variable="00";
        $variable1="0";
        $variable2="000";

        if($row["max_id"] <10) {echo  date("Ymd").$variable2 . $row["max_id"] +1;}
      if ($row["max_id"] >9){
           echo  date("Ymd").  $variable. $row["max_id"] +1;
           }else{

           if ($row["max_id"] >99){


               echo  date("Ymd").  $variable1. $row["max_id"] +1;
           
               }
            }
       }




     } else {
       echo "0 results";
     }
   //  echo  date("Ymd") . $row["max_id"] +1;
    // echo date("Ymd")
}



  function combolist_modele($conn)
{
   $sql = "SELECT * FROM modele ";
   if ($result = mysqli_query($conn , $sql)){
       if(mysqli_num_rows($result) > 0){
           while($row = $result->fetch_assoc()) {
               echo  "<option modele_id=\"".$row["id"]."\">".$row["reference_tmg"]."</option>";
           }
       }
       else{
           echo "you need to add modeles .";

       }
   }
}
  
  






  function combolist_outil($conn)
  {
      $sql = "SELECT * FROM outils ";
      if ($result = mysqli_query($conn , $sql)){
          if(mysqli_num_rows($result) > 0){
              while($row = $result->fetch_assoc()) {
                  echo  "<option outil_id=\"".$row["id"]."\">".$row["outil"]."</option>";
                 
                  
              }
          }
          else{
              echo "you need to add modeles  .";
  
          }
      }
   }





   function prix_outil($conn)
  { $outil_id = $_POST['$outils_id'];
     

      $sql = "SELECT  prix_o  FROM outils Where id = $outil_id ";
      if ($result = mysqli_query($conn , $sql)){
          if(mysqli_num_rows($result) > 0){
              while($row = $result->fetch_assoc()) {
                echo $row["prix_o"];
              }
          }
          else{
              echo " error.";
  
          }
      }
   }








   function combolist_accessoire($conn)
  {
      $sql = "SELECT * FROM accessoire";
      if ($result = mysqli_query($conn , $sql)){
          if(mysqli_num_rows($result) > 0){
              while($row = $result->fetch_assoc()) {
                  echo  "<option accessoire_id=\"".$row["id"]."\">".$row["reference_tmg"]."</option>";
                 
                  
              }
          }
          else{
              echo "you need to add accessory  .";
  
          }
      }
   }




   
   function prix_accessoire($conn)
  { $accessoire_id = $_POST['$accessoires_id'];
     

      $sql = "SELECT  prix_a  FROM accessoire Where id = $accessoire_id ";
      if ($result = mysqli_query($conn , $sql)){
          if(mysqli_num_rows($result) > 0){
              while($row = $result->fetch_assoc()) {
                echo $row["prix_a"];
              }
          }
          else{
              echo " error.";
  
          }
      }
   }


   function prix_totale_accessoire()

   { $qa = $_POST['$qa'];
     $pa = $_POST['$pa'];
     
      echo ($pa*$qa);
       
    }






   function combolist_gamme_usinage($conn)
   {
       $sql = "SELECT * FROM gamme_usinage ";
       if ($result = mysqli_query($conn , $sql)){
           if(mysqli_num_rows($result) > 0){
               while($row = $result->fetch_assoc()) {
                   echo  "<option gamme_usinage_id=\"".$row["id"]."\">".$row["operation"]."</option>";
                  
                   
               }
           }
           else{
               echo "you need to add some energies used in the societe";
   
           }
       }
    }


    function combolist_matiere($conn)
  {
      $sql = "SELECT * FROM matiere ";
      if ($result = mysqli_query($conn , $sql)){
          if(mysqli_num_rows($result) > 0){
              while($row = $result->fetch_assoc()) {
                  echo  "<option matiere_id=\"".$row["id"]."\">".$row["nom"]."</option>";
                 
                  
              }
          }
          else{
              echo "you need to add modeles  .";
  
          }
      }
   }








   
   function prix_matiere($conn)
  { $matiere_id = $_POST['$matieres_id'];
     
      $sql = "SELECT  prix FROM matiere Where id = $matiere_id ";
      if ($result = mysqli_query($conn , $sql)){
          if(mysqli_num_rows($result) > 0){
              while($row = $result->fetch_assoc()) {
                echo $row["prix"];
              }
          }
          else{
              echo " error.";
  
          }
      }
   }



    function puissance_machine($conn)
    { $gamme_usinage_id = $_POST['$gamme_usinages_id'];
       

        $sql = "SELECT  puissance_machine  FROM gamme_usinage Where id =  $gamme_usinage_id ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                  echo $row["puissance_machine"];
                }
            }
            else{
                echo 102;
    
            }
        }
     }


function message (){

  echo " you can add other operation  to you invoice with the same form, please fill it again with the same way .If you complete click on complete button ";
}

   function combolist_energie($conn)
  {
      $sql = "SELECT * FROM energie ";
      if ($result = mysqli_query($conn , $sql)){
          if(mysqli_num_rows($result) > 0){
              while($row = $result->fetch_assoc()) {
                  echo  "<option energie_id=\"".$row["id"]."\">".$row["nom"]."</option>";
                 
                  
              }
          }
          else{
              echo "you need to add some energies used in the societe";
  
          }
      }
   }
   
   
   
   function prix_energie($conn)
   { $energie_id = $_POST['$energies_id'];


       $sql = "SELECT  prix_h  FROM energie Where id = $energie_id ";
       if ($result = mysqli_query($conn , $sql)){
           if(mysqli_num_rows($result) > 0){
               while($row = $result->fetch_assoc()) {
                 echo $row["prix_h"];
               }
           }
           else{
               echo " error.";
   
           }
       }
    }




   

   function prix_totale($conn)
   { $temps = $_POST['$temps'];
      $prix = $_POST['$prix'];
      $outils_id = $_POST['$outils_id'];

       $sql = "SELECT  duree_de_vie  FROM outils Where id = $outils_id ";
       if ($result = mysqli_query($conn , $sql)){
           if(mysqli_num_rows($result) > 0){
               while($row = $result->fetch_assoc()) {
                   if (($prix > 0)&&($temps> 0)){ echo   ($prix*$temps)/$row["duree_de_vie"];
                  }else {
                 echo  0;}
                 

               }
           }
           else{
               echo " error.";
   
           }
       }
    }
    





    function prix_totale_energie_machine()

   {  $temps = $_POST['$temps'];
      $prixenergies = $_POST['$prixenergies'];
      $puissancemachine=$_POST['$puissancemachine'];
      if (is_numeric($temps) && is_numeric($prixenergies) && is_numeric($puissancemachine)) {
          if ($temps>0) {
              $variable=(($temps*$puissancemachine)/60);
              echo($variable*$prixenergies) ;
          } else {
              echo 0 ;
          }
      }
else{     echo 0;}

    }

    function prix_totale_matiere()

    { $quantity = $_POST['$quantity'];
      $prixmatiere = $_POST['$prixmatiere'];

      if( is_numeric($quantity) && is_numeric($prixmatiere)){
          echo $prixmatiere*$quantity ;

      }   else      echo 0 ;
        
     }





   function ajouter_outil($conn)

   
   {
       $modele_id = $_POST['$modele_id'];
       $outil_id = $_POST['$outil_id'];
       $idfacture = $_POST['$idfacture'];
       $temps = $_POST['$temps'];
       $prix = $_POST['$prix'];
       $prixtotale = $_POST['$prixtotale'];
       $gamme_usinages_id = $_POST['$gamme_usinages_id'];
       $energie_id = $_POST['$energies_id'];
       $matieres_id = $_POST['$matieres_id'];
       $prixenergie = $_POST['$prixenergie'];
       $puissancemachine = $_POST['$puissancemachine'];
       $prixtotaleenergie = $_POST['$prixtotaleenergie'];
       $quantity = $_POST['$quantity'];
       $prixmatiere = $_POST['$prixmatiere'];
       $prixtotalematiere = $_POST['$prixtotalematiere'];
       $employer = $_POST['$employer'];
       $salaire = $_POST['$salaire'];
       $nbrpiece = $_POST['$nbrpiece'];
       $accessoire_id = $_POST['$accessoires_id'];
       $qa = $_POST['$qa'];
       $pa = $_POST['$pa'];
       $pta =  $_POST['$pta'];

       $sql = " INSERT INTO `facture` (`modele_id`, `outil_id`, `idfacture`, `prix_outil`, `temps`, `prixtotale`, `gamme_usinage_id`, `energie_id`, `matieres_id`, `prix_energie`, `puissance_machine`, `prix_totale_energie`, `quantity`, `prix_matiere`, `prix_totale_matiere`, `nombre_employer`, `salaire_employer`, `nombre_piece`, `accessoire_id`, `prix_accessoire`, `quantite_accessoire`, `prix_totale_accessoire`)
           VALUES ( $modele_id , $outil_id , $idfacture , $prix , $temps ,  $prixtotale , $gamme_usinages_id , $energie_id , $matieres_id , $prixenergie , $puissancemachine , $prixtotaleenergie , $quantity , $prixmatiere , $prixtotalematiere , $employer , $salaire , $nbrpiece ,  $accessoire_id , $pa , $qa , $pta  ) " ;

       if ($conn->query( $sql ) === TRUE) {
            echo "success !!" ; 
            

       } else {
           echo "$modele_id,$outil_id,$idfacture,$temps,$temps,$prixtotale,$gamme_usinages_id , $energie_id , $matieres_id , $prixenergie , $puissancemachine , $prixtotaleenergie , $quantity , $prixmatiere , $prixtotalematiere , $employer , $salaire , $nbrpiece , $accessoire_id ,$pa , $qa , $pta  " ;
           
            echo "please try again !!";
               }
            

    } 

?>