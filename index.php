
<!DOCTYPE html>

<?php

  // set the current page to one of the main buttons
  $nav_selected = "HOME";

  // make the left menu buttons visible; options: YES, NO
  $left_buttons = "NO";

  // set the left menu button selected; options will change based on the main selection
  $left_selected = "";

  include("./nav.php");
?>

<html>

<head>
<style>
table.center {
    margin-left:auto; 
    margin-right:auto;
  }
  body { 
  background: url('images/') no-repeat fixed center;
  background-size: 60% 70%;
  background-color: white; 
}
</style>
</head>

<body>
<center>
<h2 style = "color: #01B0F1;">Welcome to OMDB </h3>
</center>
</body>
</html>