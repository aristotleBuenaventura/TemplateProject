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
    <title>Checkout</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
</head>
<body>
<?php include 'header.php' ?>

 <div class="container mb-5">
    <h3 class="text-center mt-4 mb-3">Complete your Order</h3>
    <div class="row justify-content-center">
        <?php
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` where email = '$email' and payment = 'Unpaid'");
            $total = 0;
            $grand_total = 0;
            $count = 1;
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
        ?>
        <div class="col col-6 col-md-4 mb-4 ">
            <div class="text-center"><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></div>
            <div class="text-center mt-2"><?= $count ?>. <?= $fetch_cart['name']; ?> (<?= $fetch_cart['quantity']; ?> piece/s.)</div>
        </div>
        <?php
                $count++;
            }
        }else{
            echo "<div class='display-order'><span>Your cart is empty!</span></div>";
        }
        ?>
        <h4 class="grand-total text-center text-lg"> Grand Total : ₱<?= number_format($_SESSION['total']); ?></h4>
        

        <div id="smart-button-container" class="mt-4">
            <div style="text-align: center;">
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
 </div>

    
            

    <!-- Footer  -->
    <?php include 'footer.php' ?>


  <script src="https://www.paypal.com/sdk/js?client-id=AeDTpoaJbhsPiqF5ST2NBlUvOTM9u4dgvVZycMEmGmwCPLmriWcXb1v-NoZVY-rzp9EcJ9_zoIoiMcr9&currency=PHP" data-sdk-integration-source="button-factory"></script>
  <script>
  var total = parseInt('<?php echo $_SESSION['total']; ?>');

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
         
          window.location.href = "success.php?amount=" + total;

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