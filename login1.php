<?php
session_start();

@include 'config.php';

error_reporting(0);


$result = mysqli_query($conn,"SELECT * FROM registration WHERE email='$email'");
$resultCheck = mysqli_num_rows($result);

$roleDB = "";
if($resultCheck > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $emailDB = $row['email'];
    $roleDB = $row['role'];
  }
}

    
if (isset($_SESSION['username'])) {
    header("Location: index.html");
}

if (isset($_POST['submit'])) {
    session_start();
    
    ////////////////////////
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $user = mysqli_fetch_row($result);
    $user = $_POST['username'];
    $result = getUserByEmail($conn, $email, $password);
    if ($result->num_rows > 0) {
                $row = mysqli_fetch_row($result);
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $_POST['email'];////////////////////////
                header("Location: admin.php");
            } else {
                echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
                // session_destroy();////////////////////////
            }
       

}

function getUserByEmail($conn, $email, $password) {
    $sql = "SELECT * FROM registration WHERE email='$email' AND password= '$password'";
    return mysqli_query($conn, $sql);
}

if (isset($_SESSION['email'])){
  $email = $_SESSION['email'];
} else {
  $email = "";
}   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

</head>
<body>
<!--Main Navigation-->
<header>
  <!-- Navbar-->
  <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    <div class="container-fluid justify-content-center justify-content-md-between">
      <div class="d-flex my-2 my-sm-0">
        <a class="navbar-brand me-2 mb-1 d-flex justify-content-center" href="#">
          <img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png" height="20" alt=""
            loading="lazy" />
        </a>

        <!-- Search form -->
        <form class="d-flex input-group w-auto my-auto">
          <input autocomplete="off" type="search" class="form-control rounded" placeholder="Search"
            style="min-width: 125px" />
          <span class="input-group-text border-0 d-none d-md-flex"><i class="fas fa-search"></i></span>
        </form>
      </div>

      <ul class="navbar-nav flex-row">
        <li class="nav-item me-3 me-lg-0">
          <a class="nav-link" href="#" role="button" data-mdb-toggle="sidenav" data-mdb-target="#sidenav-1"
            class="btn shadow-0 p-0 me-3" aria-controls="#sidenav-1" aria-haspopup="true">
            <i class="fas fa-bars me-1"></i>
            <span>Categories</span>
          </a>
        </li>
        <!-- Badge -->
        <li class="nav-item me-3 me-lg-0">
          <a class="nav-link" href="#">
            <span><i class="fas fa-shopping-cart"></i></span>
            <span class="badge rounded-pill badge-notification bg-danger">1</span>
          </a>
        </li>
        <!-- Notification dropdown -->
        <li class="nav-item dropdown me-3 me-lg-0">
          <a class="nav-link dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button"
            data-mdb-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Some news</a></li>
            <li><a class="dropdown-item" href="#">Another news</a></li>
            <li>
              <a class="dropdown-item" href="#">Something else here</a>
            </li>
          </ul>
        </li>
        <li class="nav-item me-3 me-lg-0">
          <a class="nav-link" href="#">
            <span class="d-none d-lg-inline-block">Contact</span>
            <i class="fas fa-envelope d-inline-block d-lg-none"></i>
          </a>
        </li>
        <li class="nav-item me-3 me-lg-0">
          <a class="nav-link" href="#">
            <span class="d-none d-lg-inline-block">Shop</span>
            <i class="fas fa-shopping-bag d-inline-block d-lg-none"></i>
          </a>
        </li>
        <!-- Avatar -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink"
            role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22"
              alt="" loading="lazy" />
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">My profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar -->

  <!-- Sidenav -->
  <div id="sidenav-1" class="sidenav" role="navigation" data-mdb-hidden="true" data-mdb-accordion="true">
    <ul class="sidenav-menu">
      <li class="sidenav-item">
        <a class="sidenav-link"><i class="fas fa-layer-group pe-3"></i><span>Categories</span></a>
        <ul class="sidenav-collapse show">
          <li class="sidenav-item">
            <a class="sidenav-link">Dresses</a>
          </li>
          <li class="sidenav-item">
            <a class="sidenav-link">Shirts</a>
          </li>
          <li class="sidenav-item">
            <a class="sidenav-link">Jeans</a>
          </li>
          <li class="sidenav-item">
            <a class="sidenav-link">Shoes</a>
          </li>
          <li class="sidenav-item">
            <a class="sidenav-link">Accessories</a>
          </li>
          <li class="sidenav-item">
            <a class="sidenav-link">Jewelry</a>
          </li>
        </ul>
      </li>
      <li class="sidenav-item">
        <a class="sidenav-link"><i class="fas fa-gem pe-3"></i><span>Brands</span></a>
        <ul class="sidenav-collapse">
          <li class="sidenav-item">
            <a class="sidenav-link">Brand 1</a>
          </li>
          <li class="sidenav-item">
            <a class="sidenav-link">Brand 2</a>
          </li>
          <li class="sidenav-item">
            <a class="sidenav-link">Brand 3</a>
          </li>
          <li class="sidenav-item">
            <a class="sidenav-link">Brand 4</a>
          </li>
        </ul>
      </li>
      <li class="sidenav-item">
        <a class="sidenav-link"><i class="fas fa-gift pe-3"></i><span>Discounts</span></a>
        <ul class="sidenav-collapse">
          <li class="sidenav-item">
            <a class="sidenav-link">-70%</a>
          </li>
          <li class="sidenav-item">
            <a class="sidenav-link">-50%</a>
          </li>
          <li class="sidenav-item">
            <a class="sidenav-link">Any</a>
          </li>
        </ul>
      </li>
      <li class="sidenav-item">
        <a class="sidenav-link"><i class="fas fa-fire-alt pe-3"></i><span>Popular</span></a>
        <ul class="sidenav-collapse">
          <li class="sidenav-item">
            <a class="sidenav-link">Jewelry</a>
          </li>
          <li class="sidenav-item">
            <a class="sidenav-link">Snickers</a>
          </li>
        </ul>
      </li>
      <li class="sidenav-item">
        <a class="sidenav-link"><i class="fab fa-hotjar pe-3"></i><span>Today's bestseller</span></a>
        <div class="card mx-3">
          <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
            <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/shoes%20(3).jpg"
              class="w-100" />
            <a href="#!">
              <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                  <h5><span class="badge bg-danger ms-2">-10%</span></h5>
                </div>
              </div>
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="" class="text-reset">
              <p class="mb-2">Pink snickers</p>
            </a>
            <p class="mb-0">
              <s>$61.99</s><strong class="ms-2 text-danger">$50.99</strong>
            </p>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <!-- Sidenav -->

  <!-- Background image -->
  <div id="intro" class="bg-image shadow-1-strong" style="
        background-image: url(https://mdbootstrap.com/img/new/slides/311.jpg);
        height: 500px;
      ">
    <div class="mask text-white" style="background-color: rgba(0, 0, 0, 0.6); margin-top: 58px">
      <div class="container d-flex align-items-center justify-content-center text-center h-100">
        <div class="text-white">
          <h1 class="mb-3">Autumn sale</h1>
          <h4 class="mb-4">Promotions up to 70%!</h4>
          <a class="btn btn-outline-light btn-lg mb-3" href="#!" role="button">See the promotional offer
            <i class="fas fa-gem ms-1"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Background image -->
</header>
<!--Main Navigation-->

    
            

    <!-- Footer  -->
    <?php include 'footer.php' ?>

  <script>
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" 
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>