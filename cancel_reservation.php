<?php 

include 'config.php';
session_start();

if(isset($_POST['exit'])){
    header("Location:cancel_logi.php");
}

$isLoggedIn= false;
if(isset($_SESSION['name'])){
  $isLoggedIn = true;
}


function getFieldNum(){
    include 'config.php';
    $patient_ID = $_SESSION['patient_ID'];
    $sql_reser = "SELECT * FROM reservation WHERE p_id = '$patient_ID'";
    $result = mysqli_query($con, $sql_reser);
    if($result !== false and $result->num_rows > 0){
        $row = mysqli_fetch_all($result);
        $numAttribute = count($row);
    }
    return $numAttribute;
}

function newInfor(){
    include 'config.php';
    $numAttribute = getFieldNum();
    $i = 0;
    while($i<$numAttribute){
        echo "<form action='' method='POST' class='info'>
	 <table>
	  <tr>
	  <td class='information'>
	  <div style='font-weight: bold'>Reservation Number:</div>
	  <input type='text' style='border-style:none' value='" .setNum($i). "'>
	  <div style='font-weight: bold'>Name:</div>
	  <input type='text' style='border-style:none' value='" .$_SESSION['patient_name']. "'>
	  <div style='font-weight: bold'>ID number:</div>
	  <input type='text' style='border-style:none' value='" .$_SESSION['patient_ID']. "'>
	  <div style='font-weight: bold'>Gender:</div>
	  <input type='text' style='border-style:none' value='" .setGender(). "'>
	  <div style='font-weight: bold'>Birth Date:</div>
	  <input type='text' style='border-style:none' value='" .setBirth(). "'>
	  <div style='font-weight: bold'>Hospital Department:</div>
	  <input type='text' style='border-style:none' value='" .setDep($i). "'>
	  <div style='font-weight: bold'>Doctor's name:</div>
	  <input type='text' style='border-style:none' value='" .setDoctor($i). "'>
	  <div style='font-weight: bold'>Appointment datetime:</div>
	  <input type='text' style='border-style:none' value='" .setDate($i). "'><br>
	  <input type='submit' value='Cancel Appointment' name='".$i. "'>
	  <input type='submit' value='exit' name='exit'>
      <p>
	  
	  
	 </table>
	</form>";
        $i++;
    }
    
}

function setGender(){
    include 'config.php';
    $patient_ID = $_SESSION['patient_ID'];
    $sql_info = "SELECT * FROM patient WHERE id = '$patient_ID'";
    $result_info = mysqli_query($con, $sql_info);
    if($result_info !== false and $result_info->num_rows > 0){
        $row_info = mysqli_fetch_assoc($result_info);
        $gender = $row_info['gender'];
    }
    return $gender;
}

function setBirth(){
    include 'config.php';
    $patient_ID = $_SESSION['patient_ID'];
    $sql_info = "SELECT * FROM patient WHERE id = '$patient_ID'";
    $result_info = mysqli_query($con, $sql_info);
    if($result_info !== false and $result_info->num_rows > 0){
        $row_info = mysqli_fetch_assoc($result_info);
        $birth = $row_info['bday'];
    }
    return $birth;
}

function setNum(int $i){
    include 'config.php';
    $patient_ID = $_SESSION['patient_ID'];
    $sql_reser = "SELECT * FROM reservation WHERE p_id = '$patient_ID'";
    $result_reser = mysqli_query($con, $sql_reser);
    if($result_reser !== false and $result_reser->num_rows > 0){
        $row_reser = mysqli_fetch_all($result_reser,MYSQLI_ASSOC);
        $num = $row_reser[$i]['r_id'];
    }
    return $num;
}

function setDep(int $i){
    include 'config.php';
    $patient_ID = $_SESSION['patient_ID'];
    $sql_reser = "SELECT * FROM reservation WHERE p_id = '$patient_ID'";
    $result_reser = mysqli_query($con, $sql_reser);
    if($result_reser !== false and $result_reser->num_rows > 0){
        $row_reser = mysqli_fetch_all($result_reser,MYSQLI_ASSOC);
        $doctor_id = $row_reser[$i]['d_id'];
    }
    $sql_doctor = "SELECT * FROM doctor WHERE id = '$doctor_id'";
    $result_doctor = mysqli_query($con, $sql_doctor);
    if($result_doctor !== false and $result_doctor->num_rows > 0){
        $row_doctor = mysqli_fetch_assoc($result_doctor);
        $dep = $row_doctor['division'];
    }
    return $dep;
}

function setDoctor(int $i){
    include 'config.php';
    $patient_ID = $_SESSION['patient_ID'];
    $sql_reser = "SELECT * FROM reservation WHERE p_id = '$patient_ID'";
    $result_reser = mysqli_query($con, $sql_reser);
    if($result_reser !== false and $result_reser->num_rows > 0){
        $row_reser = mysqli_fetch_all($result_reser,MYSQLI_ASSOC);
        $doctor_id = $row_reser[$i]['d_id'];
    }
    $sql_doctor = "SELECT * FROM doctor WHERE id = '$doctor_id'";
    $result_doctor = mysqli_query($con, $sql_doctor);
    if($result_doctor !== false and $result_doctor->num_rows > 0){
        $row_doctor = mysqli_fetch_assoc($result_doctor);
        $doctor = $row_doctor['name'];
    }
    return $doctor;
}

function setDate(int $i){
    include 'config.php';
    $patient_ID = $_SESSION['patient_ID'];
    $sql_reser = "SELECT * FROM reservation WHERE p_id = '$patient_ID'";
    $result_reser = mysqli_query($con, $sql_reser);
    if($result_reser !== false and $result_reser->num_rows > 0){
        $row_reser = mysqli_fetch_all($result_reser,MYSQLI_ASSOC);
        $date = $row_reser[$i]['datetime'];
    }
    return $date;
}

function setTime(int $i){
    include 'config.php';
    $patient_ID = $_SESSION['patient_ID'];
    $sql_reser = "SELECT * FROM reservation_info WHERE patient_ID = '$patient_ID'";
    $result_reser = mysqli_query($con, $sql_reser);
    if($result_reser !== false and $result_reser->num_rows > 0){
        $row_reser = mysqli_fetch_all($result_reser,MYSQLI_ASSOC);
        $time = $row_reser[$i]['appoinment_time'];
    }
    return $time;
}



$nums = getFieldNum();
for($i = 0;$i<$nums;$i++){
    if(isset($_POST[$i])){
        $reservation_num = setNum($i);
        $query = "DELETE FROM reservation WHERE r_id='$reservation_num'";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location:delete.php");
        }
        
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

   <title>Pin Point Hospital</title>
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
                <a class="nav-link active" aria-current="page" href="./">Home</a>
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
		<h2>Cancel Reservation</h2>
		<?php echo "<h3 style='font-weight: normal'>Welcome, Here is all of the reservation of " .$_SESSION['patient_name']. "(ID:" .$_SESSION['patient_ID']. ")</h3>";?>
		<form action="" method="POST" class="info">
	 	<?php newInfor();?>
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