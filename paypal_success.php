<?php
include 'components/connect.php'; // Ensure this includes your database connection

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
   exit; // Always exit after a header redirect
}

if(isset($_POST['submit'])){
   // Sanitize inputs
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $method = filter_var($_POST['method'], FILTER_SANITIZE_STRING);
   $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   // Basic validation
   $errors = [];
   if(empty($address)){
      $errors[] = 'Please add your address!';
   }

   if(empty($errors)){
      if($method === 'paypal') {
         // Redirect to PayPal payment page
         $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
         $paypal_email = 'your_paypal_email@example.com'; // Replace with your PayPal business email
         $return_url = 'http://yourwebsite.com/paypal_success.php'; // Replace with your return URL after PayPal payment

         $paypal_params = array(
            'cmd' => '_xclick',
            'business' => $paypal_email,
            'item_name' => 'Order Payment',
            'amount' => $total_price,
            'currency_code' => 'USD', // Adjust currency code as necessary
            'custom' => $user_id, // Pass user ID or any custom data
            'return' => $return_url,
            'cancel_return' => 'http://yourwebsite.com/paypal_cancel.php', // URL if user cancels payment
         );

         // Redirect to PayPal
         header('Location: ' . $paypal_url . '?' . http_build_query($paypal_params));
         exit;
      } else {
         // Handle other payment methods here (e.g., credit card, cash on delivery)
         try {
            // Insert order into database
            $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

            // Delete cart items after successful order
            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);

            $message = 'Order placed successfully!';
         } catch(PDOException $e) {
            $message = 'Error: ' . $e->getMessage(); // Handle database errors here
         }
      }
   } else {
      $message = implode('<br>', $errors); // Display validation errors
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Header -->
<?php include 'components/user_header.php'; ?>

<div class="heading">
   <h3>Checkout</h3>
   <p><a href="home.php">Home</a> / Checkout</p>
</div>

<section class="checkout">
   <h1 class="title">Order Summary</h1>

   <form action="" method="post">
      <div class="cart-items">
         <h3>Cart Items</h3>
         <?php
         $grand_total = 0;
         $cart_items = [];
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].')';
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
               ?>
               <p><span class="name"><?= $fetch_cart['name']; ?></span><span class="price">$<?= $fetch_cart['price']; ?> x <?= $fetch_cart['quantity']; ?></span></p>
               <?php
            }
         } else {
            echo '<p class="empty">Your cart is empty!</p>';
         }
         ?>
         <p class="grand-total"><span class="name">Grand Total:</span><span class="price">$<?= $grand_total; ?></span></p>
         <a href="cart.php" class="btn">View Cart</a>
      </div>

      <input type="hidden" name="total_products" value="<?= implode(', ', $cart_items); ?>">
      <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
      <input type="hidden" name="name" value="<?= $name; ?>">
      <input type="hidden" name="number" value="<?= $number; ?>">
      <input type="hidden" name="email" value="<?= $email; ?>">
      <input type="hidden" name="address" value="<?= $address; ?>">

      <div class="user-info">
         <h3>Your Info</h3>
         <p><i class="fas fa-user"></i><span><?= $name; ?></span></p>
         <p><i class="fas fa-phone"></i><span><?= $number; ?></span></p>
         <p><i class="fas fa-envelope"></i><span><?= $email; ?></span></p>
         <a href="update_profile.php" class="btn">Update Info</a>
         <h3>Delivery Address</h3>
         <p><i class="fas fa-map-marker-alt"></i><span><?= !empty($address) ? $address : 'Please enter your address'; ?></span></p>
         <a href="update_address.php" class="btn">Update Address</a>
         <select name="method" class="box" required>
            <option value="" disabled selected>Select Payment Method</option>
            <option value="cash on delivery">Cash on Delivery</option>
            <option value="credit card">Credit Card</option>
            <option value="paytm">Paytm</option>
            <option value="paypal">PayPal</option>
         </select>
         <input type="submit" value="Place Order" class="btn <?php echo empty($address) ? 'disabled' : ''; ?>" style="width:100%; background:var(--red); color:var(--white);" name="submit">
      </div>
   </form>
   <?php if(isset($message)): ?>
      <div class="message">
         <?= $message; ?>
      </div>
   <?php endif; ?>
</section>

<!-- Footer -->
<?php include 'components/footer.php'; ?>

<!-- Custom JS -->
<script src="js/script.js"></script>

</body>
</html>
