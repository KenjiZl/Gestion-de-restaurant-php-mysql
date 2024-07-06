<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

$search_query = '';
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .box-container {
         margin-top: 20px;
      }

      .box-container table {
         width: 100%;
         border-collapse: collapse;
      }

      .box-container th, .box-container td {
         border: 1px solid #ddd;
         padding: 10px;
         text-align: left;
      }

      .box-container th {
         background-color: #f2f2f2;
      }

      .empty {
         text-align: center;
         margin-top: 20px;
         color: #888;
      }
   </style>
</head>
<body>

<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Orders</h3>
   <p><a href="home.php">Home</a> <span>/ Orders</span></p>
</div>

<section class="orders">

   <h1 class="title">Your Orders</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">Please login to see your orders</p>';
      }else{
         $search_query = "%$search_query%";
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? AND (name LIKE ? OR email LIKE ? OR number LIKE ?)");
         $select_orders->execute([$user_id, $search_query, $search_query, $search_query]);
         if($select_orders->rowCount() > 0){
            ?>
            <table>
               <thead>
                  <tr>
                     <th>Placed On</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Number</th>
                     <th>Address</th>
                     <th>Payment Method</th>
                     <th>Your Orders</th>
                     <th>Total Price</th>
                     <th>Payment Status</th>
                  </tr>
               </thead>
               <tbody>
               <?php
               while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                  ?>
                  <tr>
                     <td><?= htmlspecialchars($fetch_orders['placed_on']); ?></td>
                     <td><?= htmlspecialchars($fetch_orders['name']); ?></td>
                     <td><?= htmlspecialchars($fetch_orders['email']); ?></td>
                     <td><?= htmlspecialchars($fetch_orders['number']); ?></td>
                     <td><?= htmlspecialchars($fetch_orders['address']); ?></td>
                     <td><?= htmlspecialchars($fetch_orders['method']); ?></td>
                     <td><?= htmlspecialchars($fetch_orders['total_products']); ?></td>
                     <td>$<?= htmlspecialchars($fetch_orders['total_price']); ?>/-</td>
                     <td style="color:<?= $fetch_orders['payment_status'] == 'pending' ? 'red' : 'green'; ?>">
                        <?= htmlspecialchars($fetch_orders['payment_status']); ?>
                     </td>
                  </tr>
                  <?php
               }
               ?>
               </tbody>
            </table>
            <?php
         }else{
            echo '<p class="empty">No orders found!</p>';
         }
      }
   ?>

   </div>

</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
