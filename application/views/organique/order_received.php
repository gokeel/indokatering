<div class="woocommerce  push-down-30">
  <div class="container">
    <h3><span class="light">Order</span> Received</h3>
    <hr>
    <p>Terima kasih, pesanan anda telah kami terima.</p>
    <ul class="order_details">
      <li class="order">
        Order: <strong><?php echo $this->uri->segment(3);?></strong>
      </li>
      <li class="date">
        Date: <strong><?php echo date('d M Y');?></strong>
      </li>
      <li class="total">
        Total: <strong><span class="amount">Rp <?php echo number_format($header->total_price, 0, '.', ',');?></span></strong>
      </li>
      <li class="method">
        Payment method: <strong>Direct Bank Transfer</strong>
      </li>
    </ul>
    <br>
    <p>Silahkan untuk melakukan pembayaran, dan gunakan Order ID di atas sebagai berita acara atau referensi jika menggunakan Online Banking. Pesanan akan kami kirimkan setelah pembayaran terverifikasi.</p>
    <!-- <h2><span class="light">Bank</span></h2> -->
    <div class="row">
      <div class="col-xs-12  col-sm-6">
        <?php 
          if($bank<>false){
            foreach($bank->result() as $row){
        ?>
        <header class="title">
          <h3><span class="light"><?php echo $row->bank_name;?></span> </h3>
        </header>
        <address>
          <p>
            <?php echo $row->bank_account_number;?><br>
            <?php echo $row->bank_holder_name;?><br>
            <?php 
            if($row->bank_branch == "")
              $branch = "";
            else
              $branch = '<br/>Cabang '.$row->bank_branch.($row->bank_city == "" ? "" : $row->bank_city);
              
              echo $branch;
            ?>
          </p>
        </address>
        <?php
            }
          } 
        ?>
        
      </div>
      <div class="col-xs-12  col-sm-6">
      </div>
    </div>
    <!-- <h2><span class="light">Order</span> Details</h2>
    <table class="shop_table  push-down-30">
      <thead>
        <tr>
          <th class="product-name">Product</th>
          <th class="product-total">Total</th>
        </tr>
      </thead>
      <tfoot>
        <tr class="cart-subtotal">
          <th>Cart Subtotal</th>
          <td><span class="amount">€35</span></td>
        </tr>
        <tr class="shipping">
          <th>Shipping</th>
          <td>Free Shipping</td>
        </tr>
        <tr class="total">
          <th><strong>Order Total</strong></th>
          <td>
            <strong><span class="amount">€35</span></strong>
          </td>
        </tr>
      </tfoot>
      <tbody>
        <tr class="checkout_table_item">
          <td class="product-name">Ship Your Idea <strong class="product-quantity">× 1</strong><br>
          <strong>pa_color:</strong> black</td>
          <td class="product-total"><span class="amount">€35</span></td>
        </tr>
      </tbody>
    </table>
    <header class="title">
      <h3><span class="light">Customer</span> details</h3>
    </header>
    <dl class="customer_details">
      <dt>First Name:</dt>
      <dd>Proteus</dd>
      <dt>Last Name:</dt>
      <dd>Themes</dd>
      <dt>Email:</dt>
      <dd>something@something.com </dd>
      <dt>Phone:</dt>
      <dd>+386 31 567 537</dd>
    </dl>
    <div class="row">
      <div class="col-xs-12  col-sm-6">
        <header class="title">
          <h3><span class="light">Billing</span> Address</h3>
        </header>
        <address>
          <p>
            Proteus Themes<br>
            Tehnološki park 19<br>
            1000 Ljubljana
          </p>
        </address>
      </div>
      <div class="col-xs-12  col-sm-6">
        <header class="title">
          <h3><span class="light">Shipping</span> Address</h3>
        </header>
        <address>
          <p>
            Proteus Themes<br>
            Tehnološki park 19<br>
            1000 Ljubljana
          </p>
        </address>
      </div>
    </div> -->
    <hr class="divider">
  </div>
</div>