<?php     require_once('header.php') ;

$query = "SELECT u.user_name, l.loan_type, l.loan_amount,l.create_date  
              FROM users u
              INNER JOIN loan l ON u.id = l.user_id
              WHERE u.is_Active = 1";

$result = $conn->query($query);

  


?>



            <main class="p-6">

<!-- Page Title Start -->
<div class="flex justify-between items-center mb-6">
    <h4 class="text-slate-900 text-lg font-medium">Loan List</h4>


</div>
<!-- Page Title End -->

<div class="flex flex-col gap-6">
    <div class="card">

        <div class="p-6">
      <?php   if ($result->num_rows > 0) { ?>
        <table class="table table-bordered">
    <thead>
      <tr>
      <th>User Name</th>
                    <th>Loan Type</th>
                    <th>Loan Amount</th>
                    <th>Created Loan Date</th>
      </tr>
    </thead>
    <tbody>
<?php 
    while ($row = $result->fetch_assoc()) {
  ?>
      <tr>
        <td><?php echo $row['user_name']; ?></td>
        <td><?php echo $row['loan_type']; ?></td>
        <td><?php echo $row['loan_amount']; ?></td>
        <td><?php echo $row['create_date']; ?></td>
      </tr>
    
   <?php     
    }
     ?>
    </tbody>
  </table>

           
        </div>
        <?php } ?>
    </div> <!-- end card -->

</div>

</main>

        <?php     require_once('footer.php') ?>