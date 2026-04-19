<?php
  
  //replace the empty string with your database password
  @ $db = new mysqli('localhost', 'root', '', 'iit');
  
  if ($db->connect_error) {
    $connectErrors = array(
      'errors' => true,
      'errno'  => mysqli_connect_errno(),
      'error'  => mysqli_connect_error()
    );
    echo json_encode($connectErrors);
  } else {
    if (isset($_POST["id"])) {
      $movieId = (int) $_POST["id"];
      
      $query     = "DELETE FROM movies WHERE movieid = ?";
      $statement = $db->prepare($query);
      $statement->bind_param("i", $movieId);
      $statement->execute();
      
      $success = array('errors' => false, 'message' => 'Delete successful');
      echo json_encode($success);
      
      $statement->close();
      $db->close();
    } else {
      echo json_encode(array('errors' => true, 'message' => 'No ID provided'));
    }
  }
?>
