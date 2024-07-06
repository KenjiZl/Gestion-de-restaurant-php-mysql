<div class="box">
   <p>placed on : <span><?= htmlspecialchars($fetch_orders['placed_on']); ?></span></p>
   <p>name : <span><?= htmlspecialchars($fetch_orders['name']); ?></span></p>
   <p>email : <span><?= htmlspecialchars($fetch_orders['email']); ?></span></p>
   <p>number : <span><?= htmlspecialchars($fetch_orders['number']); ?></span></p>
   <p>address : <span><?= htmlspecialchars($fetch_orders['address']); ?></span></p>
   <p>payment method : <span><?= htmlspecialchars($fetch_orders['method']); ?></span></p>
   <p>your orders : <span><?= htmlspecialchars($fetch_orders['total_products']); ?></span></p>
   <p>total price : <span>$<?= htmlspecialchars($fetch_orders['total_price']); ?>/-</span></p>
   <p>payment status : <span style="color:<?= $fetch_orders['payment_status'] == 'pending' ? 'red' : 'green'; ?>"><?= htmlspecialchars($fetch_orders['payment_status']); ?></span></p>
</div>
