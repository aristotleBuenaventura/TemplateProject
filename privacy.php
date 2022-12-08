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
    <title>Privacy Policies</title>
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
            <h1>Privacy Policies</h1>
        </div>
        <div class="row">
          <div class="col">
            <h6 class="fw-light mt-5"> 
              <p><b><c>Protecting your private information is our priority. This Statement of Privacy applies to theshoecrew.tk and The Shoe Crew and
 governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to The Shoe Crew include theshoecrew.tk. 
The Shoe Crew website is an e-commerce site. By using The Show Crew website, you consent to the data practices described in this statement.
<br></b></c>
<br><br>

<b><h5>Collection of your Personal Information</b></h5>
<br>
In order to better provided you with products and services offered on our site, The Shoe Crew may collect personally identifiable information, such as your:
<br>
- First and last name <br>
- Email address
<br><br><br>
If you purchase The Shoe Crew products and services, we collect billing and credit card information. This information is used to complete the purchase transaction.
<br><br>
We do not collect any personal information about you unless you voluntarily provide it to us. However, you may be required to provide certain personal information to 
us when you elect to use certain products or services available on the site. These may include: (a) registering for an account on our site; (b) sending us an email 
message; (c) submitting your credit card or other payment information when ordering and purchasing products and services on our site. To wit, we will use your information for, but not limited to, 
communicating with you in relation to services and/or products you have requested from us. We also may gather additional personal or non-personal information in the 
future.
<br><br><br>

<b><h5>Use of your Personal Information</b></h5>
<br>
The Shoe Crew collects and uses your personal information to operate its website and deliver the services you have requested.
<br><br>
The Shoe Crew may also use your personally identifiable information to inform you of other products or services available from The Shoe Crew and its affiliates.
<br><br><br>
 

<b><h5>Sharing Information with Third Parties</b></h5>
<br>
The Shoe Crew does not sell, rent, or lease its customer lists to third parties.
<br><br>
The Shoe Crew may share data with trusted partners to help perform statistical analysis, send you email or postal mail, provide customer support, or arrange for deliveries. All such third parties are prohibited from using your personal information except to provide these services to
<br><br>
The Shoe Crew, and they are required to maintain the confidentiality of your information.
<br><br> 
The Shoe Crew may disclose your personal information, without notice, if required to do so by law or in the good faith belief that such action is necessary to:
 (a) conform to the edicts of the law or comply with legal process served on The Shoe Crew or the site; (b) protect and defend the rights or property of The Shoe Crew;
 and/or (c) act under exigent circumstances to protect the personal safety of users of The Shoe Crew, or the public.
<br><br><br>
<b><h5>Track User Behavior</b></h5>
<br>
The Shoe Crew may keep track of the websites and pages our users visit within The Shoe Crew, in order to determine what The Shoe Crew services are the most popular. 
This data is used to deliver customized content and advertising within The Shoe Crew to customers whose behavior indicates that they are interested in a particular 
subject area.
<br><br><br>
<b><h5>Automatically Collected Information</b></h5>
<br>
Information about your computer hardware and software may be automatically collected by The Shoe Crew. This information can include your IP address, browser type, 
domain names, access times, and referring website addresses. This information is used for the operation of the service, to maintain quality of the service, and to
 provide general statistics regarding the use of the The Shoe Crew website.
<br><br><br>
 
<b><h5>Links</b></h5>
<br>
This website contains links to other sites. Please be aware that we are not responsible for the content or privacy practices of such other sites. We encourage our 
users to be aware when they leave our site and to read the privacy statements of any other site that collects personally identifiable information.

 <br><br><br>
<b><h5>Security of your Personal Information</b></h5>
<br>
The Shoe Crew secures your personal information from unauthorized access, use, or disclosure.
<br><br>
The Shoe Crew uses the following methods for this purpose:
<br>
SSL Protocol
<br><br> 
When personal information (such as credit card number) is transmitted to other websites, it is protected through the use of encryption, such as the Secure Sockets 
Layer (SSL) Protocol.
<br><br>

We strive to take appropriate security measures to protect against unauthorized access to or alteration of your personal information. Unfortunately, no data 
transmission over the internet or any wireless network can be guaranteed to be 100% secure. As a result, while we strive to protect your personal information, 
you acknowledge that: (a) there are security and privacy limitations inherent to the internet which are beyond our control; and (b) security, integrity, and privacy 
of any and all information and data exchanged between you and us through this site cannot be guaranteed.
<br><br><br>
 

<b><h5>Right to Deletion</b></h5>
<br>
Subject to certain exceptions set out below, on receipt of a verifiable request from you, we will:
<br><br>
-Delete your personal information from our records; and <br>
-Direct any service providers to delete your personal information from their records.

<br><br><br>
<b><h5>Children Under Thirteen</b></h5>
<br>
The Shoe Crew does not knowingly collect personally identifiable information from children under the age of thirteen. If you are under the age of thirteen, you must 
ask your parent or guardian for permission to use this website.
<br><br><br>
 

<b><h5>E-mail Communications</b></h5>
<br>
From time to time, The Shoe Crew may contact you via email for the purpose of providing announcements, promotional offers, alerts, confirmations, surveys, and/or other
 general communication. In order to improve our services, we may receive a notification when you open an email from The Shoe Crew or click on a link therein.
<br>
 
If you would like to stop receiving marketing or promotional communications via email from The Shoe Crew, you may opt-out of such communications by clicking the 
UNSUBSCRIBE button.
<br><br><br>
 

<b><h5>Changes to this Statement</b></h5>
<br>
The Shoe Crew reserves the right to change this Privacy Policy from time to time. We will notify you about significant changes in the way we treat personal information
 by sending a notice to the primary email address specified in your account, by placing a prominent notice of our site, and/or by updating any privacy information on 
this page. Your continued use of the site and/or services available through this site after such modifications will constitute your: (a) acknowledgment of the modified
 Privacy Policy; and (b) agreement to abide and be bound by that policy. 

<br><br><br>
 

 
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