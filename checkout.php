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
    $firstnameDB = $row['firstname'];
    $lastnameDB = $row['lastname'];
    $addressDB = $row['address'];
    $mobileNoDB = $row['mobileNo'];
    $balanceDB = $row['balance'];
  }
}

if(isset($_POST['update_profile'])){
  $update_firstname = $_POST['firstname_update'];
  $update_lastname = $_POST['lastname_update'];
  $update_address = $_POST['address_update'];
  $update_mobileNo= $_POST['mobileNo_update'];
  
  $update_query = mysqli_query($conn, "UPDATE `registration` SET firstname = '$update_firstname', lastname = '$update_lastname', address ='$update_address', mobileNo = '$update_mobileNo' WHERE email = '$email'");

  if($update_query){
     $message[] = 'Billing Details has been Updated Succesfully';
     header('location:checkout.php');
  }else{
     $message[] = 'Billing Details could not be Updated';
     header('location:checkout.php');
  }

}
$_SESSION['shipping'] = 80;
$_SESSION['paypalPayment'] = 'false';
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
    <h3 class="text-center mt-5 mb-5">Complete your Order</h3>

    <div class="row gx-5">
      <div class="col col-12 col-md-6  border border-3 rounded-3">
      <h4 class="text-start mt-3">Billing Details</h4>
      <h5 class="text-start mt-2 fw-light">Please kindly fill out the form below.</h5>
      <form action="" method="post" class="update-profile-form " enctype="multipart/form-data">
          <div class="row mt-2">
              <div class="col-md-6"><label class="labels">Enter First Name</label><input type="text" class="form-control" placeholder="first name" required name="firstname_update" value="<?php echo $firstnameDB; ?>"></div>
              <div class="col-md-6"><label class="labels">Enter Last Name</label><input type="text" class="form-control" required name="lastname_update" value="<?php echo $lastnameDB; ?>" placeholder="surname"></div>
          </div>
          <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control " id="address" placeholder="Enter Address" required name="address_update" value="<?php echo $addressDB; ?>"></div>
                <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control " id="mobileNumber" placeholder="Enter Mobile Number" required name="mobileNo_update" value="<?php echo $mobileNoDB; ?>"></div>
          </div>

          <div class="mt-3 text-center"><input type="submit" value="Save Billing Details" name="update_profile" class="btn btn-success"></div>
          <div class="payment_area mt-5"></div>
          <h4 class="text-start mt-3">Payment method</h4>
          <h5 class="text-start mt-2 fw-light">Choose what payment method to use in processing your order.</h5>

          <div class="row mt-2 mb-3">
            <div class="col col-6 btn border rounded border-dark" onclick="openCredit()">
                <div><img src="images/favicon.png" alt="" height='30px'></div>
                Shoe Crew Credit
            </div>
            <div class="col col-6 btn border rounded border-dark" onclick="openPayPal()">
                <div><img src="images/paypal.png" alt="" height='30px'></div>
                PayPal
            </div>
          </div>

          <div class="row mt-2 mb-5 credit_balance" style='display:none'>
            <div class="col border rounded border-dark" >
              <h5 class="text-start mt-2 fw-light">Your current balance</h5>
              <h4 class="text-start mt-3">₱ <?php echo number_format($balanceDB); ?>.00</h4>
            </div>
          </div>

      </form>
      </div>
      <div class="col col-12 col-md-6  border border-3 rounded-3">
        <div class="row my-4 ">
          <div class="col col-6 text-start fw-bold">
            Item
          </div>
          <div class="col col-6 text-end fw-bold">
            Price
          </div>
        </div>
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
            

            <div class="row">
              <div class="col col-6">
                <div class=""><span class="fw-bold"><?= $count ?>.</span> <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="50" alt=""></div>
                <div class="mt-2"><?= $fetch_cart['name']; ?></div>
                <div class="mb-4"><span class="fw-bold">Quantity</span> (<?= $fetch_cart['quantity']; ?> piece/s.)</div>
              </div>
              <div class="col col-6">
                <div class="mb-4 text-end mt-5 fw-light">₱<?= number_format($fetch_cart['price']*$fetch_cart['quantity']); ?>.00</div>
              </div>
            </div>
        
            <?php
                    $count++;
                }
            }else{
                echo "<div class='display-order'><span>Your cart is empty!</span></div>";
                $_SESSION['total'] = 0;
                $_SESSION['shipping'] = 0;
            }
            ?>
            <div class="row payment_area">
              <div class="col col-6 mt-4">
                <h5 class="grand-total">Subtotal : </h5>
                <h5 class="grand-total">Shipping Fee : </h5>
                <h5 class="grand-total">VAT: </h5>
                
              </div>
              <div class="col col-6 mt-4 mb-2">
                <h5 class="grand-total text-end fw-light">₱<?= number_format($_SESSION['total']); ?>.00</h5>
                <h5 class="grand-total text-end fw-light">₱<?= number_format($_SESSION['shipping']); ?>.00</h5>
                <h5 class="grand-total text-end fw-light">₱<?= number_format(($_SESSION['total']*.12)); ?>.00</h5>
                
              </div>
            </div>

            <div class="row payment_area">
              <div class="col col-6 mt-3">
                <h4 class="grand-total ">Total : </h4>
              </div>
              <div class="col col-6 mt-3 mb-3">
                <h4 class="grand-total text-end ">₱<?= number_format(($_SESSION['total']*.12)+($_SESSION['total'])+$_SESSION['shipping']); ?>.00</h4>
              </div>
            </div>
            <?php
                $_SESSION['grand_total'] = ($_SESSION['total']*.12)+($_SESSION['total'])+$_SESSION['shipping'];
            ?>
            
            <?php
              if ($_SESSION['grand_total'] > 0){
                ?>

            <div id="smart-button-container" class="mt-4 paypal"  style='display:none'>
                <div style="text-align: center;">
                    <div id="paypal-button-container"></div>
                </div>
            </div>

            <?php

              }
            ?>
            <div class="mt-4 credit"  style='display:none'>
            <?php
              if($balanceDB <= $_SESSION['grand_total']){
                ?>
                <div class="row mt-2 mb-5">
                  <div class="col border rounded border-danger" >
                    <h5 class="text-center text-danger mt-2 fw-light">You don't have enough balance to place this order.</h5>
                  </div>
                </div>
                <?php
              } else if ($_SESSION['grand_total'] > 0){
                ?>
              <div id="smart-button-container"  >
                  <div style="text-align: center;">
                      <h5 class="btn btn-info border rounded mb-5" onclick='creditPayment()'>Pay with Shoe Crew Credit</h5>
                  </div>
              </div>
                <?php

              }
            ?>
            </div>
        </div>
     </div>

      </div>
    </div>







    
            

    <!-- Footer  -->
    <?php include 'footer.php' ?>

  
  <script>
    function openPayPal() {
      var address = document.querySelector("#address").value;
      var mobileNumber = document.querySelector("#mobileNumber").value;
      if(address == '' || mobileNumber == ''){
        alert("Please complete your billing details");
      } else { 
        var paypal = document.querySelector(".paypal");
        var credit = document.querySelector(".credit");
        var credit_balance = document.querySelector(".credit_balance");
        if (paypal.style.display === "none") {
          paypal.style.display = "block";
          credit.style.display = "none";
          credit_balance.style.display = "none";
        } else {
          paypal.style.display = "none";
        }
      }
    }
  </script>  
  
  <script>
    function openCredit() {
      var address = document.querySelector("#address").value;
      var mobileNumber = document.querySelector("#mobileNumber").value;
      if(address == '' || mobileNumber == ''){
        alert("Please complete your billing details");
      } else { 
        var credit = document.querySelector(".credit");
        var paypal = document.querySelector(".paypal");
        var credit_balance = document.querySelector(".credit_balance");
        if (credit.style.display === "none") {
          credit.style.display = "block";
          credit_balance.style.display = "block";
          paypal.style.display = "none";
        } else {
          credit.style.display = "none";
        }
      }
    }
  </script>
  <script src="https://www.paypal.com/sdk/js?client-id=AeDTpoaJbhsPiqF5ST2NBlUvOTM9u4dgvVZycMEmGmwCPLmriWcXb1v-NoZVY-rzp9EcJ9_zoIoiMcr9&currency=PHP" data-sdk-integration-source="button-factory"></script>
  <script>
  var total = parseInt('<?php echo $_SESSION['grand_total']; ?>');

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
          sessionStorage.setItem("paypal", 'true');
        
          window.location.href = "success.php?";

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
    function creditPayment(){
      window.location.href = "success.php?credit_payment=true";
    }
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