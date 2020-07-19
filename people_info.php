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
          
      }

    }else {
          echo "0 results";
        }//end else

    ?>

  </div>
  <?php include("./footer.php"); ?>