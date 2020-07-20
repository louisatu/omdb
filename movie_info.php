<?php

  $nav_selected = "MOVIE"; 
  $left_buttons = ""; 
  $left_selected = ""; 

  include("./nav.php");
  global $db;
  ?>


<div class="right-content">
    <div class="container">

      <h3 style = "color: #01B0F1;">Movie</h3>

      <?php

        $sql = "SELECT `movies`.*, `movie_data`.* 
        FROM `movies` INNER JOIN `movie_data` ON(`movies`.`movie_id` = `movie_data`.`movie_id`) 
        WHERE `movies`.`movie_id` = ".$_GET['id'].";";
        $movie_result = $db->query($sql);
        if ($movie_result->num_rows == 1) {
          // output data of each row
          $row = $movie_result->fetch_assoc();
          echo "<p>Name: ".$row["native_name"]."</p>";
          echo "<p>English Name: ".$row["english_name"]."</p>";
          echo "<p>Year Made: ".$row["year_made"]."</p>";

          echo "<h3 style = 'color: #01B0F1;'>Movie Data</h3>";
          echo "<p>Language: ".$row["language"]."</p>";
          echo "<p>Country: ".$row["country"]."</p>";
          echo "<p>Genre: ".$row["genre"]."</p>";
          echo "<p>Plot: ".$row["plot"]."</p>";
          

          $sql = "SELECT movie_trivia from movie_trivia WHERE `movie_trivia`.`movie_id` = ".$_GET['id'].";";
          $trivia_result = $db->query($sql);
          $trivia_string = "";
          while($row = $trivia_result->fetch_assoc()){
            $trivia_string .= "<p>".$row["movie_trivia"]."</p>";
          }
          if(strlen($trivia_string) > 0)
            echo "<p>Trivia:</p>".$trivia_string;

          $sql = "SELECT keyword from movie_keywords WHERE `movie_keywords`.`movie_id` = ".$_GET['id'].";";
          $keyword_result = $db->query($sql);
          // $keyword_string will store the resulting string after reading the db data
          $keyword_string = "";
          while($row = $keyword_result->fetch_assoc()){
            // For each keyword received from our query
            if(strlen($keyword_string) > 0){
              // If there is already a keyword in our string, put a comma and space between them
              $keyword_string .= ", ";
            }
            // Append the next keyword to our string
            $keyword_string .= $row["keyword"];
          }
          if(strlen($keyword_string) > 0){
            // If there are any keywords, display them in a paragraph
            echo "<p>Keyword: ".$keyword_string."</p>";
          }
          
          echo "<h3 style = 'color: #01B0F1;'>People</h3>";

          $sql = "SELECT `people`.`first_name`,`people`.`last_name`, `movie_people`.`role` 

          FROM `people`, `movie_people` 
          WHERE `movie_people`.`movie_id` = ".$_GET['id']." AND `movie_people`.`people_id` = `people`.`id` ";
          $people_arrays = [
            "director" => [],
            "producer" => [],
            "music director" => [],
            "lead actor" => [],
            "lead actress" => [],
            "actor" => [],

            "actress" => [],
            "supporting actor" => []  
          ];
          $people_result = $db->query($sql);
          while($people_row = $people_result->fetch_assoc()){
         
            $role = strtolower($people_row['role']);
            if(array_key_exists($role, $people_arrays))
              array_push($people_arrays[$role], $people_row['first_name']." ".$people_row['last_name']);
            else
             
              echo "<p>Unrecognized people role '".$role.
                  "' for person '".$people_row['first_name']." ".$people_row['last_name']."'</p>";

          }

          echo "<p>Director(s): ".implode($people_arrays["director"], ", ")."</p>";
          echo "<p>Producer(s): ".implode($people_arrays["producer"], ", ")."</p>";
          echo "<p>Music Director(s): ".implode($people_arrays["music director"], ", ")."</p>";
          echo "<p>Lead Actor: ".implode($people_arrays["lead actor"], ", ")."</p>";
          echo "<p>Lead Actress: ".implode($people_arrays["lead actress"], ", ")."</p>";
          echo "<p>Actor(s): ".implode($people_arrays["actor"], ", ")."</p>";
          echo "<p>Actress(s): ".implode($people_arrays["actress"], ", ")."</p>";
          echo "<p>Supporting Actor(s): ".implode($people_arrays["supporting actor"], ", ")."</p>";

          echo "<h3 style = 'color: #01B0F1;'>Songs</h3>";
          $sql = "SELECT `songs`.`title`, `songs`.`lyrics`, `songs`.`song_id`
          FROM `songs`, `movie_song` 
          WHERE `movie_song`.`movie_id` = ".$_GET['id']." AND `movie_song`.`song_id` = `songs`.`song_id`;";
          $songs_result = $db->query($sql);
          while($songs_row = $songs_result->fetch_assoc()){
            
            echo "<h3 style = 'color: #01B0F1;'>".$songs_row["title"]."</h3>";
            echo "<p>Lyrics: ".$songs_row["lyrics"]."</p>";
            $sql = "SELECT `people`.`first_name`, `people`.`last_name`, `song_people`.`role` 

            FROM `people`, `song_people` 
            WHERE `song_people`.`song_id` = ".$songs_row['song_id']." AND 
            `song_people`.`people_id` = `people`.`id`;";
            $people_arrays = [
              "lyricist" => [],
              "playback singer" => []
            ];
            $people_result = $db->query($sql);
            while($people_row = $people_result->fetch_assoc()){

              
              $role = strtolower($people_row['role']);
              if(array_key_exists($role, $people_arrays))
                array_push($people_arrays[$role], $people_row['first_name']." ".$people_row['last_name']);
              else
                
                echo "<p>Unrecognized people role '".$role.
                    "' for person '".$people_row['first_name']."'</p>";
            }
            echo "<p>Lyricist: ".implode($people_arrays["lyricist"], ", ")."</p>";
            echo "<p>Playback Singer(s): ".implode($people_arrays["playback singer"], ", ")."</p>";

            $sql = "SELECT keyword FROM song_keywords 
            WHERE `song_keywords`.`song_id` = ".$songs_row['song_id'].";";
            $keyword_result = $db->query($sql);
            $keyword_string = "";
            while($row = $keyword_result->fetch_assoc()){
              if(strlen($keyword_string) > 0)
                $keyword_string .= ", ";
              $keyword_string .= $row["keyword"];
            }
            if(strlen($keyword_string) > 0)
              echo "<p>Song Keyword: ".$keyword_string."</p>";

            $sql = "SELECT `song_media`.`s_link`, `song_media`.`s_link_type` 
            FROM `song_media` 
            WHERE `song_media`.`song_id` = ".$songs_row['song_id'].";";
            $song_media_arrays = [
              "audio" => [],
              "video" => []
            ];
            $song_media_result = $db->query($sql);
            while($song_media_row = $song_media_result->fetch_assoc()){

              $link_type = strtolower($song_media_row['s_link_type']);
              if(array_key_exists($link_type, $song_media_arrays))
                array_push($song_media_arrays[$link_type], $song_media_row['s_link']);
              else

                echo "<p>Unrecognized song_media role '".$link_type.
                    "' for person '".$song_media_row['s_link']."'</p>";
            }
            if(count($song_media_arrays["audio"]) > 0){
              echo "<h4 style = 'color: #01B0F1;'>Audio</h4>";
              foreach($song_media_arrays["audio"] as $audio_link){
                echo '<iframe width="560" height="315" src="'.
                    $audio_link.
                    '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; 
                    gyroscope; picture-in-picture" allowfullscreen></iframe>';
              }
            }
            if(count($song_media_arrays["video"]) > 0){
              echo "<h4 style = 'color: #01B0F1;'>Video</h4>";
              foreach($song_media_arrays["video"] as $video_link){
                echo '<iframe width="560" height="315" src="'.
                    $video_link.
                    '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; 
                    gyroscope; picture-in-picture" allowfullscreen></iframe>';
              }
            }
          }

          $sql = "SELECT `movie_media`.`m_link`, `movie_media`.`m_link_type` 
          FROM `movie_media` 
          WHERE `movie_media`.`movie_id` = ".$_GET['id'].";";
          $movie_media_arrays = [
            "poster" => [],
            "image" => [],
            "video" => []
          ];
          $movie_media_result = $db->query($sql);
          while($movie_media_row = $movie_media_result->fetch_assoc()){

            $link_type = strtolower($movie_media_row['m_link_type']);
            if(array_key_exists($link_type, $movie_media_arrays))
              array_push($movie_media_arrays[$link_type], $movie_media_row['m_link']);
            else

              echo "<p>Unrecognized movie_media role '".$link_type.
                  "' for person '".$movie_media_row['m_link']."'</p>";
          }
          if(count($movie_media_arrays["poster"]) > 0){
            echo "<h4 style = 'color: #01B0F1;'>Posters</h4>";
            foreach($movie_media_arrays["poster"] as $media_link){
              echo '<img src="images/'.
                  $media_link.
                  '" ></img>';
            }
          }
          if(count($movie_media_arrays["image"]) > 0){
            echo "<h4 style = 'color: #01B0F1;'>Images</h4>";
            foreach($movie_media_arrays["image"] as $media_link){
              echo '<img src="images/'.
                  $media_link.
                  '" ></img>';
            }
          }
        }//end if
        else {
          echo "0 results";
        }//end else
      ?>

 <style>
   tfoot {
     display: table-header-group;
   }
 </style>


  <?php include("./footer.php"); ?>

