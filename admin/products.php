<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
   exit();
}

$search_query = '';
$category_filter = '';

if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

if (isset($_GET['category'])) {
    $category_filter = $_GET['category'];
}

if (isset($_POST['add_product'])) {
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if ($select_products->rowCount() > 0) {
      $message[] = 'Product name already exists!';
   } else {
      if ($image_size > 2000000) {
         $message[] = 'Image size is too large';
      } else {
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `products`(name, category, price, image) VALUES(?,?,?,?)");
         $insert_product->execute([$name, $category, $price, $image]);

         $message[] = 'New product added!';
      }
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
      /* Your existing styles */
   </style>
</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add products section starts  -->
<section class="add-products">
   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Add Product</h3>
      <input type="text" required placeholder="Enter product name" name="name" maxlength="100" class="box">
      <input type="number" min="0" max="9999999999" required placeholder="Enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <select name="category" class="box" required>
         <option value="" disabled selected>Select category --</option>
         <option value="main dish">Main Dish</option>
         <option value="drinks">Drinks</option>
         <option value="desserts">Desserts</option>
         <option value="pizza">Pizza</option>
         <option value="pasta">Pasta</option>
         <option value="Traditional Moroccan">Traditional Moroccan</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="Add Product" name="add_product" class="btn">
   </form>
</section>
<!-- add products section ends -->

<!-- Filter section starts -->
<section class="filter-section">
   <form action="" method="GET">
      <input type="text" name="search" placeholder="Search by product name" value="<?= htmlspecialchars($search_query); ?>" class="box">
      <select name="category" class="box">
         <option value="" selected>All Categories</option>
         <option value="main dish" <?= ($category_filter == 'main dish') ? 'selected' : ''; ?>>Main Dish</option>
         <option value="drinks" <?= ($category_filter == 'drinks') ? 'selected' : ''; ?>>Drinks</option>
         <option value="desserts" <?= ($category_filter == 'desserts') ? 'selected' : ''; ?>>Desserts</option>
         <option value="pizza" <?= ($category_filter == 'pizza') ? 'selected' : ''; ?>>Pizza</option>
         <option value="pasta" <?= ($category_filter == 'pasta') ? 'selected' : ''; ?>>Pasta</option>
         <option value="Traditional Moroccan" <?= ($category_filter == 'Traditional Moroccan') ? 'selected' : ''; ?>>Traditional Moroccan</option>
      </select>
      <input type="submit" value="Filter" class="btn">
   </form>
</section>
<!-- Filter section ends -->

<!-- show products section starts  -->
<section class="show-products">
   <div class="box-container">
   <?php
      $filter_conditions = [];
      $params = [];

      $filter_conditions[] = "1";
      if (!empty($search_query)) {
         $filter_conditions[] = "name LIKE ?";
         $params[] = "%$search_query%";
      }
      if (!empty($category_filter)) {
         $filter_conditions[] = "category = ?";
         $params[] = $category_filter;
      }

      // Pagination settings
      $items_per_page = 5;
      $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $offset = ($current_page - 1) * $items_per_page;

      // Get the total number of items
      $count_query = "SELECT COUNT(*) FROM `products` WHERE " . implode(" AND ", $filter_conditions);
      $count_stmt = $conn->prepare($count_query);
      $count_stmt->execute($params);
      $total_items = $count_stmt->fetchColumn();
      $total_pages = ceil($total_items / $items_per_page);

      // Fetch products with limits
      $filter_query = "SELECT * FROM `products` WHERE " . implode(" AND ", $filter_conditions) . " LIMIT " . (($current_page - 1) * $items_per_page) . ", $items_per_page";
$show_products = $conn->prepare($filter_query);
      $show_products->execute($params);

      if ($show_products->rowCount() > 0) {
         ?>
         <table>
            <thead>
               <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Category</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
            <?php
            while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {  
            ?>
               <tr>
                  <td><img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="" style="width: 100px;"></td>
                  <td><?= $fetch_products['name']; ?></td>
                  <td>$<?= $fetch_products['price']; ?>/-</td>
                  <td><?= $fetch_products['category']; ?></td>
                  <td>
                     <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Update</a>
                     <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
                  </td>
               </tr>
            <?php
            }
            ?>
            </tbody>
         </table>
         <?php
      } else {
         echo '<p class="empty">No products found!</p>';
      }
   ?>
   </div>
</section>
<!-- show products section ends -->

<!-- Pagination links -->
<section class="pagination">
   <div class="box-container">
      <?php if ($total_pages > 1): ?>
         <div class="pagination-links">
            <?php if ($current_page > 1): ?>
               <a href="?page=<?= $current_page - 1; ?>&search=<?= $search_query; ?>&category=<?= $category_filter; ?>" class="btn">Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
               <a href="?page=<?= $i; ?>&search=<?= $search_query; ?>&category=<?= $category_filter; ?>" class="btn <?= ($i == $current_page) ? 'active' : ''; ?>"><?= $i; ?></a>
            <?php endfor; ?>
            <?php if ($current_page < $total_pages): ?>
               <a href="?page=<?= $current_page + 1; ?>&search=<?= $search_query; ?>&category=<?= $category_filter; ?>" class="btn">Next</a>
            <?php endif; ?>
         </div>
      <?php endif; ?>
   </div>
</section>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
