<?php

@include 'config.php';

session_start();


if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' and payment = 'Unpaid'");

   if (isset($_SESSION['email'])){ 
       if(mysqli_num_rows($select_cart) > 0){
          $message[] = 'product already added to cart';
       }else{
          $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity, email, payment) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity','$email','Unpaid')");
          $message[] = 'product added to cart succesfully';
       }
   } else {
    ?>
    <script type="text/javascript">
        alert("Please Log in first!");
        window.location.href = "login.php";
    </script>
    <?php
   }

}

if(isset($_POST['product'])){
    $product_id = $_POST['product_id'];
    ?>
    <script type="text/javascript">
        window.location.href="description.php?id=<?php echo $product_id; ?>";
    </script>
    <?php
}


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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>
    <?php include 'header.php' ?>

    <!-- Banner -->
    <div class="container mt-4 mb-4 banner ">
        <div id="carouselExampleIndicators" class="carousel slide  carousel_product" data-ride="carousel" data-interval="4000">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner rounded-mid">
              <div class="carousel-item active carousel_item_product">
                <img src="images/banner4.png" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item carousel_item_product">
                <img src="images/banner5.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item carousel_item_product">
                <img src="images/banner6.png" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>


<div class="container">
    <div class="row">
        <div class="col col-12 col-md-2">
        <div class="flex">
          <div class="tab my-4 mt-5">
            <div>
              <button class="tablinks button-27 mb-3" onclick="openCity(event, 'All')" id="defaultOpen">All</button>
            </div>
            <div>
              <button class="tablinks button-27 mb-3" onclick="openCity(event, 'Men')">Men</button>
            </div>
            <div>
              <button class="tablinks button-27 mb-3" onclick="openCity(event, 'Women')">Women</button>
            </div>
            <div>
              <button class="tablinks button-27 mb-3" onclick="openCity(event, 'Unisex')">Unisex</button>
            </div>
            <div>
              <button class="tablinks button-27 mb-3" onclick="openCity(event, 'Kids')">Kids</button>
            </div>
          </div>
        </div>
        </div>
        <div class="col">
        <div id="All" class="tabcontent">
          <div class="row">
                  <section class="py-5">
                    <div class="container">
                    <div class="mb-4">
                          <span class="h3 mb-4">All</span>
                          
                      </div>
                      <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        <?php
                          $select_products = mysqli_query($conn, "SELECT * FROM `products` where category not in ('Upcoming Release')");
                          if(mysqli_num_rows($select_products) > 0 ){
                        
                              while($row = mysqli_fetch_assoc($select_products)){
                          ?>
                            <div class="col mb-5 text-center hoverBox">
                                <div class="card h-100 text-center border border-gray productBorder">
                                  <form action="" method="post">
                                    <button class="button_product" name="product">
                                        <img src="uploaded_img/<?php echo $row['image']; ?>" alt="" height="150px" id="product">
                                        <h4 ><?php echo $row['name']; ?></h4>
                                        <div >₱<?php echo number_format($row['price']); ?></div>
                                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                        <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                                    </button>
                                </form>
                                </div>
                            </div>
                          <?php
                            }
                          }
                          ?>
                      </div>
                    </div>
                  </section>
              </div>
        </div>
        <div id="Men" class="tabcontent">
          <div class="row">
              <section class="py-5">
                <div class="container">
                <div class="mb-4">
                      <span class="h3 mb-4">Men</span>
                      
                  </div>
                  <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
                      if(mysqli_num_rows($select_products) > 0 ){
                    
                          while($row = mysqli_fetch_assoc($select_products)){
                            if($row['category'] == 'Men') {
                      ?>
                        <div class="col mb-5 text-center hoverBox">
                            <div class="card h-100 text-center border border-gray productBorder">
                              <form action="" method="post">
                                <button class="button_product" name="product">
                                    <img src="uploaded_img/<?php echo $row['image']; ?>" alt="" height="150px" class="image_hover">
                                    <h4 ><?php echo $row['name']; ?></h4>
                                    <div >₱<?php echo number_format($row['price']); ?></div>
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                                </button>
                            </form>
                            </div>
                        </div>
                      <?php
                            }
                      }
                      }
                    ?>
                  </div>
                </div>
              </section>
          </div>
        </div>
        <div id="Women" class="tabcontent">
          <div class="row">
              <section class="py-5">
                <div class="container">
                  <div class="mb-4">
                      <span class="h3 mb-4">Women</span>
                  </div>
                  <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    
                    <?php
                      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
                      if(mysqli_num_rows($select_products) > 0 ){
                          while($row = mysqli_fetch_assoc($select_products)){
                            if($row['category'] == 'Women') {
                      ?>
                        <div class="col mb-5 text-center hoverBox">
                            <div class="card h-100 text-center border border-gray productBorder">
                              <form action="" method="post">
                                <button class="button_product" name="product">
                                    <img src="uploaded_img/<?php echo $row['image']; ?>" alt="" height="150px" class="image_hover">
                                    <h4 ><?php echo $row['name']; ?></h4>
                                    <div >₱<?php echo number_format($row['price']); ?></div>
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                                </button>
                            </form>
                            </div>
                        </div>
                      <?php
                            }
                      }
                      }
                    ?>
                  </div>
                </div>
              </section>
          </div>  
        </div>
        <div id="Unisex" class="tabcontent">
          <div class="row">
            <section class="py-5">
              <div class="container">
              <div class="mb-4">
                    <span class="h3 mb-4">Unisex</span>
                </div>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                  
                  <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `products`");
                    if(mysqli_num_rows($select_products) > 0 ){
                        while($row = mysqli_fetch_assoc($select_products)){
                          if($row['category'] == 'Unisex') {
                    ?>
                      <div class="col mb-5 text-center hoverBox">
                          <div class="card h-100 text-center border border-gray productBorder">
                            <form action="" method="post">
                              <button class="button_product" name="product">
                                  <img src="uploaded_img/<?php echo $row['image']; ?>" alt="" height="150px" class="image_hover">
                                  <h4 ><?php echo $row['name']; ?></h4>
                                  <div >₱<?php echo number_format($row['price']); ?></div>
                                  <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                  <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                  <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                  <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                              </button>
                          </form>
                          </div>
                      </div>
                    <?php
                          }
                    }
                    }
                  ?>
                </div>
              </div>
            </section>
          </div>
        </div>
        <div id="Kids" class="tabcontent">
          <div class="row">
            <section class="py-5">
              <div class="container">
              <div class="mb-4">
                    <span class="h3 mb-4">Kids</span>
              </div>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                  
                  <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `products`");
                    if(mysqli_num_rows($select_products) > 0 ){
                        while($row = mysqli_fetch_assoc($select_products)){
                          if($row['category'] == 'Kids') {
                    ?>
                      <div class="col mb-5 text-center hoverBox">
                          <div class="card h-100 text-center border border-gray productBorder">
                            <form action="" method="post">
                              <button class="button_product" name="product">
                                  <img src="uploaded_img/<?php echo $row['image']; ?>" alt="" height="150px" class="image_hover">
                                  <h4 ><?php echo $row['name']; ?></h4>
                                  <div >₱<?php echo number_format($row['price']); ?></div>
                                  <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                  <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                  <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                  <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                              </button>
                          </form>
                          </div>
                      </div>
                    <?php
                          }
                    }
                    }
                  ?>
                </div>
              </div>
            </section>
          </div>    
        </div>
        </div>
    </div>
</div>    









    
            

    <!-- Footer  -->
    <?php include 'footer.php' ?>

  <script>
  
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }


    document.getElementById("defaultOpen").click();
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