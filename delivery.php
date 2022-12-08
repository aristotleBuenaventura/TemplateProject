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
   <!----- DELIVERY - CONTENT ------>
  <main id="content" role="main">
  <section class="py-7 py-md-9">
    <div class="row">
        <div class="col text-center">
            <img src="images/logo1.png" class="img">
            <p class="text h3 mb-4">How long will it take for me to receive my Order</p>
            <h5 class="fw-light"> 
            Delivery time may range from 4 to 18 calendar days, depending on the origin and location of your order <br>
            (local or overseas),the logistics partner, and when your order was picked up by them.This calculation <br>
            excludes public holidays and the logistics partner’s non-working days. </h5> 
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center my-4">
            <table class="border">
                <tr class="border">
                <th colspan="2" class="bg-danger"><center>Delivery Timeframe</center></th>
                </tr>
                <tr class="border">
                <td class="border">Within Metro Manila</td>
                <td >4 to 6 Calendar Days</td>
                </tr>
                <tr class="border">
                <td class="border">Outside Metro Manila</td>
                <td>7 to 12 Calendar Days</td>
                </tr>
                <tr class="border">
                <td class="border">From Overseas</td>
                <td>9 to 8 Calendar Days</td>
                </tr>
            </table>
        </div>
    </div>
    
  <ol class="progtrckr" data-progtrckr-steps="5">
    <li class="progtrckr-done">Order Processing</li><!--
 --><li class="progtrckr-done">Pre-Production</li><!--
 --><li class="progtrckr-done">In Production</li><!--
 --><li class="progtrckr-todo">Shipped</li><!--
 --><li class="progtrckr-todo">Delivered</li>
</ol>   
<p class="text1 h4"><br><br>  Local Orders by non Shoe Crew Supported Logistics </p>
     <h5 class="fw-light">Check for an estimated delivery date with the seller directly via Shoe Crew Chat on Shoe Crew Website. </h5> <br>   

     <p class="text1 h4">  Overseas orders  </p>
     <h5 class="fw-light">Once the seller has arranged for shipment, it will be delivered to you within 9-18 working days, depending on the delivery service selected and other external factors.  </h5> <br>


     <div class="row">
        <div class="col d-flex justify-content-center my-4">
            <table class="border">
                <tr class="border">
                <th class="border bg-danger">Failed to receive an order</th>
                <th class="bg-danger"><center>What will happen?</center></th>
                </tr>
                <tr class="border">
                <td class="border">First delivery attempt</td>
                <td>Your order will be redelivered to you again</td>
                </tr>
                <tr class="border">
                <td class="border">Second delivery attempt </td>
                <td>This will result in order cancellation <br>and will be returned to the Seller(RTS).</td>
                </tr>
            </table>
        </div>   
    </div>   

<p class="text1 h4"><br><br>  Note </p>
     <h5 class="fw-light">You can track your delivery by checking the in-app tracker and updates will reflect within 24-48 hours.</h5> 
     <h5 class="fw-light">In case of unexpected delays, you may also contact the courier directly. </h5> 
     <h5 class="fw-light">For rider-related concerns, you may contact the courier directly,  reach out to Customer Service </h5> 
     <h5 class="fw-light mb-5">If your order is Non-COD, you will receive a refund once the parcel has been successfully returned to the seller (RTS). For COD orders, no refund will be given.</h5> 

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