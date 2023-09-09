<?php     require_once('header.php') ;

$user_id = $_SESSION['user_id'];

// Construct the SQL query
$query = "SELECT * FROM users WHERE id = $user_id";
// Execute the query
$result = $conn->query($query);
$row = $result->fetch_row();


?>



            <main class="p-6">

<!-- Page Title Start -->
<div class="flex justify-between items-center mb-6">
    <h4 class="text-slate-900 text-lg font-medium">Users Info</h4>


</div>
<!-- Page Title End -->

<div class="flex flex-col gap-6">
    <div class="card">

        <div class="p-6">
        <table class="table table-bordered">
    <thead>
      <tr>
        <th>User Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Edit</th>

      </tr>
    </thead>
    <tbody>

          
      <tr>
        <td><?=  $row[1];?></td>
        <td><?=  $row[4];?></td>
        <td><?=  $row[5];?></td>
        <td><a href="userEdit.php?id=<?= $user_id; ?>" class="btn btn-success"> Edit </a> </td>

        
      </tr>
      
   <?php     ?>

     
    </tbody>
  </table>

           
        </div>
        <?php  ?>
    </div> <!-- end card -->

</div>

</main>

<?php     require_once('footer.php') ?>