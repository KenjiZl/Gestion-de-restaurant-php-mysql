<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>menu</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      body{
         background-color: orange;
      }

      .products {
         max-width: 1200px;
         margin: 0 auto;
         padding: 20px;
      }
      .box {
         position: relative;
         overflow: hidden;
         margin-bottom: 20px;
         border-radius: 8px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         transition: transform 0.3s ease, box-shadow 0.3s ease;
      }
      .box:hover {
         transform: scale(1.03); /* Zoom effect */
         box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
      }
      .box img {
         display: block;
         width: 100%;
         height: auto;
         transition: transform 0.3s ease;
      }
      .box:hover img {
         transform: scale(1.4); /* Further zoom on hover */
      }
      .overlay {
         position: absolute;
         top: 0;
         left: 0;
         right: 0;
         bottom: 0;
         background: rgba(0, 0, 0, 0.5);
         color: #fff;
         display: flex;
         justify-content: center;
         align-items: center;
         opacity: 0;
         transition: opacity 0.3s ease;
         border-radius: 8px;
      }
      .box:hover .overlay {
         opacity: 1; /* Show overlay on hover */
      }
      .overlay-text {
         font-size: 1.5rem;
      }
      .title {
         text-align: center;
         margin-bottom: 40px;
         font-size: 2rem;
      }
      .box-container {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
         gap: 20px;
      }
      .box-container .box {
         display: flex;
         flex-direction: column;
         align-items: center;
         text-align: center;
      }
      .name {
         margin-top: 10px;
         font-weight: bold;
      }
      .price {
         font-size: 1.2rem;
         margin-top: 5px;
      }
      .cat {
         text-transform: uppercase;
         font-size: 0.8rem;
         margin-top: 5px;
         color: #666;
         text-decoration: none;
      }
      .empty {
         text-align: center;
         font-size: 1.2rem;
         margin-top: 20px;
      }
   </style>
</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>our menu</h3>
   <p><a href="home.php">home</a> <span> / menu</span></p>
</div>

<!-- menu section starts  -->

<section class="products">

   <h1 class="title">latest dishes</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart" ></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2"">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

</section>


<!-- menu section ends -->
























<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->








<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>