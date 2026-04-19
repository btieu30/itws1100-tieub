<?php
  
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
      $actorId = (int) $_POST["id"];
      
      $query     = "DELETE FROM actors WHERE actorid = ?";
      $statement = $db->prepare($query);
      $statement->bind_param("i", $actorId);
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
