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
                        <th>People_id</th>
                        <th>Stage Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Image Name</th>
                        <th>Action</th>
                        

                </tr>
              </thead>

              <tfoot>
                <tr>
                        <th>People_id</th>
                        <th>Stage Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Image Name</th>
                        <th>Action</th>

                </tr>
              </tfoot>

              <tbody>

              <?php

$sql = "SELECT people.id as id, people.stage_name as stage_name, people.first_name as first_name, people.middle_name as middle_name, people.last_name as last_name, people.gender as gender, people.image_name as image_name from people" ;
$result = $db->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td>'.$row["id"].'</td>
                                <td>'.$row["stage_name"].'</td>
                                <td>'.$row["first_name"].'</td>
                                <td>'.$row["middle_name"].'</td>
                                <td>'.$row["last_name"].'</td>
                                <td>'.$row["gender"].'</td>
                                <td>'.$row["image_name"].'</td>
                                 
                                <td><a class="btn btn-info btn-sm" href="movie_info.php?id='.$row["id"].'">Display</a>
                                <a class="btn btn-warning btn-sm" href="modify_movie.php?movie_id='.$row["id"].'">Modify</a>
                                <a class="btn btn-danger btn-sm" href="delete_movie.php?movie_id='.$row["id"].'">Delete</a></td>
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