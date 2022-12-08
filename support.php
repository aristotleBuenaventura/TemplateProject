<!-- <?php
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

?> -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Support</title>
  <link rel="icon" type="image/x-icon" href="images/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="">
</head>

<body>
  <?php include 'header.php'?>

  <!-- container with margin top and bottom -->
  <div class="container mt-5 mb-5">
    <h2 class="text-center fw-bold mb-5">FAQs</h2>
    <div class="row d-flex justify-content-center">
      <div class="col">
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                aria-expanded="false" aria-controls="collapseOne">
                Do I need to log in to order?
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
              data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <strong>Yes</strong>, you can add some items to your cart first, and proceed to payment later.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                How to order?
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
              data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <ul>
                  <li>Select from our products</li>
                  <li>Next, select your size</li>
                  <li>Then add to cart</li>
                  <li>View or checkout your cart</li>
                  <li>Fill up forms to proceed payment</li>
                  <li>Lastly, pay your orders</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Do you ship internationally?
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
              data-bs-parent="#accordionExample">
              <div class="accordion-body">
                No, we currently do not offer international shipping.
              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              How long will it take for my order to arrive?
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
              Orders within Metro Manila will arrive 5-7 business days and 7-20 business days for provincial orders.
            </div>
          </div>
        </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
          <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            How do I exchange or return an item?
          </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Please see our Returns & Exchanges section for detailed instructions on how to return or exchange your
            item(s).
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingSix">
          <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
            How do I know my size?
          </button>
        </h2>
        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            PTo best gauge your appropriate size, please refer to the size chart for the particular item you're
            interested in.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headinSeven">
          <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
            Can I pick up an online order from your stores?
          </button>
        </h2>
        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headinSeven"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Only eligible products have the option for in-store pick up. This can be selected in the shipping method
            before checkout.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingEight">
          <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
            Are all products available online also available in your physical stores?
          </button>
        </h2>
        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            No. Each store, including the online store has its own stocks so product availability may vary.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingNine">
          <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
            How can I avail free shipping?
          </button>
        </h2>
        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            Orders must amount to a total of Php 7,000 or more to avail of the free shipping nationwide.
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  </div>



  <?php include 'footer.php'?>
  <script>
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    window.onclick = function (event) {
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
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
</body>

</html>