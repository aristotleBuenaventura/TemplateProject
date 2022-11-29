<?php
$result = mysqli_query($conn,"SELECT * FROM registration WHERE email='$email'");
$resultCheck = mysqli_num_rows($result);

$roleDB = "";
if($resultCheck > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $emailDB = $row['email'];
    $roleDB = $row['role'];
    $imageDB = $row['image'];
  }
}


?>
<div class="container-fluid box">
        <nav class="navbar navbar-expand-sm navbar-light navigation ">
            <div class="container links">
                <ul class="navbar-nav me-auto ">
                    <li class="nav-item me-2">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="nav-item me-2">
                        <a href="products.php">Products</a>
                    </li>
                    <li class="nav-item me-2">
                        <a href="about.php">About</a>
                    </li>
                    <li class="nav-item me-2">
                      <a href="team.php">Team</a>
                  </li>
                  <li class="nav-item me-2">
                    <a href="contact.php">Contact</a>
                </li>
                </ul>
                <ul class="navbar-nav justify-content-end">
                    <?php 
                        if($email != '' ){
                    ?>
                        <div class="dropdown">
                          <img class="dropbtn rounded-circle" src="uploaded_img/<?php echo $imageDB; ?>" height="35px" onclick="myFunction()">
                          <div id="myDropdown" class="dropdown-content">
                          <?php 
                            if($roleDB == 'admin' ){
                          ?>
                            <a href="admin.php">Admin</a>  
                          <?php
                              
                            }
                          ?>
                            <a href="profile.php">Profile</a>  
                            <a href="cart.php">Cart</a>
                            <a href="logout.php">Logout</a>
                          </div>
                        </div>
                        <?php
                        } else {
                    ?>
                        <li class="nav-item me-2">
                            <a href="login.php">Login</a>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>

        </nav>
    </div>

    <div class="container-fluid bg-light">
        <div class="container">
            <div class="row ">
                <div class="col col-12 col-sm-12 col-md-4 mt-2 mb-2">
                    <a href="index.php"><img class="logo" src="images/logo.png"  alt="" ></a>
                </div>
                <div class="col col-6 col-sm-6 col-md-4 align-self-center align-items-center mt-2 mb-3">
                    <div class="input-group rounded ">
                        <input type="search" class="form-control rounded searchBar" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                        <button class="border-0 rounded bg-gray searchBar px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                        
                    </div>
                </div>
                <?php
                    $select_rows = mysqli_query($conn, "SELECT * FROM `cart` where email = '$email' and payment = 'Unpaid'") or die('query failed');
                    $row_count = mysqli_num_rows($select_rows);
                ?>
                <div class="position-relative col col-6 col-sm-6 col-md-4 mt-4 mb-3 float-right links-cart d-flex justify-content-end">
                    <a href="cart.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                      </svg>
                    </a>
                    <?php if($row_count > 0) 
                        {
                        ?>
                        <span class="position-absolute top-0 start-100 translate-middle px-2 bg-danger border border-light rounded-circle">
                        <?php
                        echo $row_count;
                        ?>
                        </span>
                            <?php
                        }
                    ?> 
                </div>
            </div>
        </div>
    </div>