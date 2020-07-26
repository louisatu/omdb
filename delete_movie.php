<?php

  $nav_selected = "MOVIE"; 
  $left_buttons = ""; 
  $left_selected = ""; 

  include("./nav.php");
  global $db;
  ?>

<div class="right-content">
    <div class="container">

      <h3 style = "color: #01B0F1;">Movie is deleted!</h3>
      <?php
        $sql = "DELETE FROM movies
        WHERE `movies`.`movie_id` = ".$_GET['movie_id'].";";
        $movie_result = $db->query($sql);
      ?>

    </div>
</div>

<?php include("./footer.php"); ?>