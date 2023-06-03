<?php

include "dbcon.php";

    if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
       
        case 'ajoutplan': ajoutplan($conn);break;
        case 'affichage': affichage($conn);break;

    
       
       }
    }

  
    
    function ajoutplan($conn)

     
    {
        $tmgs = $_POST['$tmgs'];
        $datefin = $_POST['$datefin'];
      

        $sql = " INSERT INTO `plan` ( `reference_tmg`, `statut`, `priorite` , `datelim`) VALUES ( '$tmgs', 'Blocked','0','$datefin')";
 
        if ($conn->query( $sql ) === TRUE) {
             echo "success !!" ; 
             
 
        } else {
            echo "$tmgs,'en attent','0' " ;
            
             echo "please try again !!";
                }
             
 
     }
     


     function affichage($conn)

     {
        
     $sql = "SELECT * FROM plan ";
     if ($result = mysqli_query($conn , $sql)){
         if(mysqli_num_rows($result) > 0){
             while($row = $result->fetch_assoc()) {
                

                
                 echo  " <tr> <td>".$row["id"]."</td> <td>".$row["reference_tmg"]."</td> <td>".$row["statut"]."</td>  <td>".$row["priorite"]."</td> <td>".$row["datelim"]."</td> 
                         </tr>";
                         

                         
             
            }
         }

//$datefin = $_POST['$datefin'];
//$target = date();
//$interval = $origin->diff($target);
//echo $interval->format('%R%a days');





         else{ echo "no records found";
 
         }
         
         }
     }



    ?>