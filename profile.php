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

if($resultCheck > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $userDB = $row['username'];
      $emailDB = $row['email'];
      $firstnameDB = $row['firstname'];
      $lastnameDB = $row['lastname'];
      $roleDB = $row['role'];
      $addressDB = $row['address'];
      $birthdayDB = $row['birthday'];
      $mobileNoDB = $row['mobileNo'];
      $genderDB = $row['gender'];
      $imageDB =$row['image'];
      $balanceDB = $row['balance'];
    }
  }

  if(isset($_POST['update_profile'])){
    $update_firstname = $_POST['firstname_update'];
    $update_lastname = $_POST['lastname_update'];
    $update_address = $_POST['address_update'];
    $update_birthday = $_POST['birthday_update'];
    $update_mobileNo= $_POST['mobileNo_update'];
    $update_gender = $_POST['gender_update'];
    
    $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;
 
    $update_query = mysqli_query($conn, "UPDATE `registration` SET firstname = '$update_firstname', lastname = '$update_lastname', address ='$update_address', birthday ='$update_birthday', mobileNo = '$update_mobileNo', gender ='$update_gender', image = '$update_p_image' WHERE email = '$email'");
 
    if($update_query){
       move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
       $message[] = 'Profile Updated Succesfully';
       header('location:profile.php');
    }else{
       $message[] = 'Profile could not be Updated';
       header('location:profile.php');
    }
 
 }

 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | <?php echo $userDB; ?></title>
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
</head>
<body>
<style>
body {
    
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style>

<?php include 'header.php' ?>


<div class="container rounded bg-light mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="uploaded_img/<?php echo $imageDB; ?>" height="100" alt=""><span class="font-weight-bold"><?php echo $userDB; ?></span><span class="text-black-50"><?php echo $emailDB; ?></span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>

                <form action="" method="post" class="update-profile-form " enctype="multipart/form-data">
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Enter First Name</label><input type="text" class="form-control" placeholder="first name" required name="firstname_update" value="<?php echo $firstnameDB; ?>"></div>
                    <div class="col-md-6"><label class="labels">Enter Last Name</label><input type="text" class="form-control" required name="lastname_update" value="<?php echo $lastnameDB; ?>" placeholder="surname"></div>
                </div>
                <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Birthday</label><input type="text" class="form-control" placeholder="Enter Birthday" required name="birthday_update" value="<?php echo $birthdayDB; ?>"></div>
                    <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" placeholder="Enter Address" required name="address_update" value="<?php echo $addressDB; ?>"></div>
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="Enter Mobile Number" required name="mobileNo_update" value="<?php echo $mobileNoDB; ?>"></div>
                    <div class="col-md-12"><label class="labels">Gender</label><input type="text" class="form-control" placeholder="Enter Gender" required name="gender_update" value="<?php echo $genderDB; ?>"></div>
                    <input type="file" class="box mt-3 ms-2" name="update_p_image" required accept="image/png, image/jpg, image/jpeg">
         </div>
                <div class="mt-5 text-center"><input type="submit" value="Save Profile" name="update_profile" class="btn btn-success"></div>
                      </form>
                      <div class="row mt-2 mb-5">
                      <div class="col border rounded border-dark mt-5" >
                        <h5 class="text-start mt-2 fw-light">Your current balance</h5>
                        <h4 class="text-start mt-3">₱ <?php echo number_format($balanceDB); ?>.00</h4>
                      </div>
          </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="border-bottom border-dark mb-3 font-weight-bold">
                  <h4>Transaction History</h4>
                </div>
                <?php
                     $res=mysqli_query($conn,"select * from cart where email = '$email'");
                     $count=1;
                     while($row=mysqli_fetch_array($res))
                     {
                       if($row['payment'] == 'Paid'){
                        echo "<div class='border-bottom border-dark mb-3'>";
                        echo "<div class='font-weight-bold'>"; echo $count; echo ".</div>";
                        echo "<div class='row g-0'>";
                        echo "<div class='col font-weight-bold'>";
                        echo "<p> Name: "; 
                        echo "</div>";
                        echo "<div class='col'>";
                        echo $row["name"]; echo "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='row g-0'>";
                        echo "<div class='col font-weight-bold'>";
                        echo "<p> Unit Price: ";
                        echo "</div>";
                        echo "<div class='col'>";
                        echo '₱ '.number_format($row["price"]); echo "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='row g-0'>";
                        echo "<div class='col font-weight-bold'>";
                        echo "<p> Number of items: ";
                        echo "</div>";
                        echo "<div class='col'>";
                        echo $row["quantity"]; echo "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='row g-0'>";
                        echo "<div class='col font-weight-bold'>";
                        echo "<p> Total Amount: ";
                        echo "</div>";
                        echo "<div class='col'>";
                        echo '₱ '.number_format($row["price"]*$row["quantity"]); echo "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";

                        $count++;
                       }
                       
                     }
                ?>
            </div>
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