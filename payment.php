<?php
session_start();

@include 'config.php';

if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];
  } else {
    $email = "";
  };

if(isset($_POST["submit"]))
{
    mysqli_query($conn,"insert into inquiries values(NULL,'$_POST[name]','$_POST[email]','$_POST[subject]','$_POST[message]')");
    ?>
    
    <script type="text/javascript">
        alert("Inquiry has been successfully submitted");
        window.location.href=window.location.href;
    </script>


    <?php
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
    <title>Terms and Conditions</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="scss/style.css">
</head>

<body>
<?php include 'header.php' ?>

    
<br>    
  <div class="container">
         <!----- ABOUT - PAYMENT ------>

  <main id="content" role="main">
  <section class="py-7 py-md-9">
    <div class="text-center mb-5">
        <img src="images/logo1.png" class="img">
        <h3 class="text fw-bold ">What payment option does Shoe Crew Support?</h3>
    </div>
  <div class="row ">
    <div class="col my-4">
        
          <h4> Shoe Crew Supports a total of 4 options <br>
           <br>1. Paypal <br>
           <br>2. Cash On Delivery <br>
           <br>3. Google Pay <br>
           <br>4. Credit / Debit Card <br></h4>
    </div>
    <div class="col mb-5">
        <img src="images/payment.jpg" class="payment" height="500px">
    </div>
  </div>
    <p class="text1 fw-bold"> 1. Paypal </p>
     <h5 class="fw-light"> The new feature of our Payment System within our website. </h5> <br>
    <p class="text1 fw-bold"> 2. Cash On Delivery </p>
     <h5 class="fw-light"> Pay for your orders in cash when they are delivered  to your doorstep by our Shoe Crew Supported Couriers. </h5> <br>
    <p class="text1 fw-bold"> 3. Google Pay </p>
     <h5 class="fw-light"> Select Google Pay when you check out on Shoe Crew to tap on any payment options you’ve saved within your account. For android users only. </h5> <br>
    <p class="text1 fw-bold"> 4. Credit / Debit Card </p>
     <h5 class="mb-5 fw-light"> Pay using all locally issued Mastercard, VISA, or JCB credit/debit cards, provided that they are 3DS certified.. </h5> <br>

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