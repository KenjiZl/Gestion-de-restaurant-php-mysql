<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header" style="background-color:#222227">

   <section class="flex">

      <a href="home.php" class="logo"><a href="home.php" class="navbar-brand">
                    <img src="./images/logo.png" alt="Restaurant Logo" style="width: 150px;">
                </a></a>

      <nav class="navbar" >
         <a href="home.php"style="color:white">home</a>
         <a href="about.php"style="color:white">about</a>
         <a href="menu.php"style="color:white">menu</a>
         <a href="orders.php"style="color:white">orders</a>
         <a href="contact.php"style="color:white">contact</a>
      </nav>

      <div class="icons">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search" style="color:white"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart" style="color:white"></i><span style="color:white">(<?= $total_cart_items; ?>)</span> </a>
         <div id="user-btn" class="fas fa-user"style="color:white"></div>
         <div id="menu-btn" class="fas fa-bars"style="color:white"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn" style="color:white">profile</a>
            <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         </div>
         <p class="account">
            <a href="login.php">login</a> or
            <a href="register.php">register</a>
         </p> 
         <?php
            }else{
         ?>
            <p class="name">please login first!</p>
            <a href="login.php" class="btn">login</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>

