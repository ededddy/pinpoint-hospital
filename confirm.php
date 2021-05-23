<?php 

session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
}

?>


<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>confirmation</title>
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
</head>

<body>

    <?php 
 $name = $_POST["name"];
 $p_id = $_POST["id"];
 $gender = $_POST["gender"];
 $bday= $_POST["bday"];
 $age =  $_POST["age"];
 $phone = $_POST["phone"];
 $email = $_POST["email"];
 $division = $_POST["division"];
$d_id = $_POST["doctor"];
$date = $_POST["date"];
$time = $_POST["time"];

 $DT = date('Y-m-d H:i:s', strtotime("$date $time"));

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cisc3003";
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("fail to connect database: " . $conn->connect_error);
}
$sql = "INSERT INTO reservation (p_id,d_id,datetime)
VALUES ($p_id, $d_id, '$DT')";

$u = "UPDATE patient
    Set gender = '$gender', age = $age, bday = '$bday',phone = '$phone', email='$email'
    Where id = $p_id;";
    
$d_name = $conn->query("SELECT name from doctor WHERE id = $d_id");
$d_name = $d_name->fetch_assoc();
$conn->query($sql);
$conn->query($u);


$conn->close();
?>
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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMore" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
    <div class="container">
        <main>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"colspan="4">Patient:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Name:</td>
                        <td><?php echo $name?></td>
                        <td>ID:</td>
                        <td><?php echo $p_id?></td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td><?php echo $gender?></td>
                        <td>Age:</td>
                        <td><?php echo $age?></td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td><?php echo $phone?></td>
                        <td>Email:</td>
                        <td><?php echo $email?></td>
                    </tr>
                    <tr>
                        <th colspan="4" scope="col">Appointment:</th>
                    </tr>
                    <tr>
                        <td>Division:</td>
                        <td><?php echo $division?></td>
                        <td>Doctor:</td>
                        <td><?php echo $d_name["name"]?></td>
                    </tr>
                    <tr>
                        <td>Date:</td>
                        <td><?php echo $date?></td>
                        <td>Time:</td>
                        <td><?php echo $time?></td>
                    </tr>
                </tbody>
            </table>
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
                        <a class="link-light align-middle" href="tel:+85312345678"><i
                                class="bi-telephone me-3 h5"></i>(+853) 1234
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
                        <a class="link-light align-middle" href="https://twitter.com"><i
                                class="bi-twitter me-3 h5"></i>Twitter</a>
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