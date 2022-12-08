<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']); 
    $role = "admin";

    
    
    if ($password === $cpassword) {
      $users = getUserByEmail($conn, $email);
      if ($users->num_rows === 0) {
        $sql = "INSERT INTO registration (username, email, firstname, lastname, password, role,address,birthday,mobileNo,gender,image)
                    VALUES ('$username', '$email', '$firstname', '$lastname','$password', '$role','','','','','loginIcon.jpeg')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
              $_SESSION["firstname"] = $firstname;
              $_SESSION["lastname"] = $lastname;
              $_SESSION["email"] = $email;
                header('Location: admin.php');
            } else {
                echo "<script>alert('Woops! Something Went Wrong.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Already Exists.')</script>";

        }

    } else {
        echo "<script>alert('Password Not Matched.')</script>";
    }
}

function getUserByEmail($conn, $email) {
    $sql = "SELECT * FROM registration WHERE email='$email'";
    return mysqli_query($conn, $sql);
}


if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$p_image;
   $p_category = $_POST['category'];
   $p_description = $_POST['description'];

   $insert_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image, category,description) VALUES('$p_name', '$p_price', '$p_image','$p_category','$p_description')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
   }
};

if(isset($_POST['add_banner'])){
    $b_name = $_POST['b_name'];
    $b_image = $_FILES['b_image']['name'];
    $b_image_tmp_name = $_FILES['b_image']['tmp_name'];
    $b_image_folder = 'uploaded_img/'.$b_image;
 
    $insert_query = mysqli_query($conn, "INSERT INTO `carousel`(name, image) VALUES('$b_name', '$b_image')") or die('query failed');
 
    if($insert_query){
       move_uploaded_file($b_image_tmp_name, $b_image_folder);
       $message[] = 'Banner image add succesfully';
    }else{
       $message[] = 'Could not add the Banner Image';
    }
 };

// DELETE PRODUCT START
if(isset($_GET['delete_product'])){
   $delete_id = $_GET['delete_product'];
   $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:admin.php');
      $message[] = 'product could not be deleted';
   };
};

if(isset($_GET['delete_banner'])){
    $delete_id = $_GET['delete_banner'];
    $delete_query = mysqli_query($conn, "DELETE FROM `carousel` WHERE id = $delete_id ") or die('query failed');
    if($delete_query){
       header('location:admin.php');
       $message[] = 'Banner image has been deleted';
    }else{
       header('location:admin.php');
       $message[] = 'Banner image could not be deleted';
    };
 };
// DELETE PRODUT END

// DELETE USER START

if(isset($_GET['delete_user'])){
    $user_delete_id = $_GET['delete_user'];
    $user_delete_query = mysqli_query($conn, "DELETE FROM `registration` WHERE id = $user_delete_id ") or die('query failed');
    if($user_delete_query){
       header('location:admin.php');
       $message[] = 'User has been deleted';
    }else{
       header('location:admin.php');
       $message[] = 'User could not be deleted';
    };
 };

//DELETE USER END
if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;
   $update_p_category = $_POST['category_update'];
   $update_p_description = $_POST['update_p_description'];


   $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image', category = '$update_p_category', description = '$update_p_description' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:admin.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:admin.php');
   }

}

// UPDATE USER START

if(isset($_POST['update_users'])){
    $update_user_id = $_POST['update_user_id'];
    $update_username = $_POST['update_username'];
    $update_email = $_POST['update_email'];
    //MORE INFO START
    $update_firstname = $_POST['firstname_update'];
    $update_lastname = $_POST['lastname_update'];
    $update_address = $_POST['address_update'];
    $update_mobileNo= $_POST['mobileNo_update'];
    
    $update_user_image = $_FILES['update_user_image']['name'];
   $update_user_image_tmp_name = $_FILES['update_user_image']['tmp_name'];
   $update_user_image_folder = 'uploaded_img/'.$update_user_image;
    //MORE INFO END
    
 
 
    $update_query = mysqli_query($conn, "UPDATE `registration` SET username= '$update_username', email = '$update_email', password = '$update_password', role = '$update_role',firstname = ' $update_firstname',lastname = '$update_lastname', address =' $update_address', birthday='$update_birthday', mobileNo='$update_mobileNo',gender='$update_gender', image = '$update_user_image'  WHERE id = ' $update_user_id'");
 
    if($update_query){
       move_uploaded_file($update_user_image_tmp_name, $update_user_image_folder);
       $message[] = 'User updated succesfully';
       header('location:admin.php');
    }else{
       $message[] = 'User could not be updated';
       header('location:admin.php');
    }
 
 }




//UPDATE USER END

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
      $imageDB =$row['image'];
    }
  }

  if ( $roleDB == 'user' || $email == "") :
    header('Location: index.php');
    exit();
  endif;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<div class="container-fluid box">
        <nav class="navbar navbar-expand-sm navbar-light bg-danger  navigation float-end rounded mt-4 me-5">
            <div class="container links">
                <ul class="navbar-nav">
                    <?php 
                        if($email != '' ){
                    ?>
                        <li class="nav-item">
                                <a href="logout.php">Logout</a>
                            </li>
                        <?php
                        } else {
                    ?>
                        <li class="nav-item">
                            <a href="login.php">Login</a>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>

        </nav>
    </div>

    <div class="container-fluid bg-light">
        <div class="container">
            <div class="row ">
                <div class="col col-12 col-sm-12 col-md-4 mt-2 mb-2">
                <a href="index.php"><img class="logo" src="images/logo.png"  alt="" ></a>
                </div>
            </div>
        </div>
    </div>



        <div class="container d-flex justify-content-center">
            <div class="tab my-4">
                <?php 
                    if(isset($_GET['edit_product'])){
                        $edit_product='defaultOpen';
                    } else {
                        $edit_product='';
                    }
                    
                    if (isset($_GET['edit_user'])){
                        $edit_user='defaultOpen';
                    } else {
                        $edit_product='defaultOpen';
                    }
                    
                ?>
                <button class="tablinks btn btn-dark" onclick="openCity(event, 'products')" id=<?php echo $edit_product ?>>Add Products</button>
                <button class="tablinks btn btn-dark" onclick="openCity(event, 'banners')" id=<?php echo $edit_product ?>>Add Banners</button>
                <button class="tablinks btn btn-dark" onclick="openCity(event, 'users')" id=<?php echo $edit_product ?>>List of Users</button>
                <button class="tablinks btn btn-dark" onclick="openCity(event, 'inquiries')">Message Inquiries</button>
                <button class="tablinks btn btn-dark" onclick="openCity(event, 'pending')">Pending Carts</button>
                <button class="tablinks btn btn-dark" onclick="openCity(event, 'transactions')">Successful Transactions</button>
                <button class="tablinks btn btn-dark" onclick="openCity(event, 'add_admin')">Add Admin Accounts</button>
            </div>
        </div>





        <!-- PRODUDCTS-->

        <div id="products" class="tabcontent">
          <div class="row">
                  <section class="py-5">
                    <div class="container">
                    <div class="mb-4">
                          <span class="h3 mb-4"></span>
                          
                      </div>
                      <div class="container">

<div class="row justify-content-center my-5">
    <div class="col col-6 text-center">
        <div class="border border-gray">
            <form action="" method="post" class="add-product-form " enctype="multipart/form-data">
                <h3 class="mt-3">New Product</h3>
                <p>Name of the Product: <input type="text" name="p_name" placeholder="Enter the Product" class="box" required></p>
                <p>Price: <input type="number" name="p_price" min="0" placeholder="Enter the Price" class="box" required>
                <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required></p>
                <label for="watch">Category:</label>
                <select name="category" id="watch">
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                    <option value="Unisex">Unisex</option>
                    <option value="Kids">Kids</option>
                    <option value="Upcoming Release">Upcoming Release</option>
                </select>
                <div class="form-group mx-4">
                    <label class="label d-flex justify-content-start" for="#">Product Description:</label>
                    <textarea name="description" class="form-control" id="message" cols="30" rows="4" placeholder="Enter the Product Description"></textarea>
                </div>
                <div class="mt-2 mb-3">
                    <input type="submit" value="Add" name="add_product" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<section class="display-product-table">

   <table class="table">

      <thead>
         <th colspan="2">Product</th>
         <th>Unit Price</th>
         <th>Category</th>
         <th>Actions</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `products` ORDER BY category");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>₱<?php echo number_format($row['price']); ?></td>
            <td><?php echo $row['category']; ?></td>
            <td>
               <a href="admin.php?delete_product=<?php echo $row['id']; ?>" class="delete-btn btn btn-danger" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i>Delete</a>
               <a href="admin.php?edit_product=<?php echo $row['id']; ?>" class="option-btn btn btn-warning"> <i class="fas fa-edit"></i>Update</a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php

   
   if(isset($_GET['edit_product'])){
      $edit_product_id = $_GET['edit_product'];
      $edit_product_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_product_id ");
      if(mysqli_num_rows($edit_product_query) > 0){
         while($fetch_edit_product = mysqli_fetch_assoc($edit_product_query)){
   ?>
    <div class="admin_update_modal" >
        <form action="" method="post" enctype="multipart/form-data">
           <img src="uploaded_img/<?php echo $fetch_edit_product['image']; ?>" height="200" alt="">
           <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit_product['id']; ?>">
           <br>
           <br>
           <label for="product name" class="d-flex justify-content-start ">Product Name:</label> 
           <input type="text" class="box d-flex justify-content-start" required name="update_p_name" id='product name' value="<?php echo $fetch_edit_product['name']; ?>">
           <label for="price" class="d-flex justify-content-start ">Price:</label> 
           <input type="number" min="0" class="box d-flex justify-content-start" required name="update_p_price" id='price'value="<?php echo $fetch_edit_product['price']; ?>">
           <label class="d-flex justify-content-start" for="watch">Category:</label>
           <select class="d-flex justify-content-start " name="category_update" id="watch">
                    <option value="Men"<?=$fetch_edit_product['category'] == 'Men' ? ' selected="selected"' : '';?>>Men</option>
                    <option value="Women"<?=$fetch_edit_product['category'] == 'Women' ? ' selected="selected"' : '';?>>Women</option>
                    <option value="Unisex"<?=$fetch_edit_product['category'] == 'Unisex' ? ' selected="selected"' : '';?>>Unisex</option>
                    <option value="Kids"<?=$fetch_edit_product['category'] == 'Kids' ? ' selected="selected"' : '';?>>Kids</option>
                    <option value="Upcoming Release"<?=$fetch_edit_product['category'] == 'Upcoming Release' ? ' selected="selected"' : '';?>>Upcoming Release</option>
                </select>
           <input type="file" class="box d-flex justify-content-start" name="update_p_image" required accept="image/png, image/jpg, image/jpeg">
           <div class="form-group">
                    <label class="label d-flex justify-content-start" for="#">Product Description:</label>
                    <textarea name="update_p_description" class="form-control mb-3" id="message" cols="30" rows="4" placeholder="Enter the Product Description"><?php echo $fetch_edit_product['description']; ?></textarea>
           </div>
           <input type="submit" value="Update" name="update_product" class="btn btn-warning">
           <input type="reset" name="cancel" value="Cancel" id="close-edit" class="option-btn btn btn-danger" onclick="document.querySelector('.edit-form-container').style.display = 'none';">
        </form>
    </div>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };

      if(isset($_GET['cancel'])){
        echo "<script>document.querySelector('.edit-form-container').style.display = 'none';</script>";
      }

      ?>

</section>
  </div>
                    </div>
                  </section>
              </div>
        </div>
       
        <!-- PRODUCTS END-->

        <!-- Banner-->

                <div id="banners" class="tabcontent">
          <div class="row">
                  <section class="py-5">
                    <div class="container">
                    <div class="mb-4">
                          <span class="h3 mb-4"></span>
        
                      </div>
                      <div class="container">
                    <div class="row justify-content-center my-5">
                        <div class="col col-6 text-center">
                            <div class="border border-gray">
                                <form action="" method="post" class="add-product-form " enctype="multipart/form-data">
                                    <h3 class="mt-3">New Banner</h3>
                                    <p>Name of the Banner Image: <input type="text" name="b_name" placeholder="Enter the Product" class="box" required></p>
                                    <input type="file" name="b_image" accept="image/png, image/jpg, image/jpeg" class="box" required></p>
                                    <div class="mt-2 mb-3">
                                        <input type="submit" value="Add" name="add_banner" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <section class="display-product-table">

                    <table class="table">

                        <thead>
                            <th>Name</th>
                            <th>Banner Image</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            <?php
                            
                                $select_banner = mysqli_query($conn, "SELECT * FROM `carousel` ORDER BY name");
                                if(mysqli_num_rows($select_banner) > 0){
                                while($row = mysqli_fetch_assoc($select_banner)){
                            ?>

                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                                <td>
                                <a href="admin.php?delete_banner=<?php echo $row['id']; ?>" class="delete-btn btn btn-danger" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i>Delete</a>
                                </td>
                            </tr>

                            <?php
                                };    
                                }else{
                                echo "<div class='empty'>no product added</div>";
                                };
                            ?>
                        </tbody>
                    </table>

                    </section>
                    </div>
                    </div>
                  </section>
              </div>
        </div>
       
        <!-- PRODUCTS END-->
        
        <!-- USERS-->

        <div id="users" class="tabcontent">
          <div class="row">
              <section class="py-5">
                <div class="container">
                <div class="mb-4">
                      <span class="h3 mb-4"></span>
                      
                  </div>
                  <div class="container">

    <div class="atitle py-4">
            <h2>List of Users</h2>
        </div>
    <div class="col-lg-12">
        <div class="spacer"></div>
        <table class="table">
            <thead>
                <tr>
                <th>User Image</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Mobile No</th>
                <th>Actions</th>
                </tr>
            </thead>
           


            <!-- TESTING NEW USER LIST -->

            <tbody>
                <?php
                    $select_users = mysqli_query($conn, "SELECT * FROM `registration` ORDER BY id");
                    if(mysqli_num_rows($select_users) > 0){
                        while($row = mysqli_fetch_assoc($select_users)){
                  ?>
         
                  <tr>
                     <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                     <td><?php echo $row['username']; ?></td>
                     <td><?php echo $row['email']; ?></td>
                     <td><?php echo $row['role']; ?></td>
                     <td><?php echo $row['firstname']; ?></td>
                     <td><?php echo $row['lastname']; ?></td>
                     <td><?php echo $row['address']; ?></td>
                     <td><?php echo $row['mobileNo']; ?></td>
                     <td colspan=2>
                        <a href="admin.php?delete_user=<?php echo $row['id']; ?>" class="delete-btn btn btn-danger pe-4 mb-2" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i>Delete</a>
                        <a href="admin.php?edit_user=<?php echo $row['id']; ?>" class="option-btn btn btn-warning pe-3"> <i class="fas fa-edit"></i>Update</a>
                     </td>
                  </tr>
         
                  <?php
                     };    
                     }else{
                        echo "<div class='empty'>no user added</div>";
                     };
                  ?>
               </tbody>

             <!-- TESTING NEW USER LIST end -->
        </table>
        
        </section>
                
<!-- modal user edit -->

<section class="edit-form-containers">

   <?php

   
   if(isset($_GET['edit_user'])){
      $edit_user_id = $_GET['edit_user'];
      $edit_user_query = mysqli_query($conn, "SELECT * FROM `registration` WHERE id = $edit_user_id ");
      if(mysqli_num_rows($edit_user_query) > 0){
         while($fetch_edit_user = mysqli_fetch_assoc($edit_user_query)){
   ?>
    <div class="admin_update_modal" >
    <div class="divScroll">
        <form action="" method="post" enctype="multipart/form-data">
           <img src="uploaded_img/<?php echo $fetch_edit_user['image']; ?>" height="200" alt="">
           <input type="hidden" name="update_user_id" value="<?php echo $fetch_edit_user['id']; ?>">
           <br>
           <br>
           <label for="username">Username:</label> 
           <input type="text" class="box" required name="update_username" id='username' value="<?php echo $fetch_edit_user['username'];?>">
           <label for="email">Email:</label> 
           <input type="text" class="box" required name="update_email" id='email'value="<?php echo $fetch_edit_user['email']; ?>">
           <label for="password">First Name:</label> 
           <input type="text" class="box" required name="firstname_update" id='firstname'value="<?php echo $fetch_edit_user['firstname']; ?>">
           <label for="password">Last Name:</label> 
           <input type="text" class="box" required name="lastname_update" id='lastname'value="<?php echo $fetch_edit_user['lastname']; ?>">
           <label for="password">Address:</label> 
           <input type="text" class="box" required name="address_update" id='address'value="<?php echo $fetch_edit_user['address']; ?>">
           <label for="password">Mobile No:</label> 
           <input type="text" class="box" required name="mobileNo_update" id='mobileNo'value="<?php echo $fetch_edit_user['mobileNo']; ?>">
           <input type="file" class="box" name="update_user_image" required accept="image/png, image/jpg, image/jpeg">
     
           <input type="submit" value="Update" name="update_users" class="btn btn-warning">
           <input type="reset" name="cancel" value="Cancel" id="close-edit" class="option-btn btn btn-danger" onclick="document.querySelector('.edit-form-containers').style.display = 'none';">
        </form>
         </div>
    </div>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-containers').style.display = 'flex';</script>";
      };

      if(isset($_GET['cancel'])){
        echo "<script>document.querySelector('.edit-form-containers').style.display = 'none';</script>";
      }

       ?>

</section>
<!-- modal user end-->
</div>
</div>
              </section>
          </div>
        </div>


        <!-- MESSAGE INQUIRIES -->

        <div id="inquiries" class="tabcontent">
          <div class="row">
            <section class="py-5">
              <div class="container">
              <div class="mb-4">
                    <span class="h3 mb-4"></span>
                </div>
                <div class="container">

    <div class="atitle py-4">
        <h2>Message Inquiries</h2>
    </div>
    <div class="col-lg-12">
        <div class="spacer"></div>
        <table class="table">
            <thead>
                <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $res=mysqli_query($conn,"select * from inquiries");
                    while($row=mysqli_fetch_array($res))
                    {
                    echo "<tr>";
                    echo "<td>"; echo $row["name"]; echo "</td>";
                    echo "<td>"; echo $row["email"]; echo "</td>";
                    echo "<td>"; echo $row["subject"]; echo "</td>";
                    echo "<td>"; echo $row["message"]; echo "</td>";
                    echo "<td>"; ?><button type="button" class="btn btn-danger redbtn " onclick="if (confirm('Are you sure you want to delete this message?')) {
                        location.href = 'deleteInquiries.php?id=<?php echo $row['id']; ?> ';}">Delete</button><?php echo "</td>";
                    echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <div class="spacer"></div>
    </div>
</div>
              </div>
            </section>
          </div>
        </div>
        
        <!-- MESSAGE INQUIRIES END -->
        
        <!-- PENDING CARTS -->
        <div id="pending" class="tabcontent">
          <div class="row">
            <section class="py-5">
              <div class="container">
              <div class="mb-4">
                    <span class="h3 mb-4"></span>
                </div>
                <div class="container">
    <div class="atitle py-4">
        <h2>Pending Carts</h2>
    </div>
    <div class="col-lg-12">
        <div class="spacer"></div>
        <table class="table">
            <thead>
                <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Email</th>
                <th>Payment Status</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $res=mysqli_query($conn,"select * from cart");
                    while($row=mysqli_fetch_array($res))
                    {
                        if($row['payment'] == 'Unpaid'){
                        echo "<tr>";
                        echo "<td>"; echo $row["name"]; echo "</td>";
                        ?>
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                        <?php
                        echo "<td> ₱"; echo number_format($row["price"]); echo "</td>";
                        echo "<td>"; echo $row["quantity"]; echo "</td>";
                        echo "<td> ₱"; echo number_format($row["price"] * $row["quantity"]); echo "</td>";
                        echo "<td>"; echo $row["email"]; echo "</td>";
                        echo "<td>"; echo $row["payment"]; echo "</td>";
                        echo "<td>"; ?><button type="button" class="btn btn-danger redbtn " onclick="if (confirm('Are you sure you want to delete this Unpaid Item?')) {
                        location.href = 'deletePending.php?id=<?php echo $row['id']; ?> ';}">Delete</button><?php echo "</td>";
                        echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
        <div class="spacer"></div>
    </div>
</div>
              </div>
            </section>
          </div>
        </div>
       
       <!-- PENDING CARTS END -->
       
       <!-- SUCCESFUL TRANSACTIONS -->
        <div id="transactions" class="tabcontent">
          <div class="row">
            <section class="py-5">
              <div class="container">
              <div class="mb-4">
                    <span class="h3 mb-4"></span>
              </div>
              <div class="container mb-5">
    <div class="atitle py-4">
        <h2>Successful Transactions</h2>
    </div>
    <div class="col-lg-12">
        <div class="spacer"></div>
        <table class="table">
            <thead>
                <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Email</th>
                <th>Payment Status</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $res=mysqli_query($conn,"select * from cart");
                    while($row=mysqli_fetch_array($res))
                    {
                        if($row['payment'] == 'Paid'){
                        echo "<tr>";
                        echo "<td>"; echo $row["name"]; echo "</td>";
                        ?>
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                        <?php
                        echo "<td> ₱"; echo number_format($row["price"]); echo "</td>";
                        echo "<td>"; echo $row["quantity"]; echo "</td>";
                        echo "<td> ₱"; echo number_format($row["price"] * $row["quantity"]); echo "</td>";
                        echo "<td>"; echo $row["email"]; echo "</td>";
                        echo "<td>"; echo $row["payment"]; echo "</td>";
                        echo "<td>"; ?><button type="button" class="btn btn-danger redbtn " onclick="if (confirm('Are you sure you want to delete this Paid Item?')) {
                            location.href = 'deleteSuccessful.php?id=<?php echo $row['id']; ?> ';}">Delete</button><?php echo "</td>";
                        echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
        <div class="spacer"></div>
    </div>
</div>
              </div>
            </section>
          </div>    
        </div>

        <!-- SUCCESFUL TRANSACTIONS -->
        <div id="add_admin" class="tabcontent">
          <div class="row">
            <section class="">
              <div class="container">
              <div class="mb-4">
                    <span class="h3 mb-4"></span>
              </div>
              <div class="container mb-5">
                    <div class="atitle py-4 ms-3">
                        <h2>Add Admin Account</h2>
                    </div>
                    <div class="col-lg-12">
                        <form class="" action="" method="post">
                            <div class="d-flex flex-row align-items-center ">
                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="text" id="username" name="username" class="form-control mb-3" placeholder="Username"/>
                            </div>
                            </div>

                            <div class="d-flex flex-row align-items-center">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="email" id="email" name="email" class="form-control mb-3" placeholder="Email" />
                            </div>
                            </div>

                            <div class="d-flex flex-row align-items-center">
                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="text" id="First Name" name="firstname" class="form-control mb-3" placeholder="First Name" />
                            </div>
                            </div>

                            <div class="d-flex flex-row align-items-center ">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="text" id="Last Name" name="lastname" class="form-control mb-3" placeholder="Last Name" />
                            </div>
                            </div>

                            <div class="d-flex flex-row align-items-center ">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="password" id="password" name="password" class="form-control mb-3" placeholder="Password" />
                            </div>
                            </div>

                            <div class="d-flex flex-row align-items-center ">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="password" id="confirm password" name="cpassword" class="form-control mb-3" placeholder="Confirm Password" />
                            </div>
                            </div>

                            <div class="form-check d-flex justify-content-center me-3 mb-3">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required />
                            <label class="form-check-label" for="form2Example3">
                            I agree all statements in <a href="#!">Terms and Condition</a>
                            </label>
                            </div>

                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <input type="submit" name="submit" class="btn btn-primary btn-lg"></input>
                            </div>

                        </form>
                    </div>
                </div>
              </div>
            </section>
          </div>    
        </div>
        </div>
    </div>
</div>    
<!-- SUCCESFUL TRANSACTIONS END -->



<!--TABBED CONTENT END -->

            <!-- Top Selling -->
            <div class="container col-12">
              <div class="card top-selling overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body pb-0">
                  <h5 class="card-title">Top Selling <span>| Today</span></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Preview</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Sold</th>
                        <th scope="col">Revenue</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#"><img src="assets/img/product-1.jpg" alt=""></a></th>
                        <td><a href="#" class="text-primary fw-bold">Ut inventore ipsa voluptas nulla</a></td>
                        <td>$64</td>
                        <td class="fw-bold">124</td>
                        <td>$5,828</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#"><img src="assets/img/product-2.jpg" alt=""></a></th>
                        <td><a href="#" class="text-primary fw-bold">Exercitationem similique doloremque</a></td>
                        <td>$46</td>
                        <td class="fw-bold">98</td>
                        <td>$4,508</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#"><img src="assets/img/product-3.jpg" alt=""></a></th>
                        <td><a href="#" class="text-primary fw-bold">Doloribus nisi exercitationem</a></td>
                        <td>$59</td>
                        <td class="fw-bold">74</td>
                        <td>$4,366</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#"><img src="assets/img/product-4.jpg" alt=""></a></th>
                        <td><a href="#" class="text-primary fw-bold">Officiis quaerat sint rerum error</a></td>
                        <td>$32</td>
                        <td class="fw-bold">63</td>
                        <td>$2,016</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#"><img src="assets/img/product-5.jpg" alt=""></a></th>
                        <td><a href="#" class="text-primary fw-bold">Sit unde debitis delectus repellendus</a></td>
                        <td>$79</td>
                        <td class="fw-bold">41</td>
                        <td>$3,239</td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->



    <!-- Footer  -->
    <?php include 'footer.php' ?>

    <script>
  
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }


  document.getElementById("defaultOpen").click();
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