<?php session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";

    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if ($user['is_active'] == 1) {  
            session_start(); // Add session_start() at the beginning to start a session
            
            // Store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];
            
            if ($user['user_role'] == 2) { // Check if user_role is 2 (admin)
                $_SESSION['user_role'] = 2;
                header("Location: admin/index.php");
            } elseif ($user['user_role'] == 1) { // Check if user_role is 1 (user)
                $_SESSION['user_role'] = 1;
                header("Location: user/index.php");
            } else {
                $errorMsg = "Login failed. User role not recognized.";
            }
            
            exit(); // Terminate the script after redirection
        } else {
            $errorMsg = "Login failed. User is not active.";
        }
    } else {
        $errorMsg = "Login failed. Invalid email or password.";
    }
}
$conn->close();


?>




  
  <div class="card">
    <div class="card-header"> Login </div>
    <div class="card-body">

   <?php  if(isset($errorMsg)) { ?>

<div class="bg-danger/25 text-danger text-sm rounded-md p-3" role="alert">
                              
                              <?php echo $errorMsg ;?>
                          </div>


<?php  }

?>


  <form method="post" action='<?php echo $_SERVER["PHP_SELF"];?>'>
    <div class="row mb-4">
        <div class="col">
            <input type="text" class="form-control" placeholder="Email" name="email" required>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <input type="submit" name="login" value="Login" class="btn btn-primary btn-lg">
        </div>
    </div>
</form>
</div> 
    <div class="card-footer">Design and Developed By MS</div>
  </div>
</div>