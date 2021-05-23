<?php 

session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
}

?>


<!DOCTYPE html>
<html>

<head>
  <title>appointment</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Required meta tags -->

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/icons/bootstrap-icons.css" rel="stylesheet" />
  <!-- Custom util CSS -->
  <link href="css/custom/style.css" rel="stylesheet" />
  <!-- Bootstrap JS -->
  <script defer src="js/bootstrap.bundle.min.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    // $(document).ready(function(){
    //   $("division").change( function(){
    //     alert("The paragraph was clicked.");
    //   });
    // });
  </script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <h3>
          <b>Pin Point</b><br />
          Hospital
        </h3>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./doctors/">Our Staff</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Appointments
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <?php
                echo ( '<li><a href="#">' .htmlspecialchars($_SESSION['name']) .'</a></li>');
                echo(
                '<a href="logout.php">Logout</a>');
                echo(
                  '
                  <li>
                    <a class="dropdown-item" href="appointment.php?='.$_SESSION["id"]. '">Appoint a meeting</a>
                  </li>
                  '
                );
                echo('
                  <li>
                    <a class="dropdown-item" href="cancel_logi.php">Cancel meeting</a>
                  </li>
                ');
                ?>
                </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMore" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              More
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMore">
              <li><a class="dropdown-item" href="#">Career</a></li>
              <li><a class="dropdown-item" href="#">Research</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-outline-success" type="submit">
            Search
          </button>
        </form>
      </div>
    </div>
  </nav>


  <?php 
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "cisc3003";
      $id = $_GET['id'];
      // 创建连接
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("fail to connect database: " . $conn->connect_error);
      }
      $sql = "SELECT `patient`.`id`,
                    `patient`.`name`,
                    `patient`.`gender`,
                    `patient`.`bday`,
                    `patient`.`age`,
                    `patient`.`phone`,
                    `patient`.`email`
              FROM `cisc3003`.`patient`
              WHERE `patient`.`id`= $id;";
      $result = $conn->query($sql);

      $sql ="SELECT division FROM cisc3003.doctor
            group by division;";
      $divisions = $conn->query($sql);
      $temp = $conn->query("SELECT id,name,division FROM cisc3003.doctor;");
      $doctors = array();
      while( $row = mysqli_fetch_array( $temp, MYSQLI_ASSOC ) ) {
        array_push( $doctors, $row );
      }
      $theArray = json_encode( $doctors );
      
      $conn->close(); 
      
      if ($result->num_rows > 0) {
          // 输出数据
          $result = $result->fetch_assoc();
          // echo "id: " . $result["bday"]. " - Name: " . $result["name"]. " " . $result["email"]. "<br>";
          
      } else {
          die('no match id');
      }
  ?>
    <script>
      var theArray = <?php echo $theArray ?> ;
      
    </script>
  <div class="container" style="margin-top:20px; margin-bottom: 20px;">
    <main>

      <form method="POST" action="confirm.php">
        <h1>Make Appointment</h1>
        <hr>
        <fieldset>
          <legend>personal info</legend>

          <div class="row align-items-center g-4">
            <div class="col-sm-6">
              <label for="name" class="form-label"> Name:</label>
              <input type="text" class="form-control" id="name" name="name" value="<?php echo $result["name"]; ?>" >
            </div>
            <div class="col-sm-3">
              <label for="id" class="form-label"> ID:</label>
              <input type="text" class="form-control" id="id" name ="id" value="<?php echo $result["id"]; ?>" >
            </div>
            <!-- <div class="col-sm-6">
              <label for="firstName" class="form-label ">First Name:</label>
              <input type="text" class="form-control" id="firstName" placeholder="John">
            </div>
            <div class="col-sm-6">
              <label for="lastName" class="form-label"> Last Name:</label>
              <input type="text" class="form-control" id="lastName" placeholder="Doe">
            </div> -->
          </div>
          <div class="row align-items-center g-4">
            <div class="col-sm-3">
              <label for="gender" class="form-label">Gender:</label>
              <select name="gender" id="gender" class="form-control">
                <option value="" disabled selected></option>
                <option value="m">male</option>
                <option value="f">female</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="birthday" class="form-label">Birth Day:</label>
              <input type="date" class="form-control" id="birthday" name="bday" max="" min="" value="<?php echo $result["bday"]; ?>">
            </div>
            <div class="col-sm-3">
              <label for="age" class="form-label">Age:</label>
              <input type="number" class="form-control" name="age" value="<?php echo $result["age"]; ?>">
            </div>
          </div>
          <div class="col-6">
            <label for="phoneNum" class="form-label">Phone:</label>
            <input type="text" class="form-control" id="phoneNum" name="phone" value="<?php echo $result["phone"]; ?>">
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php echo $result["email"]; ?>">
          </div>
        </fieldset>
        <hr>
        <div>

          <fieldset style="margin-bottom: 10px;">
            <legend>Appointment Details</legend>
            <div>
              <label for="division" class="form-label">Select Division</label>
              <select name="division" class="form-control" id="division">
                <option selected disabled>Please Choose Division</option>
                <?php while($row = $divisions->fetch_assoc()){
                  echo "<option value=".$row["division"].">".$row["division"]."</option>";
                }
                ?>
                <!-- <option value="1">Cardiology</option>
                <option value="2">Psychiatry</option>
                <option value="2">Otolaryngology</option> -->
              </select>
            </div>
              <script>
                const selectElement = document.getElementById('division');

                selectElement.addEventListener('change', (event) => {
                  opt="";
                  theArray.forEach(element => {
                    
                    
                    if(element["division"] === event.target.value){
                      opt +="<option value='"+element["id"]+"'>"+element["name"]+"</option>"
                    }
                  });
                  document.getElementById('doctor').innerHTML=opt;
                  // console.log(opt);

                  // result.textContent = `You like ${event.target.value}`;
                }); 
              </script>
              <div class="result"></div>
            
            <div>
              <label for="doctor" class="form-label">Doctor:</label>
              <select name="doctor" class="form-control" id="doctor">

                <!-- <option value="doc1">John Doe</option>
                <option value="doc2">Marry Jane</option> -->
              </select>
            </div>
            <div class="row">
              <div class="col-4">
                <label for="date" class="form-label">appointment date:</label>
                <input type="date" class="form-control" id="date" name="date" max="" min="">
              </div>
              <div class="col-4">
                <label for="time" class="form-label">appointment time:</label>
                <input type="time" class="form-control" name="time" id="time">
              </div>

            </div>
        </div>
        </fieldset>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </main>
  </div>
  <footer class="bg-dark py-3 text-light">
    <h4 class="my-1 mx-5"><b>Pin Point</b><br />Hospital</h4>
    <hr class="divider my-4" />
    <div class="d-flex flex-row w-full justify-content-around">
      <div>
        <h5>Contacts</h5>
        <ul class="list-unstyled">
          <li class="my-2">
            <a class="link-light align-middle" href="tel:+85312345678"><i class="bi-telephone me-3 h5"></i>(+853) 1234
              5678</a>
          </li>
          <li class="my-2">
            <a class="link-light align-middle" href="mailto:contact@pinpointhospital.com">
              <i class="bi-envelope me-3 h4 align-middle"></i>
              contact@pphospital.com</a>
          </li>
          <li class="my-2">
            <a class="link-light align-middle my-2" href="fax:+85312345679">
              <i class="bi-printer me-3 h5 align-middle"></i>
              (+853) 1234 5679</a>
          </li>
          <li class="my-2">
            <a class="link-light align-middle my-2" href="https://goo.gl/maps/UcTftE79r1YZ6Do26">
              <i class="bi-geo-alt-fill me-3 h5 align-middle"></i>
              85-87 R. de Coelho do Amaral, Macao
            </a>
          </li>
        </ul>
      </div>
      <div>
        <h5>Socials</h5>
        <ul class="list-unstyled">
          <li class="my-2">
            <a class="link-light align-middle" href="https://twitter.com"><i class="bi-twitter me-3 h5"></i>Twitter</a>
          </li>
          <li class="my-2">
            <a class="link-light align-middle" href="https://facebook.com">
              <i class="bi-facebook me-3 h4 align-middle"></i>
              FaceBook</a>
          </li>
          <li class="my-2">
            <a class="link-light align-middle my-2" href="fax:+85312345679">
              <i class="bi-instagram me-3 h5 align-middle"></i>
              Instagram
            </a>
          </li>
        </ul>
      </div>
      <div>
        <h5>Looking for something?</h5>
        <form>
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-outline-success my-3" type="submit">
            Search
          </button>
        </form>
      </div>
    </div>
  </footer>
</body>

</html>