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
    $imageDB = $row['image'];
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
     <!-- Linking the stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Eczar&family=Graduate&family=Racing+Sans+One&display=swap" rel="stylesheet">
    

</head>
<body>
    <?php include 'header.php' ?>

    
    <!-- video -->
    <div class="mb-4 banner mt-0">
      <section class="showcase text-white justify-content-start">
          <header>
            <h2 class="logo"></h2>
            <div class="toggle"></div>
          </header>
          <video src="videos/backgroundvid.mp4" muted loop autoplay></video>
          <div class="overlay"></div>
          <div class="text container ">
            <h2>BRING POWER TO YOUR </h2> 
            <h2>STEPS.</h2>
            
          <p> 
            <h6> Style and Comfort</h6> 
            <h6>With the Shoe Crew</h6>
        </p>
            
        </div>  
      </section>
    </div>

    <div class="container" >
        <h2 id="discounted" class="title text-center">Latest Arrivals</h2>
        <div class="row">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 3");
            if(mysqli_num_rows($select_products) > 0 ){
          
                while($row = mysqli_fetch_assoc($select_products)){
                  if($row['category'] == 'Men') {
            ?>
            <div class="col-12 col-md-6 col-lg-4 text-center arrivals">
              <form action="" method="post">
                  <button class="button_product" name="product">
                    <img src="uploaded_img/<?php echo $row['image']; ?>" height="250px">
                    <h4 style="color:#ff0003"><?php echo $row['name']; ?></h4>
                    <p>₱<?php echo number_format($row['price']); ?></p>
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                  </button>
              </form>
            </div>
                  <?php
                  }  
              }
              }
            ?>
        </div>
    </div> 
    
    <!-- Banner -->
    <div class="container mt-4 mb-4 banner ">
        <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel" data-interval="4000">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner rounded-mid">
              <div class="carousel-item active">
                <img src="images/banner4.png" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="images/banner5.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="images/3.jpg" class="d-block w-100" alt="...">
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

    <h2 id="discounted" class="title text-center">Best Selling Sneakers</h2>
    <?php include 'owl.php' ?>

    <div class="container" >
        <h2 id="discounted" class="title text-center">Upcoming Releases</h2>
        <div class="row">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products` where id IN (41,42,43)");
            if(mysqli_num_rows($select_products) > 0 ){
          
                while($row = mysqli_fetch_assoc($select_products)){
                  if($row['category'] == 'Kids') {
            ?>
            <div class="col-12 col-md-6 col-lg-4 text-center arrivals">
              <form action="" method="post">
                  <button class="button_product" name="product">
                    <img src="uploaded_img/<?php echo $row['image']; ?>" height="250px">
                    <h4 style="color:#ff0003"><?php echo $row['name']; ?></h4>
                    <p>₱<?php echo number_format($row['price']); ?></p>
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                  </button>
              </form>
            </div>
                  <?php
                  }
              }
              }
            ?>
        </div>
    </div> 

    <div class="containerlast1">
      <div class="parallax">

      </div>
    </div>



      

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


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" 
  integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
  integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>