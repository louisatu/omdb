<?php

  $nav_selected = "PEOPLE"; 
  $left_buttons = ""; 
  $left_selected = ""; 

  include("./nav.php");
  global $db;
  ?>


<div class="right-content">
    <div class="container">

    

      <h3 style = "color: #01B0F1;">People</h3>
      <button><a class="btn btn-sm" href="create_people.php">Create a Person</a></button>

        <table id="info" cellpadding="0" cellspacing="0" border="0"
            class="datatable table table-striped table-bordered datatable-style table-hover"
            width="100%" style="width: 100px;">
              <thead>
                <tr id="table-first-row">
                        <th>movie_id</th>
                        <th>Name</th>
                        <th>English Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Role</th>
                        <th>Action</th>
                        

                </tr>
              </thead>

              <tfoot>
                <tr>
                        <th>movie_id</th>
                        <th>Name</th>
                        <th>English Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Role</th>
                        <th>Action</th>

                </tr>
              </tfoot>

              <tbody>

              <?php

$sql = "SELECT movies.movie_id as movie_id, movies.native_name as native_name, movies.english_name as english_name, people.first_name as first_name, people.middle_name as middle_name, people.last_name as last_name, people.gender as gender, movie_people.role as role from movies join movie_people on (movie_people.movie_id = movies.movie_id) join people on (people.id = movie_people.people_id)" ;
$result = $db->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td>'.$row["movie_id"].'</td>
                                <td>'.$row["native_name"].' </span> </td>
                                <td>'.$row["english_name"].'</td>
                                <td>'.$row["first_name"].'</td>
                                <td>'.$row["middle_name"].'</td>
                                <td>'.$row["last_name"].'</td>
                                <td>'.$row["gender"].'</td>
                                <td>'.$row["role"].'</td>
                                 
                                <td><a class="btn btn-info btn-sm" href="movie_info.php?id='.$row["movie_id"].'">Display</a>
                                <a class="btn btn-warning btn-sm" href="modify_movie.php?movie_id='.$row["movie_id"].'">Modify</a>
                                <a class="btn btn-danger btn-sm" href="delete_movie.php?movie_id='.$row["movie_id"].'">Delete</a></td>
                            </tr>';
                    }//end while
                }//end if
                else {
                    echo "0 results";
                }//end else

                 $result->close();
               
                ?>

              </tbody>
        </table>


        <script type="text/javascript" language="javascript">
    $(document).ready( function () {
        
        $('#info').DataTable( {
            dom: 'lfrtBip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
        );

        $('#info thead tr').clone(true).appendTo( '#info thead' );
        $('#info thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    
        var table = $('#info').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );

</script>

        

 <style>
   tfoot {
     display: table-header-group;
   }

  body{
    background:url(background_main.jpg);
    background-size:80px 60px; it's not mandatory to give size.
    background-repeat:no repeat;
  }

 </style>

  <?php include("./footer.php"); ?>