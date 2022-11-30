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
if(isset($_GET["id"])){
  $product_id = $_GET['id'];
}


$resultProduct = mysqli_query($conn,"SELECT * FROM products WHERE id='$product_id'");
$resultCheckProduct = mysqli_num_rows($resultProduct);
if($resultCheckProduct > 0) {
  while($row = mysqli_fetch_assoc($resultProduct)) {
    $product_name = $row['name'];
    $product_price = $row['price'];
    $product_image = $row['image'];
    $product_category = $row['category'];
    $product_description = $row['description'];
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

if(isset($_POST['order_now'])){
  $product_id = $_POST['product_id'];
  $product_quantity= $_POST['quantity'];
  $product_price = $_POST['product_price'];
  if (isset($_SESSION['email'])){ 
  ?>
  <script type="text/javascript">
      window.location.href="checkoutSingle.php?id=<?php echo $product_id; ?>&price=<?php echo $product_price; ?>&quantity=<?php echo $product_quantity; ?>";
  </script>
  <?php
  } else {
    ?>
      <script type="text/javascript">
        alert("Please Log in first!");
        window.location.href = "login.php";
      </script>
    <?php
  }

}

if(isset($_POST['add_to_cart'])){

  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = $_POST['quantity'];

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product_name; ?></title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
</head>
<body>
<?php include 'header.php' ?>
<?php
  if(isset($message)){
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
  };
?>

   <!-- Product section-->
   <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0 description_image" src="uploaded_img/<?php echo $product_image; ?>"  alt="..." /></div>
                    <div class="col-md-6">
                        <h4 class="mb-1 font-bold"><?php echo $product_category; ?></h4>
                        <h1 class="display-5 fw-bolder"><?php echo $product_name; ?></h1>
                        <div class="fs-5 mb-3">
                            <span>₱<?php echo number_format($product_price); ?></span>
                        </div>
                        <p class="lead"><?php echo $product_description; ?></p>
                        <div class="d-flex">
                          <form action="" method='post'>
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $product_image; ?>">
                            <div class="d-flex">
                              <?php 
                                if($product_category != 'Upcoming Release'){
                              ?>
                                <input class="form-control text-center me-3" id="inputQuantity" type="number" min="1" value="1" style="max-width: 5rem" name="quantity"/>
                                <input class="btn btn-outline-dark flex-shrink-0 btn btn-info text-white" type="submit" name="add_to_cart" value="Add to cart">
                                <input class="btn btn-outline-dark flex-shrink-0 btn btn-success text-white ms-4" type="submit" name="order_now" value="Buy now">
                              <?php
                                } else{
                                  ?>
                                <input class="form-control text-center me-3" id="inputQuantity" type="number" min="1" value="1" style="max-width: 5rem" name="quantity" disabled/>
                                <input class="btn  flex-shrink-0 btn btn-info text-white" type="submit" name="add_to_cart" value="Add to cart" disabled>
                                <input class="btn  flex-shrink-0 btn btn-success text-white ms-4" type="submit" name="order_now" value="Buy now" disabled> 
                                <div class="fw-bold ms-4 d-flex align-items-center text-danger">Not Yet Available</div>
                                  <?php
                                }
                              ?>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                  <?php
                    $resultRelated = mysqli_query($conn,"SELECT * FROM products WHERE category='$product_category' and name NOT LIKE '$product_name' LIMIT 4");
                    $resultCheckRelated = mysqli_num_rows($resultProduct);
                    if($resultCheckRelated > 0) {
                    while($row = mysqli_fetch_assoc($resultRelated)) {
                    ?>
                      <div class="col mb-5 text-center hoverBox">
                          <div class="card h-100 text-center">
                            <form action="" method="post">
                              <button class="button_product" name="product">
                                  <img src="uploaded_img/<?php echo $row['image']; ?>" alt="" height="150px" style="hover:">
                                  <h3 ><?php echo $row['name']; ?></h3>
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