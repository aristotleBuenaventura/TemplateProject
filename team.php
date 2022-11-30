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
    <title>Team</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/team.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        .icons a {
            padding: 0.1rem 0.5rem 0.1rem;
            font-size: 1.3rem;
        }
    </style>

</head>
<body>
    <?php include 'header.php'?>


    <div class="container-fluid box">
        <div class="wrapper">
            <div class="container">
                <div class="row justify-content-center align-items-center page-row">
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                        <h2 class="page-title fw-bold">Our Team</h2>
                    </div>

                    <!-- people -->
                    <div class="col-sm-12 col-md-6 col-lg-4 align-items-center">
                        <div class="box-container">
                            <img src="images/vergara.jpg" alt="Vergara's Profile"
                                class="img-fluid mx-auto d-block profile">
                            <h3 class="name">Vergara, Jazmine T.</h3>
                            <p class="position">Project Manager</p>
                            <div class="icons text-center">
                                <a target="_blank" class="text-dark" href="https://www.facebook.com/jazminevergara24"><i
                                        class="fa-brands fa-facebook"></i></a>
                                <a target="_blank" class="text-dark"
                                    href="https://www.instagram.com/jazmine_vergsz/?fbclid=IwAR37AW98xs2Sn8GIR11eVonOQJg9fmjmWfHqeLC0v6_FyYRSR7DBeFWJjA4"><i
                                        class="fab fa-instagram-square"></i></a>
                                <a target="_blank" class="text-dark" href="http://"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4 align-items-center">
                        <div class="box-container">
                            <img src="images/buenaventura.jpg" alt="Buenaventura's Profile"
                                class="img-fluid mx-auto d-block profile">
                            <h3 class="name">Buenaventura, Aristotle C.</h3>
                            <p class="position">Full Stack Developer</p>
                            <div class="icons text-center">
                                <a target="_blank" class="text-dark"
                                    href="https://www.facebook.com/aristotlecortezbuenaventura"><i
                                        class="fa-brands fa-facebook"></i></a>
                                <a target="_blank" class="text-dark"
                                    href="https://www.instagram.com/aris23lei/?fbclid=IwAR26UG3Q1ocNny_Cr14KAaMzHduYFOWE4AlVDuWeUFk2DV7n4ESEFaiOqAw"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a target="_blank" class="text-dark" href="http://"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4 align-items-center">
                        <div class="box-container">
                            <img src="images/aquino.jpg" alt="Aquino's Profile"
                                class="img-fluid mx-auto d-block profile">
                            <h3 class="name">Aquino, Justin Deniel S.</h3>
                            <p class="position">Backend Developer</p>
                            <div class="icons text-center">
                                <a target="_blank" target="_blank" class="text-dark"
                                    href="https://www.facebook.com/Justinaquino08"><i
                                        class="fa-brands fa-facebook"></i></a>
                                <a target="_blank" target="_blank" class="text-dark"
                                    href="https://www.instagram.com/patatinnnnnn/?fbclid=IwAR0qJ7T-K0D2MM_S14-jAHGzCvGC2bOS6vNLSjAJNSLzolRkSieygfAtcM0"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a target="_blank" class="text-dark" href="http://"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4 align-items-center">
                        <div class="box-container">
                            <img src="images/paulme.jpg" alt="Paulme's Profile"
                                class="img-fluid mx-auto d-block profile">
                            <h3 class="name">Paulme, Miguel Angelo S.</h3>
                            <p class="position">Graphic Designer</p>
                            <div class="icons text-center">
                                <a target="_blank" class="text-dark" href="https://www.facebook.com/miguel.paulme"><i
                                        class=" fa-brands fa-facebook"></i></a>
                                <a target="_blank" class="text-dark"
                                    href="https://www.instagram.com/paulmemiguel/?fbclid=IwAR3JnASeZHTEZhs-L0IaqF0Px0oIPQHkw7FC97PTlnF8-YMum1lGWaLMs0o"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a target="_blank" class="text-dark"
                                    href="https://twitter.com/MPaulme?fbclid=IwAR1nk8W6K_jhQienaNRzzUsQQgmLq-xFolGkyG532HBLRwYuQBXWcdHt4_s"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-sm-12 col-md-6 col-lg-4 align-items-center">
                        <div class="box-container">
                            <img src="images/luceno.jpg" alt="Luceño's Profile"
                                class="img-fluid mx-auto d-block profile">
                            <h3 class="name">Luceño, Janrey D.</h3>
                            <p class="position">Frontend Developer</p>
                            <div class="icons text-center">
                                <a target="_blank" class="text-dark" href="https://www.facebook.com/Janrey005"><i
                                        class="fa-brands fa-facebook"></i></a>
                                <a target="_blank" class="text-dark"
                                    href="https://www.instagram.com/timothee_reyy/?fbclid=IwAR2Rnuuxa-iGmbogi5ntwkT5EBxa7bB49pYtPM0mXwi4RlMj3CaGMugyV0o"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a target="_blank" class="text-dark" href="http://"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-sm-12 col-md-6 col-lg-4 align-items-center">
                        <div class="box-container">
                            <img src="images/lawrence.png" alt="Lawrenc's Profile"
                                class="img-fluid mx-auto d-block profile">
                            <h3 class="name">Ramos, Lawrence Andrew M.</h3>
                            <p class="position">Frontend Developer</p>
                            <div class="icons text-center">
                                <a target="_blank" class="text-dark" href="https://www.facebook.com/rmslwrncc"><i
                                        class="fa-brands fa-facebook"></i></a>
                                <a target="_blank" class="text-dark"
                                    href="https://www.instagram.com/lwrnc_rms/?fbclid=IwAR1yignuN7AoM1sHQcQpCnsGKUReRqnLV3SXY8Xbuat7ROZGkUuj1vPPg18"><i
                                        class="fab fa-instagram-square"></i></a>
                                <a target="_blank" class="text-dark" href="http://"><i
                                        class="fa-brands fa-twitter"></i></a>
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