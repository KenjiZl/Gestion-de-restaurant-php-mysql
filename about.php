<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      body{
         background-color: orange;
      }
   </style>

</head>

<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>about us</h3>
   <p><a href="home.php">home</a> <span> / about</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
      <h3>Exceptional Quality</h3>
<p> At Brother's Food Restaurant, we pride ourselves on using the freshest ingredients sourced locally whenever possible. Our talented chefs craft each dish with care and precision, ensuring every meal is delicious and memorable.
</p> <br>
<h3>Diverse Menu</h3>

 <p> Our extensive menu offers a wide variety of options to cater to every palate. Whether you're in the mood for a hearty steak, fresh seafood, a vegetarian delight, or a classic burger, we have something for everyone.
 </p> <br>
  <h3>Outstanding Service</h3> 
<p> Customer satisfaction is our top priority. Our friendly and professional staff are dedicated to providing you with an exceptional dining experience. From the moment you walk in, you'll be treated like family.
</p>
<a href="menu.php" class="btn" style="background-color:white">our menu</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>choose order</h3>
     <p>    </p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>fast delivery</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, dolorem.</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy food</h3>
         <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, dolorem.</p>
      </div>

   </div>

</section>

<!-- steps section ends -->











<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=





<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>