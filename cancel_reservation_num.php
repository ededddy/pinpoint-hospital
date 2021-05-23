<?php 

include 'config.php';
session_start();

if(isset($_POST['exit'])){
    header("Location:cancel_logi.php");
}
$isLoggedIn=false;
if(isset($_SESSION['name'])){
  $isLoggedIn=true;
}

$reservation_num = $_SESSION['reservation_num'];
$sql_ser = "SELECT * FROM reservation WHERE r_id = '$reservation_num'";
$result_ser = mysqli_query($con, $sql_ser);
if($result_ser !== false and $result_ser->num_rows > 0 ){
    $row_ser = mysqli_fetch_assoc($result_ser);
    $doctor_id = $row_ser['d_id'];  
    $date = $row_ser['datetime'];
}

$patient_ID = $_SESSION['patient_ID'];
$sql_info = "SELECT * FROM patient WHERE id = '$patient_ID'";
$result_info = mysqli_query($con, $sql_info);
if($result_info !== false and $result_info->num_rows > 0){
    $row_info = mysqli_fetch_assoc($result_info);
    $name = $row_info['name'];
    $gender = $row_info['gender'];
    $birth = $row_info['bday'];
}

$sql_doctor = "SELECT * FROM doctor WHERE id = '$doctor_id'";
$result_doctor = mysqli_query($con, $sql_doctor);
if($result_doctor !== false and $result_doctor->num_rows > 0){
    $row_doctor = mysqli_fetch_assoc($result_doctor);
    $doctor = $row_doctor['name'];
    $dep = $row_doctor['division'];

}

if(isset($_POST['delete'])){
    $query = "DELETE FROM reservation WHERE r_id='$reservation_num'";
    $result = mysqli_query($con, $query);
    
    if($result){
        header("Location:delete.php");
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
   
   <title>Pin Point Hospital Reservation Information</title>
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
                <a class="nav-link" href="#">Our Staff</a>
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
                } ?>
                  <li>
                    <a class="dropdown-item" href="#">Appoint a meeting</a>
                  </li>
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
	<section style='padding:20px'>
	<?php echo "Welcome, here is your reservation infromation (reservation number: " .$_SESSION['reservation_num'].")";?>
	<h2>Cancel Reservation</h2>
	<form action="" method="POST" class="info">
	 <table>
	  <tr>
	  <td class="information">
	  <div>Reservation Number:</div>
	  <input type="text" style="border-style:none" value="<?php echo $reservation_num;?>">
	  <div>Name:</div>
	  <input type="text" style="border-style:none" value="<?php echo $name;?>">
	  <div>ID number:</div>
	  <input type="text" style="border-style:none" value="<?php echo $patient_ID;?>">
	  <div>Gender:</div>
	  <input type="text" style="border-style:none" value="<?php echo $gender;?>">
	  <div>Birth Date:</div>
	  <input type="text" style="border-style:none" value="<?php echo $birth;?>";>
	  <div>Hospital Department:</div>
	  <input type="text" style="border-style:none" value="<?php echo $dep;?>">
	  <div>Doctor's name:</div>
	  <input type="text" style="border-style:none" value="<?php echo $doctor;?>">
	  <div>Appointment datetime:</div>
	  <input type="text" style="border-style:none" value="<?php echo $date;?>">
	  <br><input type="submit" value="Cancel Appointment" name='delete'>
	  <input type="submit" value="exit" name="exit">
	  
	  
	 </table>
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