<?php
  $nav_selected = "REPORTS";
  $left_buttons = "NO";
  $left_selected = "";

  include("./nav.php");
  global $db;
  
 ?>

 <div class="right-content">
    <div class="container">

      <table id="info" cellpadding="0" cellspacing="0" border="0"
            class="datatable table table-striped table-bordered datatable-style table-hover"
            width="100%" style="width: 200px;">
              <thead>
                <tr id="table-first-row">
                        <th>Year Made</th>
                        <th>Number of movies</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sql = "SELECT DISTINCT year_made, COUNT(*) as 'number of movies'FROM movies GROUP BY year_made;";
                  $result = $db->query($sql);
                  if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td>'.$row["year_made"].'</td>
                                <td>'.$row["number of movies"].'</td>
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


    
    </div>
</div>
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
