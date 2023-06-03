<?php

include "dbcon.php";

    if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
       
        case 'recherche': recherche($conn);break;
        case 'rechercheacc': rechercheacc($conn);break;
        case 'rechercheener': rechercheener($conn);break;
        case 'recherchemat': recherchemat($conn);break;
        case 'rechercheout': rechercheout($conn);break;
        case 'recherchedem': recherchedem($conn);break;
        case 'recherchefac': recherchefac($conn);break;
        case 'rechercheuser': rechercheuser($conn);break;
        case 'recherchefile': recherchefile($conn);break;
        case 'rechercheplan': rechercheplan($conn);break;
        case 'recherchequa' : recherchequa($conn);break;
        case 'rechercherap' : rechercherap($conn);break;
        case 'recherchehis' : recherchehis($conn);break;
 

       }
    }

    function recherche($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM gamme_usinage where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["operation"]."</td> <td>".$row["machine"]."</td> <td>".$row["puissance_machine"]."</td>
                            <td>
                            <a href=\"./".$row["id"]."\">show</a>
                            <a href=\"./".$row["id"]."/edit\">edit</a>
                            </td>
                            </tr>";
                }
            }
            else{
                echo "no records found";
            }
            
            }
        }


    function rechercheacc($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM accessoire where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["reference_tmg"]."</td> <td>".$row["reference_bu"]."</td> <td>".$row["reference_mag"]."</td> <td>".$row["emplacement_mag"]."</td> <td>".$row["prix_a"]."</td>
                            <td>
                            <a href=\"./".$row["id"]."\">show</a>
                            <a href=\"./".$row["id"]."/edit\">edit</a>
                            </td>
                            </tr>";
                }
            }
            else{ echo "no records found";
    
            }
            
            }
        }
        function rechercheener($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM energie where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["nom"]."</td> <td>".$row["prix_h"]."</td> 
                            <td>
                            <a href=\"./".$row["id"]."\">show</a>
                            <a href=\"./".$row["id"]."/edit\">edit</a>
                            </td>
                            </tr>";
                }
            }
            else{ echo "no records found";
    
            }
            
            }
        }
   
   

        function recherchemat($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM matiere where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["nom"]."</td> <td>".$row["prix"]."</td> 
                            <td>
                            <a href=\"./".$row["id"]."\">show</a>
                            <a href=\"./".$row["id"]."/edit\">edit</a>
                            </td>
                            </tr>";
                }
            }
            else{ echo "no records found";
    
            }
            
            }
        }
   
        function rechercheout($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM outils where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["outil"]."</td> <td>".$row["duree_de_vie"]."</td> <td>".$row["prix_o"]."</td> <td>".$row["caracteristique"]."</td> 
                            <td>
                            <a href=\"./".$row["id"]."\">show</a>
                            <a href=\"./".$row["id"]."/edit\">edit</a>
                            </td>
                            </tr>";
                }
            }
            else{ echo "no records found";
    
            }
            
            }
        }
        
        
        
        
        
        function recherchedem($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM demande_o where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["responsable"]."</td> <td>".$row["reference_mag"]."</td> <td>".$row["ref_tmg"]."</td> <td>".$row["ref_bu"]."</td> <td>".$row["modele"]."</td><td>".$row["bu"]."</td> <td>".$row["type"]."</td><td>".$row["facture_id"]."</td> 
                            <td>
                            <a href=\"./".$row["id"]."\">show</a>
                            <a href=\"./".$row["id"]."/edit\">edit</a>
                            </td>
                            </tr>";
                }
            }
            else{ echo "no records found";
    
            }
            
            }
        }
        
        
        
        
        
        function recherchefac($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM facture where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["modele_id"]."</td> <td>".$row["idfacture"]."</td> 
                            <td>
                            <a href=\"./".$row["id"]."\">show</a>
                            <a href=\"./".$row["id"]."/edit\">edit</a>
                            </td>
                            </tr>";
                }
            }
            else{ echo "no records found";
    
            }
            
            }
        }
   
        function rechercheuser($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM user where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["email"]."</td> <td>".$row["roles"]."</td>  <td>***</td> <td>".$row["service"]."</td> <td>".$row["nom"]."</td><td>".$row["prenom"]."</td>
                            <td>
                            <a href=\"./".$row["id"]."\">show</a>
                            <a href=\"./".$row["id"]."/edit\">edit</a>
                            </td>
                            </tr>";
                }
            }
            else{ echo "no records found";
    
            }
            
            }
        }

        function recherchefile($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM form_data where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["file_names"]."</td> <td>".$row["reference_tmg"]."</td>  <td>".$row["description"]."</td> 
                            <td>
                            <a href=\"./".$row["id"]."\">show</a>
                            <a href=\"./".$row["id"]."/edit\">edit</a>
                            </td>
                            </tr>";
                }
            }
            else{ echo "no records found";
    
            }
            
            }
        }






        
        function rechercheplan($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM plan where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["reference_tmg"]."</td> <td>".$row["statut"]."</td>  <td>".$row["priorite"]."</td> 
                            <td>
                            <a href=\"./".$row["id"]."\">show</a>
                            <a href=\"./".$row["id"]."/edit\">edit</a>
                            </td>
                            </tr>";
                }
            }
            else{ echo "no records found";
    
            }
            
            }
        }


        function recherchequa($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM qualite_m where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["reference_tmg"]."</td> <td>Report</td>  <td>".$row["image"]."</td> 
                            <td>
                            <a href=\"./".$row["id"]."\">show</a>
                           
                            </td>
                            </tr>";
                }
            }
            else{ echo "no records found";
    
            }
            
            }
        }





        function rechercherap($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM rapport where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["titre"]."</td> <td>Report</td>  
                            <td>
                            <a href=\"./".$row["id"]."\">show</a>
                            <a href=\"./".$row["id"]."/edit\">edit</a>
                            </td>
                            </tr>";
                }
            }
            else{ echo "no records found";
    
            }
            
            }
        }


        
        function recherchehis($conn)

        {
           
        $nom = $_POST['$nom'];
        $option = $_POST['$option'];
        $sql = "SELECT * FROM history where $option = '$nom' ";
        if ($result = mysqli_query($conn , $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()) {
                    echo  " <tr> <td>".$row["id"]."</td> <td>".$row["message"]."</td> <td>".$row["date"]."</td>
                            <td>
                            
                            <a href=\"./".$row["id"]."/edit\"></a>
                            </td>
                            </tr>";
                }
            }
            else{ echo "no records found";
    
            }
            
            }
        }


?>