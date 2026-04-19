<?php 
  include('includes/init.inc.php');
  include('includes/functions.inc.php');
?>
<title>PHP &amp; MySQL - ITWS</title>   

<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>

<?php include('includes/menubody.inc.php'); ?>

<h3>Movies &amp; Their Actors</h3>

<?php
  $dbOk = false;

  //replace the empty string with your database password
  @ $db = new mysqli('localhost', 'root', '', 'iit');

  if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } else {
    $dbOk = true;
  }

  if ($dbOk) {
    $movieQuery  = 'SELECT * FROM movies ORDER BY title';
    $movieResult = $db->query($movieQuery);
    $numMovies   = $movieResult->num_rows;

    if ($numMovies == 0) {
      echo '<p>No movies found.</p>';
    } else {
      echo '<table id="moviesActorsTable">';
      echo '<tr><th>Title</th><th>Year</th><th>Actors</th></tr>';

      $i = 0;
      while ($movie = $movieResult->fetch_assoc()) {
        $movieId = (int) $movie['movieid'];

        $actorQuery = "SELECT a.first_names, a.last_name, a.dob FROM actors a
                       INNER JOIN actors_movies am ON a.actorid = am.actorid
                       WHERE am.movieid = ? ORDER BY a.last_name";
        $stmt = $db->prepare($actorQuery);
        $stmt->bind_param("i", $movieId);
        $stmt->execute();
        $actorResult = $stmt->get_result();

        if ($i % 2 == 0) {
          echo "\n".'<tr id="movie-row-' . $movieId . '">';
        } else {
          echo "\n".'<tr class="odd" id="movie-row-' . $movieId . '">';
        }

        echo '<td>' . htmlspecialchars($movie['title']) . '</td>';
        echo '<td>' . htmlspecialchars($movie['year'])  . '</td>';
        echo '<td>';

        if ($actorResult->num_rows == 0) {
          echo '<em>No actors listed</em>';
        } else {
          echo '<ul>';
          while ($actor = $actorResult->fetch_assoc()) {
            echo '<li>';
            echo htmlspecialchars($actor['last_name']) . ', ';
            echo htmlspecialchars($actor['first_names']);
            echo ' (' . htmlspecialchars($actor['dob']) . ')';
            echo '</li>';
          }
          echo '</ul>';
        }

        echo '</td></tr>';
        $actorResult->free();
        $stmt->close();
        $i++;
      }

      echo '</table>';
    }

    $movieResult->free();
    $db->close();
  }
?>

<?php include('includes/foot.inc.php'); ?>
