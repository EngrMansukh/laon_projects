<?php     require_once('header.php') ;

// SQL query to fetch records and calculate 'Remaining'
$sql_row = "SELECT l.user_id, l.create_date, u.user_name, SUM(l.deposite) AS Deposit, SUM(l.withdraw) AS Withdraw,
        SUM(l.deposite - l.withdraw) AS Remaining
        FROM loan l 
        LEFT JOIN users u ON l.user_id = u.id 
        GROUP BY l.user_id, u.user_name, l.create_date
        HAVING Deposit > Withdraw
        ORDER BY l.user_id";

// Execute the query
$result = $conn->query($sql_row);

  


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

       <th> SNO</th>
      <th>Username</th>
      <th>Deposit</th>
      <th>Withdraw</th>
     
      <th>Created Date</th>
      </tr>
    </thead>
    <tbody>
<?php 
   $count =1;
    while ($sql_row = $result->fetch_assoc()) {
   
  ?>
      <tr>
      <td><?= $count++; ?></td>

        <td><?= $sql_row ['user_name']; ?></td>
  
        <td><?=  $sql_row["Deposit"]; ?></td>
    
        <td><?= $sql_row ['Withdraw']; ?></td>
  
        

        <td><?= $sql_row ['create_date']; ?></td>
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