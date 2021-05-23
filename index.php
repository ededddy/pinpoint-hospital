<?php 

session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
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
              <p><?php echo "user: " . $_SESSION['name']; ?><a href="logout.php">Logout</a></p>
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
                  <li><a class="dropdown-item" href="#">Login</a></li>
                  <li><a class="dropdown-item" href="#">Register</a></li>
                  <li>
                    <a class="dropdown-item" href="cancel_logi.php">Appoint a meeting</a>
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
      <div class="flex-grow-1">
        <div
          id="carouselExampleCaptions"
          class="carousel slide hm-slider"
          data-bs-ride="carousel"
        >
          <div class="carousel-indicators">
            <button
              type="button"
              data-bs-target="#carouselExampleCaptions"
              data-bs-slide-to="0"
              class="active"
              aria-current="true"
              aria-label="Slide 1"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleCaptions"
              data-bs-slide-to="1"
              aria-label="Slide 2"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleCaptions"
              data-bs-slide-to="2"
              aria-label="Slide 3"
            ></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img
                src="images/hall.jpg"
                class="d-block img-fluid"
                alt="Hospital Hall"
              />
              <div class="container">
                <div class="carousel-caption bg-dark">
                  <h5>Spacious Building</h5>
                  <p>
                    Our spacious facilities provides the best environment for
                    patients
                  </p>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <img
                src="images/surgery room.jpg"
                class="d-block img-fluid"
                alt="surgery room"
              />
              <div class="container">
                <div class="carousel-caption bg-dark">
                  <h5>State of the art equiments</h5>
                  <p>
                    Our state of the art equiments can deliver the best
                    operation to patients.
                  </p>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <img
                src="images/research.jpg"
                class="d-block img-fluid"
                alt="Research"
              />
              <div class="container">
                <div class="carousel-caption bg-dark">
                  <h5>Research</h5>
                  <p>
                    Our research strive to find better treatment to cure
                    patients.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <div class="m-5">
          <hr class="divider my-5" />
          <div class="row">
            <div class="col-md-7 d-flex flex-column justify-content-center">
              <h3 class="display-3">
                About <span class="text-muted">US</span>
              </h3>
              <p class="lead">
                Pin Point Hopistal is a young hopsital that has achieve recent
                highs in medical and surgical fields. Our mission is to deliver
                best medical treatment to our patients.
              </p>
            </div>
            <div class="col-md-5">
              <img
                class="feature-img"
                src="images/earpiece-unsplash.jpg"
                alt="Caring staff"
              />
            </div>
          </div>
          <hr class="divider my-5" />
          <div class="row">
            <div class="col-md-5">
              <img
                class="feature-img"
                src="images/nci-unsplash.jpg"
                alt="Caring staff"
              />
            </div>
            <div class="col-md-7 d-flex flex-column justify-content-center">
              <h3 class="display-3">
                Why choose <span class="text-muted">US</span>?
              </h3>
              <p class="lead">
                Our state of the art equiments, comforting environment &amp;
                staff and mind to strive for better treatment all contributes to
                our excellence.
              </p>
            </div>
          </div>
          <hr class="divider my-5" />
          <div class="row">
            <div class="col-lg-4 d-flex flex-column align-items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="140"
                height="140"
                fill="currentColor"
                class="bi bi-question-lg"
                viewBox="0 0 16 16"
              >
                <path
                  d="M3 4.075a.423.423 0 0 0 .43.44H4.9c.247 0 .442-.2.475-.445.159-1.17.962-2.022 2.393-2.022 1.222 0 2.342.611 2.342 2.082 0 1.132-.668 1.652-1.72 2.444-1.2.872-2.15 1.89-2.082 3.542l.005.386c.003.244.202.44.446.44h1.445c.247 0 .446-.2.446-.446v-.188c0-1.278.487-1.652 1.8-2.647 1.086-.826 2.217-1.743 2.217-3.667C12.667 1.301 10.393 0 7.903 0 5.645 0 3.17 1.053 3.001 4.075zm2.776 10.273c0 .95.758 1.652 1.8 1.652 1.085 0 1.832-.702 1.832-1.652 0-.985-.747-1.675-1.833-1.675-1.04 0-1.799.69-1.799 1.675z"
                />
              </svg>

              <h2>Have Questions?</h2>
              <p>
                You may have a lot of medical questions, visits our blogs and
                news to learn more!
              </p>
              <p><a class="btn btn-secondary" href="#">View details »</a></p>
            </div>
            <!-- /.col-lg-4 -->
            <div class="col-lg-4 d-flex flex-column align-items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="140"
                height="140"
                fill="currentColor"
                class="bi bi-file-person"
                viewBox="0 0 16 16"
              >
                <path
                  d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"
                />
                <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
              </svg>

              <h2>Specialties</h2>
              <p>Looking for specialies that suits your situation?</p>
              <p><a class="btn btn-secondary" href="#">View details »</a></p>
            </div>
            <!-- /.col-lg-4 -->
            <div class="col-lg-4 d-flex flex-column align-items-center">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class=""
                width="140"
                height="140"
                fill="currentColor"
                class="bi bi-door-open"
                viewBox="0 0 16 16"
              >
                <path
                  d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"
                />
                <path
                  d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"
                />
              </svg>
              <h2>Appoint Now</h2>
              <p>Aside from walking in, we also offer appointing online!</p>
              <p><a class="btn btn-secondary" href="#"> Go »</a></p>
            </div>
            <!-- /.col-lg-4 -->
          </div>
          <hr class="divider my-5" />
          <div class="row">
            <div class="col-md-12 d-flex flex-column justify-content-center">
              <h3 class="display-3">
                Get in touch!
                <span class="text-muted">Subscribe to our news letter!</span>
              </h3>
              <form class="lead">
                <input
                  class="form-control me-2"
                  type="email"
                  placeholder="hello@example.com"
                  aria-label="Email"
                />
                <button class="btn btn-outline-success my-3" type="submit">
                  Subscribe
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
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
