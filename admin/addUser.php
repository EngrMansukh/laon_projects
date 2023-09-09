<?php
// Assuming you have a database connection established here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['adduser'])) {
    // Retrieve form inputs
    $user_name = $_POST['user_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validate that none of the required fields are empty
    if (!empty($user_name) && !empty($first_name) && !empty($last_name) && !empty($email) && !empty($password)) {
        // Check if the email already exists
        $check_query = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($check_query);
        
        if ($result->num_rows > 0) {
            // Email already exists, show an error message
            $msgError = "Error: Email already exists. Please choose a different email.";
        } else {
            // Perform database insertion
            $query = "INSERT INTO users (user_name, first_name, last_name, email, password) VALUES ('$user_name', '$first_name', '$last_name', '$email', '$password')";

            if ($conn->query($query) === TRUE) {
                $msgSuccess = "User added successfully!";
            } else {
                $msgError = "Error: " . $query . "<br>" . $conn->error;
            }
        }
    } else {
        $msgError = "Please fill in all required fields and select a valid loan type.";
    }
}

$conn->close();
?>

<?php     require_once('header.php') ?>

            <main class="p-6">

<!-- Page Title Start -->
<div class="flex justify-between items-center mb-6">
    <h4 class="text-slate-900 text-lg font-medium">Add User</h4>


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
         

            
              <form method="post" action='<?php echo $_SERVER["PHP_SELF"];?>'>
              
              <div class="row mb-4">
      <div class="col-md-12 pt-3">
        <input type="text" class="form-control" placeholder="User Name" name="user_name" required>
      </div>    
      <div class="col-md-12 pt-3">
        <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
      </div>
      <div class="col-md-12 pt-3">
        <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
      </div>
      <div class="col-12 pt-3">
        <input type="email" class="form-control" placeholder="Email" name="email" required>
      </div>  
      <div class="col-12 pt-3">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
      </div>
    </div>

    <div class="row">
         <div class="col">
          <input type="submit" name="adduser" value="Submit" class="btn btn-primary btn-lg">
         </div>
      </div>  
       
              </form>
           
        </div>
    </div> <!-- end card -->

</div>

</main>

<?php     require_once('footer.php') ?>