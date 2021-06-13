<?php

  include "dbcon.php";


if(isset($_POST['action']) && !empty($_POST['action'])) {

    $action = $_POST['action'];
    switch($action) {
       
        case 'listefacture' : listefacture($conn);break;
        case 'sommefacture' : sommefacture($conn);break;
        case 'affichagedate': affichagedate();break;
        case 'deletefacture': deletefacture($conn);break;
    }   
  }


  function listefacture($conn){
    $modele_id = $_POST['$modeles_id'];
    $idfacture = $_POST ['$idfactures'];
     // $sql = "SELECT id , modele_id , idfacture ,prixtotale , prix_totale_energie , prix_totale_matiere , prix_totale_accessoire , nombre_employer ,salaire_employer  FROM facture WHERE facture.modele_id= $modele_id  AND facture.idfacture = $idfacture  ";
      $sql = "SELECT id , modele_id , idfacture , SUM(prixtotale) AS Sprixtotal , SUM(prix_totale_energie) AS Sprix_totale_energie, SUM( prix_totale_matiere) AS Sprix_totale_matiere, SUM(prix_totale_accessoire) AS Sprix_totale_accessoire , nombre_employer ,salaire_employer  FROM facture WHERE facture.modele_id= $modele_id  AND facture.idfacture = $idfacture  ";
  //  $sql = "SELECT  reference_tmg FROM facture  AS F  INNER JOIN modele AS M ON F.modele_id = M.id WHERE F.modele_id= $modele_id  AND M.id= $modele_id  ";
  // $sql = "SELECT id , idfacture , modele_id ,reference_tmg FROM facture F, Modele M   WHERE F.modele_id =  $modele_id AND 
      //                                                                                          M.id = $modele_id  ";
      
  
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                   $variable = $row['nombre_employer']*$row['salaire_employer'];
               echo "<tr>
                       <td>".$row['Sprixtotal']."</td>
                       <td>".$row['Sprix_totale_energie']."</td>
                       <td>".$row['Sprix_totale_matiere']."</td>
                       <td>".$row['Sprix_totale_accessoire']."</td>
                       <td>".$variable."</td>
                      
                    </tr>" ;
                   
                    
                } echo "done";
            }
            else{
                echo "you need to add modeles  .";
                echo "non";
    
            }
        }
       
    
        
        }
        function sommefacture($conn){
          $modele_id = $_POST['$modeles_id'];
          $idfacture = $_POST ['$idfactures'];
           // $sql = "SELECT id , modele_id , idfacture ,prixtotale , prix_totale_energie , prix_totale_matiere , prix_totale_accessoire , nombre_employer ,salaire_employer  FROM facture WHERE facture.modele_id= $modele_id  AND facture.idfacture = $idfacture  ";
            $sql = "SELECT id , modele_id , idfacture , SUM(prixtotale) AS Sprixtotal , SUM(prix_totale_energie) AS Sprix_totale_energie, SUM( prix_totale_matiere) AS Sprix_totale_matiere, SUM(prix_totale_accessoire) AS Sprix_totale_accessoire , nombre_employer ,salaire_employer  FROM facture WHERE facture.modele_id= $modele_id  AND facture.idfacture = $idfacture  ";
        //  $sql = "SELECT  reference_tmg FROM facture  AS F  INNER JOIN modele AS M ON F.modele_id = M.id WHERE F.modele_id= $modele_id  AND M.id= $modele_id  ";
        // $sql = "SELECT id , idfacture , modele_id ,reference_tmg FROM facture F, Modele M   WHERE F.modele_id =  $modele_id AND 
            //                                                                                          M.id = $modele_id  ";
           // $row['Sprixtotal']+$row['Sprix_totale_energie']+$row['Sprix_totale_matiere']+$row['Sprix_totale_accessoire']+$variable 
            
        
              if ($result = mysqli_query($conn , $sql)){
                  if(mysqli_num_rows($result) > 0){
                      while($row = $result->fetch_assoc()) {
                         $variable = $row['nombre_employer']*$row['salaire_employer'];
                    
                        $var=$row['Sprixtotal']+$row['Sprix_totale_energie']+$row['Sprix_totale_matiere']+$row['Sprix_totale_accessoire']+$variable  ;
                         echo  round($var,2);
                             
                         
                           
                           
                         
                          
                      } 
                  }
                  else{
                      echo "you need to add modeles  .";
                      echo "non";
          
                  }
              }
             
          
              
              }
        
   function affichagedate(){
    
    echo date ("F j, Y, g:i a");


   }

            function deletefacture($conn){

              $idfacture = $_POST['$idfactures'];
              $sql = "DELETE FROM facture WHERE facture.idfacture = $idfacture";

                    if ($result = mysqli_query($conn , $sql)){
                        if(mysqli_num_rows($result) > 0){
                         
                               
                           echo "deleted";
                                
                          
                        }
                        else{
                            echo "there is a prob .";
                            
                
                        }
                    }
                   




                          }

   ?>