<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}

//require 'bin/functions.php';
require 'db_credentials.php';
//include('header.php');

$page_title = 'Movies > Create A Movie';
$page = "create_movie.php";
//verifyLogin($page);

?>
<?php
// here is the information to connect to the database
$mysqli = new MySQLi('localhost', 'root', '', 'omdb');
$resultset = $mysqli->query("SELECT DISTINCT topic FROM topics ORDER BY topic ASC");
?>

<div class="container">
    <style>
        #title {
            text-align: center;
            color: blue;
        }

        #guidance {
            color: grey;
            font-size: 10px;
        }
        body { 
            background: url('images/background_main.jpg') no-repeat fixed center;
            background-size: 100% 100%;
            background-color: white; 
        }
    </style>
    <!--Check the CeremonyCreated and if Failed, display the error message-->
    <?php
    // if(isset($_GET['createQuestion'])){
    //     if($_GET["createQuestion"] == "fileRealFailed"){
    //         echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not real, Please Try Again!</h3>';
    //     }
    // }
    // if(isset($_GET['createQuestion'])){
    //     if($_GET["createQuestion"] == "answerFailed"){
    //         echo '<br><h3 align="center" class="bg-danger">FAILURE - Your answer was not one of the choices, Please Try Again!</h3>';
    //     }
    // }
    // if(isset($_GET['createQuestion'])){
    //     if($_GET["createQuestion"] == "fileTypeFailed"){
    //         echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image is not a valid image type (jpg,jpeg,png,gif), Please Try Again!</h3>';
    //     }
    // }
    // if(isset($_GET['createQuestion'])){
    //     if($_GET["createQuestion"] == "fileExistFailed"){
    //         echo '<br><h3 align="center" class="bg-danger">FAILURE - Your image does not exist, Please Try Again!</h3>';
    //     }
    // }

    ?>
    <center>
    <form action="create_the_movie.php" method="POST" enctype="multipart/form-data">
        <br>
        <h3 id="title">Create A Movie</h3> <br>

        <div>
            <label>Native Name</label> <br>
            <input style=width:400px class="form-control" type="text" name="native_name" maxlength="100" size="50" required title="Please enter a name"></input>
        </div>

        <div>
            <label>English Name</label> <br>
            <input style=width:400px class="form-control" type="text" name="english_name" maxlength="100" size="50"></input>        </div>

        <div>
            <label>Year Made</label> <br>
            <input style=width:400px class="form-control" type="text" name="year_made" maxlength="100" size="50"></input>        </div>

        <div>
            <label>Tag Line </label> <br>
            <input style=width:400px class="form-control" type="text" name="tag_line" maxlength="100" size="50"></input>
        </div>
       
        <div>
            <label>Language </label> <br>
            <input style=width:400px class="form-control" type="text" name="language" maxlength="100" size="50"></input>
        </div>

        <div>
            <label>Country</label> <br>
            <input style=width:400px class="form-control" type="text" name="country" maxlength="100" size="50" required title="Please enter a type"></input>
        </div>

        <div>
            <label>Genre </label> <label id="guidance"> (Action, Comedy, Thriller, Horror, Documentary)</label> <br>
            <input style=width:400px class="form-control" type="text" name="genre" maxlength="100" size="50"></input>
        </div>

        <div>
            <label>Plot </label> <label id="guidance"></label> <br>
            <textarea style=width:400px class="form-control" name="plot" cols="55" rows="5" required title="Please enter plot description"></textarea>
        </div>
      
        <div>
            <label>Movie Trivia </label> <label id="guidance"></label> <br>
            <textarea style=width:400px class="form-control" name="movie_tivia" cols="55" rows="5" required title="Please enter plot description"></textarea>
        </div>

        <div>
            <label>Key Words</label> <br>
            <input style=width:400px class="form-control" type="text" name="keyword" maxlength="100" size="50" </input> </div> <div>
        </div>

        <div>
            <label>Quotes </label> <label id="guidance"></label> <br>
            <textarea style=width:400px class="form-control" name="movie_quote_name" cols="55" rows="5" required title="Please enter plot description"></textarea>
        </div>

        <div>
            <label>Image</label> <br>
            <input style=width:400px type="file" onchange="loadFile(event)" name="fileToUpload" id="fileToUpload" accept="image/jpg, image/jpeg, image/png" required title="Please enter an image file"></input><br>
            <img id="output" width="200" />
        </div>

        <div align="center" class="text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Create Movie</button>
        </div>
        <br> <br>

    </form>
    </center>
</div>

<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>