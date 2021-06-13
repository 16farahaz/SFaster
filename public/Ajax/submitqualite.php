<?php

  include "dbcon.php";



  $uploadDir = 'uploads/'; 
  $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
  $response = array( 
      'status' => 0, 
      'message' => 'Form submission failed, please try again.' 
  ); 
   
  // If form is submitted 
  $errMsg = ''; 
  $valid = 1; 
  if(isset($_POST['referencetmg']) || isset($_POST['description']) || isset($_POST['files']) ){ 
      // Get the submitted form data 
      $referencetmg = $_POST['referencetmg']; 
      $description = $_POST['description']; 
      $filesArr = $_FILES["files"]; 
       
      if(empty($referencetmg)){ 
          $valid = 0; 
          $errMsg .= '<br/>Please enter the reference of the model.'; 
      } 
       
      if(empty($description)){ 
          $valid = 0; 
          $errMsg .= '<br/>Please enter the description of the file .'; 
      } 
       
      // Check whether submitted data is not empty 
      if($valid == 1){ 
          $uploadStatus = 1; 
          $fileNames = array_filter($filesArr['name']); 
           
          // Upload file 
          $uploadedFile = ''; 
          if(!empty($fileNames)){  
              foreach($filesArr['name'] as $key=>$val){  
                  // File upload path  
                  $fileName = basename($filesArr['name'][$key]);  
                  $targetFilePath = $uploadDir . $fileName;  
                    
                  // Check whether file type is valid  
                  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                  if(in_array($fileType, $allowTypes)){  
                      // Upload file to server  
                      if(move_uploaded_file($filesArr["tmp_name"][$key], $targetFilePath)){  
                          $uploadedFile .= $fileName.','; 
                      }else{  
                          $uploadStatus = 0; 
                          $response['message'] = 'Sorry, there was an error uploading your file.'; 
                      }  
                  }else{  
                      $uploadStatus = 0; 
                      $response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
                  }  
              }  
          } 
           
          if($uploadStatus == 1){ 
              // Include the database config file 
              include_once 'dbcon.php'; 
               
              // Insert form data in the database 
              $uploadedFileStr = trim($uploadedFile, ','); 
              $insert = $conn->query("INSERT INTO `qualite_m` ( `reference_tmg`, `description`, `image`) VALUES ( '$referencetmg', '$description', '$uploadedFileStr');"); 
               
              if($insert){ 
                  $response['status'] = 1; 
                  $response['message'] = 'Form data submitted successfully!'; 
              } 
          } 
      }else{ 
           $response['message'] = 'Please fill all the mandatory fields!'.$errMsg; 
           echo" this is wrong";
      } 
  } 
   
  // Return response 
  echo json_encode($response);









  ?>