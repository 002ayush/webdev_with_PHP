<?php
    session_start();
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true){
        header("location:login.php");
        exit;
    }


     $servername = "localhost";
     $username = "root";
     $password = "";
     $database = "notes";
     
     //Create a connection
     $conn = mysqli_connect($servername,$username,$password,$database);
     $delete_post = FALSE;
     if (!$conn){
       //Die if connection was not successful
        die("Sorry we failed to connect: ".mysqli_connect_error());
     }
    if (isset($_GET['delete'])){
      $sno = $_GET['delete'];
      $sql = "DELETE FROM `notesdata` WHERE `S_NO` = $sno";
      $result = mysqli_query($conn,$sql);
      $delete_post = TRUE;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['snoEdit'])){
         
          //Updating the records
        $SNO = $_POST['snoEdit'];
       
        $topics = $_POST['titleEdit'];
    
        $des = $_POST['DescriptionEdit'];
        
        $sql = "UPDATE `notesdata` SET `Topic` = '$topics', `Description` = '$des' WHERE `S_No` = $SNO";
        $result = mysqli_query($conn,$sql);
       
        }
        else{



        
        $topics = $_POST['Topics'];
        $des = $_POST['Description'];
        $submit = $_POST['submit'];
        if (isset($submit)){
            $sql = "INSERT INTO `notesdata` (`Topic`, `Description`) VALUES ('$topics','$des')";
            $result = mysqli_query($conn,$sql);
        }
      }
    }
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web Development Project</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>

  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Edit Notes</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/ayush/Project_1.php" method="POST">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="mb-3">
              <label for="titleEdit" class="form-label" style="font-weight:bold; font-size:20px;">Topics</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" required>

            </div>
            <div class="mb-3">
              <label for="DescriptionEdit" class="form-label"
                style="font-weight:bold; font-size:20px;">Description</label>
              <textarea class="form-control" name="DescriptionEdit" id="DescriptionEdit" cols="20" rows="10"
                required></textarea>
            </div>


            <button type="submit" class="btn btn-primary" style="font-size:26px; font-weight:bold;text-align:center"
              name="submit">Update</button>
          </form>
        </div>
        <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">WebDevNotes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="contact.php">Contact Us</a>
          </li>
          
        </ul>
        <?php
            if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true){

              echo '
              <button type="submit" class="btn btn-outline-danger mx-2"><a class="text-decoration-none text-light" href="/webdev/login.php">Login</a></button>
              <button  type="submit" class="btn btn-outline-danger  " ><a class="text-decoration-none text-light" href="/webdev/signup.php">Sign Up</a></button>';
            }else{

              echo '
              <button type="submit" class="btn btn-outline-danger mx-2"><a class="text-decoration-none text-light" href="/webdev/logout.php">Logout</a></button>';
            }

        ?>
        
      </div>
    </div>
  </nav>
<?php  
      if ($delete_post){
        echo '
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong></strong> Post has been deleted!!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
      }

  ?>
  <div class="container my-5">
    <h2>Save your Web Development Notes</h2>
    <form action="/ayush/Project_1.php" method="POST">
      <div class="mb-3">
        <label for="Topics" class="form-label" style="font-weight:bold; font-size:20px;">Topics</label>
        <input type="text" class="form-control" id="Topics" name="Topics" required>

      </div>
      <div class="mb-3">
        <label for="Description" class="form-label" style="font-weight:bold; font-size:20px;">Description</label>
        <textarea class="form-control" name="Description" id="Description" cols="20" rows="10" required></textarea>
      </div>


      <button type="submit" class="btn btn-primary" style="font-size:26px; font-weight:bold;text-align:center"
        name="submit">Save</button>
    </form>



  </div>
  <hr>
  <div class="container my-4">

    <table class="table table-dark my-4" id="myTable">
      <thead>
        <tr class="my-4">

          <th scope="col">Days</th>
          <th scope="col">Topics</th>
          <th scope="col">Description</th>
          <th scope="col">Updation</th>
        </tr>
      </thead>
      <tbody>


        <?php
        $sql = "SELECT * FROM `notesdata`";
        $result = mysqli_query($conn,$sql);
        $rowCount = 1;
        while($row = mysqli_fetch_assoc($result)){
            echo '<tr>
            <th scope="row">'.$rowCount++.'</th>'.
            '<td>'.$row["Topic"].'</td>'.
            '<td>'.$row["Description"].'</td>'.
            '<td><button class="btn btn-primary edit" id='.$row["S_No"].'> Edit</button>  <button class="btn  btn-primary delete" id=d'.$row["S_No"].'>Delete</button></td>'.
            '</tr>';
        }
        
    ?>

      </tbody>
    </table>
    <hr>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    let table = new DataTable('#myTable');
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach(element => {
      element.addEventListener("click", (e) => {

        th = e.target.parentNode.parentNode;
        title = th.getElementsByTagName("td")[0].innerText;

        desc = th.getElementsByTagName("td")[1].innerText;
        console.log(title);
        console.log(desc);
        titleEdit.value = title;
        DescriptionEdit.value = desc;
        snoEdit.value = e.target.id;
        console.log(snoEdit.value);
        $('#editModal').modal('toggle');
      })
    });

  </script>
  <script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach(element => {
      element.addEventListener("click", (e) => {

        sno = e.target.id.substr(1,);


        if (confirm("Do you want to delete??")) {
          window.location = `/ayush/Project_1.php?delete=${sno}`;
        } else {
          console.log("NO");
        }
      })
    });

  </script>

</body>

</html>