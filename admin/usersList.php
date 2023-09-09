<?php     require_once('header.php') ;

//$role_id = 1; // Change this value to the desired role ID
$query = "SELECT * FROM users WHERE is_Active = 1 AND user_role =1"; // Replace "role_id" with the actual column name
$result = $conn->query($query);
//print_r($result);
$activeUsers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $activeUsers[] = $row;
    }
} else {
    $msgError = "No active users found.";
}

$conn->close();


?>



            <main class="p-6">

<!-- Page Title Start -->
<div class="flex justify-between items-center mb-6">
    <h4 class="text-slate-900 text-lg font-medium">Users List</h4>


</div>
<!-- Page Title End -->

<div class="flex flex-col gap-6">
    <div class="card">
   
    <?php if (isset($msgError)) { ?>
<div class="bg-danger/25 text-danger text-sm rounded-md p-3" role="alert">
                             
                              <?php echo $msgError ;?>
                          </div>


<?php  } else { ?>
        <div class="p-6">
        <?php if (isset($_GET['msg'])) { ?>

<div class="bg-danger/25 text-danger text-sm rounded-md p-3" role="alert" id="alert">
    <?php echo "User Deleted Successfully! "; ?>
</div> <br>

<script>
    setTimeout(function() {
        document.getElementById('alert').style.display = 'none';
    }, 2000); // Hide the alert after 10 seconds (10000 milliseconds)
</script>

<?php } ?>

        <table class="table table-bordered">
    <thead>
      <tr>
        <th>User Name</th>
        <th>Email</th>
        <th>Password</th>
        <th colspan="2"> Action</th>
      </tr>
    </thead>
    <tbody>

   <?php foreach ($activeUsers as $user) { ?>
 
      <tr>
        <td><?= $user['user_name']; ?></td>
        <td><?= $user['email']; ?></td>
        <td><?= $user['password']; ?></td>
        <td><a href="userEdit.php?id=<?= $user['id']; ?>" class="btn btn-success"> Edit </a> </td>
        <td><a href="userDelete.php?id=<?= $user['id']; ?>" class="btn btn-danger"> Delete </a></td>
      </tr>
      
   <?php     } ?>

     
    </tbody>
  </table>

           
        </div>
        <?php } ?>
    </div> <!-- end card -->

</div>

</main>

        <?php     require_once('footer.php') ?>