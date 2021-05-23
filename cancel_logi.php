<?php 

include 'config.php';

session_start();

$isLoggedIn=false;
if(isset($_SESSION['name'])){
  $isLoggedIn =true;
}

if(isset($_POST['submit'])){
    $reservation_num = $_POST['reservation_num'];
    $patient_ID = $_POST['patient_ID'];
    $patient_birth = $_POST['patient_birth'];
    
    $sql = "SELECT * FROM patient WHERE id='$patient_ID' AND bday='$patient_birth'";
    $result = mysqli_query($con,$sql);
    
    $sql_num = "SELECT * FROM reservation WHERE r_id='$reservation_num'";
    $result_num = mysqli_query($con,$sql_num);
    
    if($result !== false and $result->num_rows > 0 ){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['patient_ID'] = $row['id'];
        $_SESSION['patient_name'] = $row['name'];
        header("Location:cancel_reservation.php");
    }elseif($result_num !== false and $result_num->num_rows > 0){
        $row_num =  mysqli_fetch_assoc($result_num);
        $_SESSION['patient_ID'] = $row_num['p_id'];
        $_SESSION['reservation_num'] = $row_num['r_id'];
        header("Location:cancel_reservation_num.php");
        
    }elseif($result_num !== false and !$result_num->num_rows > 0 and $_POST['reservation_num'] != NULL){
        echo "<script>alert('Reservation number is incorrect')</script>";
        
    }else{
        echo "<script>alert('Identification number or birth date is incorrect')</script>";
    }
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head >
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <!-- Required meta tags -->
   
   <!-- Bootstrap CSS -->
   <link href="css/bootstrap.min.css" rel="stylesheet" />
   <link href="css/icons/bootstrap-icons.css" rel="stylesheet" />
   <!-- Custom util CSS -->
   <link href="css/custom/style.css" rel="stylesheet" />
   <!-- Bootstrap JS -->
   <script defer src="js/bootstrap.bundle.min.js"></script>
   
   <title>Pin Point Hospital Cancel reservation page</title>
</head>

<body class="h-screen">
    <div class="d-flex flex-column h-full">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <h3>
              <b>Pin Point</b><br />
              Hospital
            </h3>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="./">Home</a>
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
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdownMenuLink"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Appointments
                </a>
                <ul
                  class="dropdown-menu"
                  aria-labelledby="navbarDropdownMenuLink"
                >
                <?php if(!$isLoggedIn) { 
                echo('
                  <li><a class="dropdown-item" href="login.php">Login</a></li>
                  <li><a class="dropdown-item" href="register.php">Register</a></li>
                ');
                }
                else {
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
                } 
                ?>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdownMore"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  More
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMore">
                  <li><a class="dropdown-item" href="#">Career</a></li>
                  <li><a class="dropdown-item" href="#">Research</a></li>
                </ul>
              </li>
            </ul>
            <form class="d-flex">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-outline-success" type="submit">
                Search
              </button>
            </form>
          </div>
        </div>
      </nav>
	<section style='padding:20px' class="cancel_login">
	 <form action="" method="POST" class="login">
	  <h2 class="title">Cancel Reservation</h2>
	  <p>Please enter either reservation number or ID number with birth date </p>
	  <h4>Reservation Number</h4>
	   <input type="text" name="reservation_num" placeholder="Enter the reservation number">
	  <h4>Identification number</h4>
	   <input type="text" name="patient_ID" placeholder="Enter the ID number" >
	  <h4>Birth date</h4>
	   <input type="date" name="patient_birth" id="date" ><p>
	  <div class="submit">
	  <input name="submit" type="submit" value="confirm" class="bottom"><p>
	  </div>
	  </form>
	  </section>

<footer class="bg-dark py-3 text-light">
        <h4 class="my-1 mx-5"><b>Pin Point</b><br />Hospital</h4>
        <hr class="divider my-4" />
        <div class="d-flex flex-row w-full justify-content-around">
          <div>
            <h5>Contacts</h5>
            <ul class="list-unstyled">
              <li class="my-2">
                <a class="link-light align-middle" href="tel:+85312345678"
                  ><i class="bi-telephone me-3 h5"></i>(+853) 1234 5678</a
                >
              </li>
              <li class="my-2">
                <a
                  class="link-light align-middle"
                  href="mailto:contact@pinpointhospital.com"
                >
                  <i class="bi-envelope me-3 h4 align-middle"></i>
                  contact@pphospital.com</a
                >
              </li>
              <li class="my-2">
                <a class="link-light align-middle my-2" href="fax:+85312345679">
                  <i class="bi-printer me-3 h5 align-middle"></i>
                  (+853) 1234 5679</a
                >
              </li>
              <li class="my-2">
                <a
                  class="link-light align-middle my-2"
                  href="https://goo.gl/maps/UcTftE79r1YZ6Do26"
                >
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
                <a class="link-light align-middle" href="https://twitter.com"
                  ><i class="bi-twitter me-3 h5"></i>Twitter</a
                >
              </li>
              <li class="my-2">
                <a class="link-light align-middle" href="https://facebook.com">
                  <i class="bi-facebook me-3 h4 align-middle"></i>
                  FaceBook</a
                >
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
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-outline-success my-3" type="submit">
                Search
              </button>
            </form>
          </div>
        </div>
      </footer>
    </div>
</body>
</html>