<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){

   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_status->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Placed Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   
   <style>
      table {
         width: 100%;
         border-collapse: collapse;
      }

      table, th, td {
         border: 1px solid black;
      }

      th, td {
         padding: 8px;
         text-align: left;
      }

      th {
         background-color: #f2f2f2;
      }

      .search-container {
         display: flex;
         gap: 10px;
         flex-wrap: wrap;
         margin-bottom: 20px;
      }

      .search-container input {
         flex: 1;
         padding: 5px;
         box-sizing: border-box;
      }
   </style>
</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- placed orders section starts  -->

<section class="placed-orders">

   <h1 class="heading">Placed Orders</h1>

   <div class="search-container">
      <input type="text" id="searchUserId" onkeyup="searchTable(0)" placeholder="Search by User ID">
      <input type="text" id="searchName" onkeyup="searchTable(2)" placeholder="Search by Name">
      <input type="text" id="searchEmail" onkeyup="searchTable(3)" placeholder="Search by Email">
      <input type="text" id="searchNumber" onkeyup="searchTable(4)" placeholder="Search by Number">
      <input type="text" id="searchAddress" onkeyup="searchTable(5)" placeholder="Search by Address">
      <input type="text" id="searchTotalProducts" onkeyup="searchTable(6)" placeholder="Search by Total Products">
      <input type="text" id="searchTotalPrice" onkeyup="searchTable(7)" placeholder="Search by Total Price">
      <input type="text" id="searchPaymentMethod" onkeyup="searchTable(8)" placeholder="Search by Payment Method">
   </div>

   <table id="ordersTable">
      <thead>
         <tr>
            <th>User ID</th>
            <th>Placed On</th>
            <th>Name</th>
            <th>Email</th>
            <th>Number</th>
            <th>Address</th>
            <th>Total Products</th>
            <th>Total Price</th>
            <th>Payment Method</th>
            <th>Payment Status</th>
            <th>Actions</th>
         </tr>
      </thead>
      <tbody>
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
      ?>
         <tr>
            <td><?= $fetch_orders['user_id']; ?></td>
            <td><?= $fetch_orders['placed_on']; ?></td>
            <td><?= $fetch_orders['name']; ?></td>
            <td><?= $fetch_orders['email']; ?></td>
            <td><?= $fetch_orders['number']; ?></td>
            <td><?= $fetch_orders['address']; ?></td>
            <td><?= $fetch_orders['total_products']; ?></td>
            <td>$<?= $fetch_orders['total_price']; ?>/-</td>
            <td><?= $fetch_orders['method']; ?></td>
            <td>
               <form action="" method="POST">
                  <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                  <select name="payment_status" class="drop-down">
                     <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
                     <option value="pending">pending</option>
                     <option value="completed">completed</option>
                  </select>
            </td>
            <td>
                  <div class="flex-btn">
                     <input type="submit" value="update" class="btn" name="update_payment">
                     <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
                  </div>
               </form>
            </td>
         </tr>
      <?php
         }
      } else {
         echo '<tr><td colspan="11" class="empty">no orders placed yet!</td></tr>';
      }
      ?>
      </tbody>
   </table>

</section>

<!-- placed orders section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

<script>
   function searchTable(columnIndex) {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("search" + columnIndex);
      filter = input.value.toLowerCase();
      table = document.getElementById("ordersTable");
      tr = table.getElementsByTagName("tr");

      for (i = 1; i < tr.length; i++) {
         tr[i].style.display = "none";
         td = tr[i].getElementsByTagName("td")[columnIndex];
         if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
               tr[i].style.display = "";
            }
         }
      }
   }

   // Set unique IDs for each search input field
   document.getElementById("searchUserId").id = "search0";
   document.getElementById("searchName").id = "search2";
   document.getElementById("searchEmail").id = "search3";
   document.getElementById("searchNumber").id = "search4";
   document.getElementById("searchAddress").id = "search5";
   document.getElementById("searchTotalProducts").id = "search6";
   document.getElementById("searchTotalPrice").id = "search7";
   document.getElementById("searchPaymentMethod").id = "search8";
</script>

</body>
</html>
