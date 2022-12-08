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
        <div class="text-center mt-3">
            <img  src="images/logo1.png" class="img">
        </div>
        <div class="text-center aboutTitle">
            <h1>Terms and Conditions</h1>
        </div>
        <div class="row">
          <div class="col">
            <h6 class="fw-light mt-5"> 
              <p><b><h5>  1.  SCOPE; APPLICABILITY </b></h5>
<br><br>
1.1 These general terms and conditions for the sale and supply of products to business customers (“these GTC”) The Shoe Crew, a private 
company incorporated in Philippines with registered company number 324291 and having its registered office address at Blk 7 Lot 15 Mustasa St. Tumana Marikina City.
 (“we”, “our” or “us”) apply only to orders from business customers (“you” or “your”). These GTC exclusively contain all terms
 and conditions applicable to the agreement between you and us in respect of our supply of products to you, to the extent these are not amended by way of written 
agreement between you and us.  These GTC are the entire agreement between you and us in relation to their subject matter.  You acknowledge that you have not relied 
on any statement, promise or representation or assurance or warranty that is not set out in these GTC. Any diverging or contradictory terms and conditions will not
 be accepted unless we expressly agree to them in writing.  These GTC are made only in the English language.

<br><br>

1.2 You will be notified of changes to these GTC in writing, by fax or by email. Your silence is your deemed consent to such changes and the changes 
will be considered accepted by you if you do not object to the change within four weeks after receipt of the notice of change.
                <br>
                <br><br>
<b><h5>2.  REGISTRATION AS USER  </b></h5>             
<br><br>
2.1 Your registration with our online shop is free of charge. There is no obligation on us to admit you to or register you as a user of our online shop. Only customers
 with full legal capacity to contract with us are permitted to register on our online shop.  In order to register, please electronically fill out the registration form
 on our website theshoecrew.tk and submit it to us. In order to register and open an account with us you must provide us with: (i) the information necessary in order 
for you to place orders with us; and (ii) any other information that we may notify to you as being required from time to time. At the time of registration you will 
chose a personal user name and a password. The user name may not infringe upon third party name or brand rights. You are obligated to keep your password confidential 
and to under no circumstances make it known to third parties. 
<br><br>
2.2 Apart from the declaration of consent with the applicability of these GTC your registration as a user of our online shop does not entail any obligations on you, 
other than as expressly set out in these GTC.
<br><br>
2.3 You are responsible for updating your account registration information in case of any changes by you. All changes to your account can be made online after logging 
in under “My Account”.

<br><br><br>

<b><h5>3. DATA PROTECTION </b></h5>
<br><br>
  Our collection, processing and recording of personal data provided by you to us or collected by us will be done in accordance with the provisions of data 
protection law and our privacy statement.
<br><br><br>
<b><h5>4. OUR PRODUCTS</b></h5>
<br><br>
  The images of the products on our site are for illustrative purposes only. Although we have made every effort to display the colours accurately, we cannot guarantee
 that your computer's display of the colours accurately reflect the colour of the products. The colour of your products may vary slightly from those images.  The 
packaging of your products may vary from that shown on images on our site.
<br><br><br>

<b><h5>5. CONCLUSION OF THE AGREEMENT</b></h5>               
<br><br>
5.1 Please check your order carefully before confirming it. You are responsible for ensuring that your order is complete and accurate.
<br><br>
5.2 The online presentation of our products as well as the corresponding prices do not constitute a binding offer by us and are subject to change from time to time.
 It is your order of products via our online shop, via email to theShoeCrew@gmail.com , per telephone at 00353 61 479200 which constitutes such a binding offer to enter 
into an agreement for the sale of such products by us to you. In case of an order via our online shop, we will confirm receipt of your order electronically. Please 
note that this confirmation of receipt does not constitute acceptance of your offer to enter into an agreement for the sale of the products by us to you. Acceptance of
 your offer shall take place only if we provide you with an order confirmation in writing or by email for the products confirmed therein, or, in the alternative, upon
 delivery of the products to us. 
<br><br>
5.3 If we are unable to supply you with products for any reason, we will inform you of this by email or phone and we will refund you the full amount including any 
delivery costs charged.
<br><br>
              </h6></p>
            </div>
         
          </div>
        </div>
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