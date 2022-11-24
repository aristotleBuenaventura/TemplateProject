<?php
session_start();

@include 'config.php';



if (isset($_SESSION['email'])){
  $email = $_SESSION['email'];
} else {
  $email = "";
}

$result = mysqli_query($conn,"SELECT * FROM registration WHERE email='$email'");
$resultCheck = mysqli_num_rows($result);

$roleDB = "";
if($resultCheck > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $emailDB = $row['email'];
    $roleDB = $row['role'];
  }
}

if (isset($_GET['id'])){
    $singleId = $_GET['id'];
  } else {
    $singleId = "";
  }

if (isset($_GET['quantity'])){
    $singleQuantity = $_GET['quantity'];
    } else {
    $singleQuantity = "";
    }

if (isset($_GET['price'])){
    $singlePrice = $_GET['price'];
    } else {
    $singlePrice = "";
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="container-fluid box">
        <nav class="navbar navbar-expand-sm navbar-light bg-warning  navigation">
            <div class="container links">
                <ul class="navbar-nav me-auto">
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
                          <button onclick="myFunction()" class="dropbtn btn btn-warning"><?php echo $emailDB  ?></button>
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
                    <a href="index.php"><img class="logo" src="images/logo-no-background.png" alt="" ></a>
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
                <div class="position-relative col col-6 col-sm-6 col-md-4 mt-3 mb-3 float-right links d-flex justify-content-end">
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

 <div class="container mb-5">
    <h3 class="text-center mt-4 mb-3">Complete your Order</h3>
    <div class="row justify-content-center">
        <?php
            $select_cart = mysqli_query($conn, "SELECT * FROM `products` where id = $singleId");
            $total = 0;
            $grand_total = 0;
            $count = 1;
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                $total_price = number_format($singlePrice * $singleQuantity);
        ?>
        <div class="col col-6 col-md-4 mb-4 ">
            <div class="text-center"><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></div>
            <div class="text-center mt-2"><?= $count ?>. <?= $fetch_cart['name']; ?> (<?= $singleQuantity; ?> piece/s.)</div>
        </div>
        <?php
                $count++;
            }
        }else{
            echo "<div class='display-order'><span>Your cart is empty!</span></div>";
        }
        ?>
        <h4 class="grand-total text-center text-lg"> Grand Total : ₱<?= number_format($singlePrice * $singleQuantity); ?></h4>
        

        <div id="smart-button-container" class="mt-4">
            <div style="text-align: center;">
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
 </div>

    
            

    <!-- Footer  -->
<div class="global border-top border-gray">
    <div class="container">
      <div class="row ">
      <div class="col col-12 col-lg-4  mt-5">
            <img src="images/logo-black.png" alt="" class="logoFooter">
        </div>
        <div class="col col-12 col-lg-4  mt-5">
          <h6>Pages</h6>
          <ul class="nav flex-column">
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Inquiry</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Team</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="col col-12 col-lg-4  mt-5 mb-5">
          <h6>Resources</h6>
          <ul class="nav flex-column">
            <li><a href="#">Terms and Conditions</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#">Payment</a></li>
            <li><a href="#">Delivery</a></li>
          </ul>
        </div>
        <div class="social">
          <div class="mt-5 mb-4">
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                </svg>
            </a>
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                </svg>
            </a>
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                </svg>
            </a>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                </svg>
            </a>
          </div>
        </div>
        <p class="copyright mb-5"> &copy; Watch Terminal. All Rights Reserved 2022.</p>
      </div>
  </div>
  </div>
  </div>


  <script src="https://www.paypal.com/sdk/js?client-id=AeDTpoaJbhsPiqF5ST2NBlUvOTM9u4dgvVZycMEmGmwCPLmriWcXb1v-NoZVY-rzp9EcJ9_zoIoiMcr9&currency=PHP" data-sdk-integration-source="button-factory"></script>
  <script>
  var total = parseInt('<?php echo $singlePrice * $singleQuantity; ?>');
  var id = parseInt('<?php echo $singleId; ?>')
  var quantity = parseInt('<?php echo $singleQuantity; ?>')
  var price = parseInt('<?php echo $singlePrice; ?>')

</script>
  <script>
  function initPayPalButton() {
    paypal.Buttons({
      style: {
        shape: 'pill',
        color: 'silver',
        layout: 'vertical',
        label: 'pay',
        
      },

      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{"amount":{"currency_code":"PHP","value":total}}]
        });
      },

      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
          
          // Full available details
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

          // Show a success message within this page, e.g.
          const element = document.getElementById('paypal-button-container');
         
          window.location.href = "successSingle.php?id=" + id + "&price=" + price + "&quantity=" + quantity;

          // Or go to another URL:  actions.redirect('thank_you.html');
          
        });
      },

      onError: function(err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
</script>    
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