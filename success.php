<?php
    include "config.php";
    session_start();
    if (isset($_SESSION['email'])){
      $email = $_SESSION['email'];
    } else {
      $email = "";
    }

    if (isset($_SESSION['grand_total'])){
      $amount = $_SESSION['grand_total'];
    } else {
      $amount = "";
    }

    if (isset($_GET['credit_payment'])){
      $credit = $_GET['credit_payment'];
    } else {
      $credit = "";
    }

    if (isset($_SESSION['paypal_test'])){
      $paypalPayment = $_SESSION['paypal_test'];
    } else {
      $paypalPayment = "false";
    }

    $result = mysqli_query($conn,"SELECT * FROM registration WHERE email='$email'");
              $resultCheck = mysqli_num_rows($result);
          
    if($resultCheck > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        $balanceDB = $row['balance'];
      }
    }  
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");
        .success-container {
            width:50%;
            position:absolute;
            top:30%;
            left:50%;
            transform:translate(-50%,-50%);
            color:#bdc3c7;
            font-weight:bold;
            font-family: "Poppins", sans-serif;
        }
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .x {
        color: #ff0003;
        font-size: 100px;
        line-height: 200px;
        /* margin-left:-15px; */
      }

      .failed_p {
          color: #ff0003;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
</head>
<body>
      <div class="success-container">
        <?php


           if(($amount < $balanceDB && $credit == 'true')){
               ?>
            <div class="card mt-5">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
              <i class="checkmark">✓</i>
            </div>
              <h1>Transaction Completed Successfully</h1> 
              <p>We received your purchase request;<br/> we'll be in touch shortly!</p>
              <button type='submit' onclick="location.href='products.php'" class='btn btn-success mt-4'>Go back to Products</button>
            </div>

          <?php
              $remainingBalance = $balanceDB - $amount;
              mysqli_query($conn,"UPDATE registration SET balance = '$remainingBalance' where email = '$email'");
              $res=mysqli_query($conn,"select id from cart where email = '$email'");
              $row=mysqli_fetch_array($res);
              mysqli_query($conn,"UPDATE cart SET payment = 'Paid' where email = '$email'");

           } elseif ($test == 'true'){
            ?>
              <div class="card mt-5">
              <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                <i class="checkmark">✓</i>
              </div>
                <h1>Transaction Completed Successfully</h1> 
                <p>We received your purchase request;<br/> we'll be in touch shortly!</p>
                <button type='submit' onclick="location.href='products.php'" class='btn btn-success mt-4'>Go back to Products</button>
              </div>
            <script>
              sessionStorage.removeItem('paypal');
            </script>
            <?php 
                $res=mysqli_query($conn,"select id from cart where email = '$email'");
                $row=mysqli_fetch_array($res);
                mysqli_query($conn,"UPDATE cart SET payment = 'Paid' where email = '$email'");
              } 
           else {
            ?>

              <div class="card mt-5">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
              <p class="x">x</p>
            </div>
              <h1 class="failed_p">Payment Failed</h1> 
              <p>Your payment was not successfully processed;<br/> Please contact our customer support.</p>
              <button type='submit' onclick="location.href='products.php'" class='btn btn-success mt-4'>Go back to Products</button>
            </div>
            <script>
              sessionStorage.removeItem('paypal');
            </script>
            <?php
           }
        ?>
      </div> 

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>