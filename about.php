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

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">

</head>
<body>
    <?php include 'header.php'?>

    <div class="container">
        <div class="text-center mt-3">
            <img  src="images/logo1.png" class="img">
        </div>
        <div class="text-center aboutTitle">
            <h3>Comfort and Classic Quality and Style</h3>
        </div>
        <div class="row">
          <div class="col">
            <h4 class="fw-light mt-5"> 
                For each one of those shoe sweethearts out there, Shoe Crew 
                offer the one-stop goal to pick the correct match of footwear. 
                To satisfy the affection for shoes, we offer heaps of alternatives 
                from driving footwear marks, all under one rooftop. Gone are the days  
                when you needed to go from store to store to locate the correct style and 
                size for yourself.
                At Shoe Crew,, you can locate a vast accumulation of dashing footwear 
                in all sizes and styles, all inside a couple of snaps. 
                <br>
                <br>
                Devoted to satisfying your shopping wants with no inconvenience, we ensure 
                that you encounter smooth web based requesting background. Our intriguing accumulation 
                of elegantly insightful footwear is accessible at astonishing costs that will really 
                shock you. So be a shoe-holic with Shoe Crew.
              </h4>
            </div>
            <div class="col">
              <img src="images/store.jpg" class="mt-5"><br>
              <div class="d-flex justify-content-center">
                <a href="contact.php" class="btn btn-danger mt-4">Contact Us &#8594 </a>
              </div>
          </div>
        </div>
      </div>
  </div>


 <!------- HOW IT STARTED? --------->
 <div class="container mt-5">
  <div class="row">
  <div class="col-md-2">
    
      <!-- Divider -->
      <hr>
    
      <!-- Text -->
      <p class="fs-lg lh-lg text-black mb-5 mb-md-0 fw-bold">
          Take a quick look at Shoe Crew's
      </p>
          </div>
    
          <div class="col-md-4">
            <!-- Media -->
            <div class="media-decoration media-decoration-1 mb-5 mb-md-0">
              <!-- Border -->
              <div class="media-decoration-border" data-jarallax-element="-40" style="transform: translate3d(0px, 15.5249px, 0px);"><div id="jarallax-container-1" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; z-index: -100;"><div style="pointer-events: none; transform-style: preserve-3d; backface-visibility: hidden; will-change: transform, opacity; position: fixed;"></div></div></div>
              <!-- Image -->
              <img class="media-decoration-img img-fluid" src="images/sneaker1.jpg" alt="...">
            </div>
          </div>
    
          <div class="col-md-5 align-self-center mx-auto">
            <!-- Heading -->
            <h2 class="mb-2">
             How it <em>started</em>?
            </h2>
            
            <!-- Text -->
            <p class="mb-0">
              It started way back in <em>2018</em> as a stall shop from the street and aimed high to get us through here. We started selling the basic Sneakers with Clothing's from other brands and more.
              <br>
              <br>
              With the help of the rest of the team, we strive high to be the best-selling and well-known Shoe Store in Quezon City. 
            </p>

          </div>
        </div>
      </div>
    
    <!----- BEST SELLERS ----->
     <div class="container">
     <div class="row">
     <div class="col-md-2">
    
      <!-- Divider -->
      <hr>
    
      <!-- Text -->
      <p class="fs-lg lh-lg text-black mb-5 mb-md-0 fw-bold">
            Shoe Crew Best Selling Sneakers
      </p>
          </div>
       
          <div class="col-md-4">
            <!-- Media -->
            <div class="media-decoration media-decoration-1 mb-5 mb-md-0">
              <!-- Border -->
              <div class="media-decoration-border" data-jarallax-element="-40" style="transform: translate3d(0px, 15.5249px, 0px);"><div id="jarallax-container-2" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; z-index: -100;"><div style="pointer-events: none; transform-style: preserve-3d; backface-visibility: hidden; will-change: transform, opacity; position: fixed;"></div></div></div>
              <!-- Image -->
              <img class="media-decoration-img img-fluid" src="images/sneaker.jpg" alt="...">
            </div>
          </div>
          <div class="col-md-5 align-self-center mx-auto">
            
            <!-- Heading -->
            <h2 class="mb-2">
             <em> Best </em> selling sneakers
            </h2>
            
            <!-- Text -->
            <p class="mb-0">
              Are you having trouble picking your pairs? <em>Here are the best sellers that you might want to try.</em>
              <br><br>
              • Jordan 1's <br>
              • Nike Airforces <br>
              • Travis Scott <br>
              • Lebron's<br>
              • J1 Low's
            </p>

          </div>
        </div>
      </div>
    
    <!-------- LOCATION -------------->
     <div class="container mb-5">
     <div class="row">
     <div class="col-md-2">
       
      <!-- Divider -->
     <hr >
       
      <!-- Text -->
      <p class="fs-lg lh-lg text-black mb-5 mb-md-0 fw-bold">
        Shoe Crew Location
      </p>
          </div>
       
          <div class="col-md-4">
            <!-- Media -->
            <div class="media-decoration media-decoration-1 mb-5 mb-md-0">
              <!-- Border -->
              <div class="media-decoration-border" data-jarallax-element="-40" style="transform: translate3d(0px, 15.5249px, 0px);"><div id="jarallax-container-3" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; z-index: -100;"><div style="pointer-events: none; transform-style: preserve-3d; backface-visibility: hidden; will-change: transform, opacity; position: fixed;"></div></div></div>
              <!-- Image -->
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15439.860230492459!2d121.0870518656155!3d14.657924486254014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b9e96f55de09%3A0xb43ff02e1bd94cf8!2sTumana%2C%20Marikina%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1669372582160!5m2!1sen!2sph" width="380" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
          <div class="col-md-5 align-self-center mx-auto">
            
            <!-- Heading -->
            <h2 class="mb-2">
             Where <em> to <em> locate us</em>
            </h2>
            <!-- Text -->
            <p class="mb-0">
              Come and Visit where people are talking about the latest Sneaker Brands. We are located at - <em>Blk 7 Lot 15 Mustasa St. Tumana Marikina City.</em>
            </p>

          </div>
        </div>
      </div>




    <?php include 'footer.php'?>
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