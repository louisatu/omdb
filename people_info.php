<?php

$nav_selected = "PEOPLE";
$left_buttons = "";
$left_selected = "";

include("./nav.php");
global $db;
?>
<div class="right-content">
  <div class="container">

  <h3 style = "color: #01B0F1;">People Info</h3>


    <?php
    $sql = "SELECT first_name, middle_name, last_name, stage_name, gender, image_name FROM `people` WHERE `people`.`id` = " . $_GET['id'] . ";";
    $people_result = $db->query($sql);
    if($people_result->num_rows == 1){
      while($row = $people_result->fetch_assoc()){
      echo "<p>First Name: ".$row["first_name"]."</p>";
      echo "<p>Middle Name: ".$row["middle_name"]."</p>";
      echo "<p>Last Name: ".$row["last_name"]."</p>";
      echo "<p>Stage Name: ".$row["stage_name"]."</p>";
      echo "<p>Gender: ".$row["gender"]."</p>";
      echo '<img src="images/'.$row["image_name"].'" width="250px" ></img>';

      $sql = "SELECT
      (SELECT COUNT(*) FROM movie_people WHERE people_id = ".$_GET['id']." AND role LIKE '%act%') AS number_of_actor,
      (SELECT COUNT(*) FROM movie_people WHERE people_id = ".$_GET['id']." AND role LIKE '%director%') AS number_of_director,
      (SELECT COUNT(*) FROM movie_people WHERE people_id = ".$_GET['id']." AND role LIKE '%producer%') AS number_of_producer,
      (SELECT COUNT(*) FROM song_people WHERE people_id = ".$_GET['id']." AND role LIKE '%composer%') AS number_of_composer,
      (SELECT COUNT(*) FROM song_people WHERE people_id = ".$_GET['id']." AND role LIKE '%lyricist%') AS number_of_lyricist,
      (SELECT COUNT(*) FROM song_people WHERE people_id = ".$_GET['id']." AND role LIKE '%music director%') AS number_of_music_director;";
      $aggregation_result = $db->query($sql);
      if($aggregation_result->num_rows == 1){
        $aggregation_row = $aggregation_result->fetch_assoc();
        echo '<p>Number of movie actor roles: '.$aggregation_row['number_of_actor'].'</p>';
        echo '<p>Number of movie director roles: '.$aggregation_row['number_of_director'].'</p>';
        echo '<p>Number of movie producer roles: '.$aggregation_row['number_of_producer'].'</p>';
        echo '<p>Number of song composer roles: '.$aggregation_row['number_of_composer'].'</p>';
        echo '<p>Number of song lyricist roles: '.$aggregation_row['number_of_lyricist'].'</p>';
        echo '<p>Number of music director roles: '.$aggregation_row['number_of_music_director'].'</p>';
      }

      
      $sql = "SELECT movies.movie_id, movies.native_name, movies.english_name, movie_people.role, movie_people.screen_name 
        FROM movies, movie_people 
          WHERE movie_people.people_id = ".$_GET['id']." AND movies.movie_id = movie_people.movie_id;";
      $movies_result = $db->query($sql);
      if($movies_result->num_rows > 0){
        $movie_table = "<h1>Movies</h1><table><tr><table><tr><th style='width:200px;'>Movie ID</th>
        <th style='width:200px;'>Movie Name</th>
        <th style='width:200px;'>English Name</th>
        <th style='width:200px;'>Role</th>
        <th style='width:200px;'>Screen Name</th></tr>";

        while($movies_row = $movies_result->fetch_assoc()){
          $row_string = '<tr>';
          $row_string .= '<td>'.$movies_row['movie_id'].'</td>';
          $row_string .= '<td><a href="movie_info.php?id='.$movies_row['movie_id'].'">'.$movies_row['native_name'].'</a></td>';
          $row_string .= '<td>'.$movies_row['english_name'].'</td>';
          $row_string .= '<td>'.$movies_row['role'].'</td>';
          $row_string .= '<td>'.$movies_row['screen_name'].'</td>';
          $row_string .= '</tr>';
          $movie_table .= $row_string;
        }
        $movie_table .= "</table>";
        echo $movie_table;
      }
      $sql = "SELECT songs.song_id, songs.title, songs.lyrics, song_people.role 
      FROM songs, song_people 
      WHERE song_people.people_id = ".$_GET['id']." AND songs.song_id = song_people.song_id ";
      $movies_result = $db->query($sql);
      if($movies_result->num_rows > 0){
        $movie_table = "<h1>Songs</h1><table><tr><th style='width:200px;'>Song ID</th>
        <th style='width:200px;'>Song Title</th>
        <th style='width:200px;'>Song Lyrics</th>
        <th style='width:200px;'>Role</th></tr>";

        while($movies_row = $movies_result->fetch_assoc()){
          $row_string = '<tr>';
          $row_string .= '<td>'.$movies_row['song_id'].'</td>';
          $row_string .= '<td>'.$movies_row['title'].'</td>';
          $row_string .= '<td>'.substr($movies_row['lyrics'], 0, 30).'</td>';
          $row_string .= '<td>'.$movies_row['role'].'</td>';
          $row_string .= '</tr>';
          $movie_table .= $row_string;
        }
        $movie_table .= "</table>";
        echo $movie_table;
      }
    }
    }else {
      echo "0 results";
    }//end else

    ?>

  </div>
  <?php include("./footer.php"); ?>