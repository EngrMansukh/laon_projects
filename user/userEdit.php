<?php
require_once 'db.php';

$user_id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($query);
$row = $result->fetch_row();
 // Assuming that the "email" column is in the third position (index 2)

 if (isset($_POST['updateUser'])) {
    // Retrieve form inputs
   // Assuming you have a hidden input for the user's ID
    $user_name = $_POST['user_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate that none of the required fields are empty
        // Check if the email already exists for other users (excluding the current user)
        $check_query = "SELECT * FROM users WHERE email = '$email' AND id <> $user_id";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            // Email already exists for another user, show an error message
            $msgError = "Error: Email already exists for another user. Please choose a different email.";
        } else {
            // Perform the database update
            $query = "UPDATE users SET user_name = '$user_name', first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password' WHERE id = $user_id";

            if ($conn->query($query) === TRUE) {
                $msgSuccess = "User updated successfully!";
            } else {
                $msgError = "Error: " . $query . "<br>" . $conn->error;
            }
        }
    
}

$conn->close();
?>

<?php     require_once('header.php') ?>

            <main class="p-6">

<!-- Page Title Start -->
<div class="flex justify-between items-center mb-6">
    <h4 class="text-slate-900 text-lg font-medium">Edit User</h4>


</div>
<!-- Page Title End -->

<div class="flex flex-col gap-6">
    <div class="card">
      <?php 
      if(isset($msgSuccess)) { ?>

<div class="bg-success/25 text-success text-sm rounded-md p-3" role="alert">
                                    <span class="font-bold">Success</span> <?php echo $msgSuccess ;?>
                                </div>
     <?php  } if(isset($msgError)) { ?>

      <div class="bg-danger/25 text-danger text-sm rounded-md p-3" role="alert">
                                    <span class="font-bold">Danger</span> 
                                    <?php echo $msgError ;?>
                                </div>


    <?php  }
      
      ?>
        <div class="p-6">
         

            
              <form method="post" action='<?php echo $_SERVER["PHP_SELF"]."?id=".$user_id;?>'>
              
              <div class="row mb-4">
      <div class="col-md-12 pt-3">
        <input type="text" class="form-control" placeholder="User Name"
         name="user_name" required value="<?=  $row[1];?>">
      </div>    
      <div class="col-md-12 pt-3">
        <input type="text" class="form-control" placeholder="First Name" 
        name="first_name" required value="<?=  $row[2];?>">
      </div>
      <div class="col-md-12 pt-3">
        <input type="text" class="form-control" placeholder="Last Name" 
        name="last_name" required value="<?=  $row[3];?>">
      </div>
      <div class="col-12 pt-3">
        <input type="email" class="form-control" placeholder="Email" name="email"
         required value="<?=  $row[4];?>">
      </div>  
      <div class="col-12 pt-3">
        <input type="text" class="form-control" placeholder="Password" 
        name="password" required value="<?=  $row[5];?>">
      </div>
    </div>

    <div class="row">
         <div class="col">
          <input type="submit" name="updateUser" value="Submit" class="btn btn-primary btn-lg">
         </div>
      </div>  
       
              </form>
           
        </div>
    </div> <!-- end card -->

</div>

</main>

<?php     require_once('footer.php') ?>