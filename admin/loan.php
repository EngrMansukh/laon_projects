<?php
// Assuming you have a database connection established here
require_once "db.php";
$query = "SELECT * FROM users WHERE is_Active  AND user_role = 1"; // Change the column name as needed
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $activeUsers[] = $row;
    }
} else {
    $msgError = "No active users found.";
}



// ... (your database connection code and other initialization)

// Handle loan application form submission
if (isset($_POST['loanAdd'])) {
    // Retrieve form inputs
    $loan_type = $_POST['loan_type'];
    $user_id = $_POST['user_id'];
    $deposit_amount = $_POST['deposite'];

    // Select the user's current amount
    $querySelect = "SELECT amount FROM users WHERE id = $user_id";
    $result = $conn->query($querySelect);

    if ($result) {
        $row = $result->fetch_assoc();
        $current_amount = $row['amount'];

        // Calculate the new amount
        $new_amount = $current_amount + $deposit_amount;

        // Update the user's amount field
        $updateUserQuery = "UPDATE users SET amount = $new_amount WHERE id = $user_id";

        if ($conn->query($updateUserQuery) === TRUE) {
            // The user's amount has been updated, now insert the loan record
            $query = "INSERT INTO loan (loan_type, user_id, deposite) VALUES ('$loan_type', $user_id, $deposit_amount)";

            if ($conn->query($query) === TRUE) {
                $msgSuccess = "Loan added successfully!";
            } else {
                $msgError = "Error: " . $conn->error;
            }
        } else {
            $msgError = "Error updating user's amount: " . $conn->error;
        }
    } else {
        $msgError = "Error fetching user's current amount: " . $conn->error;
    }
}


 






$conn->close();
?>

<?php     require_once('header.php') ?>

            <main class="p-6">

<!-- Page Title Start -->
<div class="flex justify-between items-center mb-6">
    <h4 class="text-slate-900 text-lg font-medium">Add Loan</h4>


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
          
      <div class="col-md-12 pt-2">
      <div class="form-group">
  <label for="sel1">Loan Type:</label>
  <select class="form-control" id="sel1" name="loan_type">
    <option value="Home Loan"> Home Loan</option>
    <option value="Car Loan"> Car Loan</option>
    <option value="House Loan"> House   Loan</option>

  </select>
</div>
      </div>
      <div class="col-md-12 pt-2">
      <div class="form-group">
  <label for="sel1">Select Users </label>
  <select class="form-control" id="sel1" name="user_id">
  <?php foreach ($activeUsers as $user) { ?>
    <option value="<?php echo $user['id']; ?>"> <?php echo $user['user_name']; ?> </option>
 
  <?php } ?>
  </select>
</div>
      </div>
      <div class="col-12 pt-2">
      <label for="sel1">Loan Amount </label>
        <input type="number" class="form-control"  name="deposite" required>
      </div>  
    
    </div>

    <div class="row">
         <div class="col">
          <input type="submit" name="loanAdd" value="Submit" class="btn btn-primary btn-lg">
         </div>
      </div>  
       
              </form>
           
        </div>
    </div> <!-- end card -->

</div>

</main>

<?php     require_once('footer.php') ?>