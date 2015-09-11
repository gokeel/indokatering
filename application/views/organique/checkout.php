<div class="woocommerce  push-down-30">
  <div class="container" id="myWizard">
    <div class="navbar">
      <div class="navbar-inner">
            <ul class="nav nav-pills">
              <li <?php echo ($order_done=="" ? 'class="active"' : 'class="disabled"');?>>
                <a href="#step1" data-toggle="tab">1. Keranjang Belanja</a>
              </li>
              <li <?php if($order_done<>"") echo 'class="disabled"';?>>
                <a href="#step2" data-toggle="tab">2. Lengkapi Data</a>
              </li>
              <li <?php echo ($order_done=="" ? 'class="disabled"' : 'class="active"');?>>
                <a href="#step3" data-toggle="tab">3. Status Pesanan Anda</a>
              </li>
              <li <?php if($order_done=="") echo 'class="disabled"';?>>
                <a href="#step4" data-toggle="tab">4. Konfirmasi Pembayaran</a>
              </li>
            </ul>
      </div>
   </div>
   <div class="tab-content">
      <div class="tab-pane <?php if($order_done=="") echo 'active'; ?>" id="step1">
        <div class="row">
          <div class="col-xs-12  push-down-30">
            <h3>Cart</h3>
            <hr>
            <table class="shop-table  shop-cart">
              <thead>
                <tr class="cart_table_title">
                  <th class="product-remove"></th>
                  <th class="product-thumbnail"></th>
                  <th class="product-name">Product</th>
                  <th class="product-price">Price</th>
                  <th class="product-quantity">Quantity</th>
                  <th class="product-subtotal">Total</th>
                </tr>
              </thead>
              <tbody>
                <form method="post" action="<?php echo base_url('order/update_all_cart');?>">
                <?php if($cart['count']>0){ 
                  foreach($cart['data'] as $row){?>
                  <tr class="cart_table_item">
                    <td class="product-remove"><a onclick="checkout_remove_cart_item('<?php echo $row['id'];?>')" ><span class="glyphicon  glyphicon-remove"></span></a></td>
                    <td class="product-thumbnail"><img src="<?php echo $this->config->item('upload_path').$row['image'];?>" width="40" height="50"></td>
                    <td class="product-name"><a href="#"><?php echo $row['title'];?></a></td>
                    <td class="product-price">
                      <?php if($row['price'] >= 1000) echo 'Rp '.number_format($row['price'], 0, '.', ',');
                            else echo $row['price'].' Poin';
                      ?>
                    </td>
                    <td class="product-quantity">
                      <div class="quantity  js--quantity">
                        <input type="button" value="-" class="quantity__button  js--minus-one  js--clickable">
                        <input type="hidden" name="id[]" value="<?php echo $row['id'];?>" />
                        <input type="text" name="quantity[]" value="<?php echo $row['qty'];?>" class="quantity__input">
                        <input type="button" value="+" class="quantity__button  js--plus-one  js--clickable">
                      </div>
                    </td>
                    <td class="product-subtotal">
                      <?php 
                        if($row['price']<1000)
                          echo $row['total_price_item'].' Poin';
                        else
                          echo 'Rp '.number_format($row['total_price_item'], 0, '.', ',');?>
                    </td>
                  </tr>
                  <?php }
                    } ?>
                  <tr class="cart_table_action">
                    <td colspan="6" class="actions">
                      <div class="col-xs-6">
                        
                      </div>
                      <div class="col-xs-6">
                        <!-- <a href="checkout.html" class="btn  btn-primary  pull-right">Proceed to checkout</a> -->
                        <button type="submit" class="btn  btn-warning  pull-right">Update cart</button>
                      </div>
                    </td>
                  </tr>
                </form>
              </tbody>
            </table>
            <div class="col-xs-12 col-sm-6">
            </div>
            <div class="col-xs-12 col-sm-6">
              <!-- Your order - table -->
              <h3  class="pull-right"><span class="light">Cart</span> Totals</h3>
              <table class="shop_table  push-down-30">
                <tfoot>
                  <tr class="cart-subtotal">
                    <th>Subtotal</th>
                    <td><span class="amount">Rp <?php echo number_format($cart['total'], 0, '.', ',');?></span></td>
                  </tr>
                  <tr class="shipping">
                    <th>Shipping</th>
                    <td>
                      <?php 
                          if(intval($cart['total']) < $options['min_total_free_ship_cost'])
                            $ship_cost = $options['ship_cost'];
                          else
                            $ship_cost = 0;
                          
                          echo 'Rp '.number_format($ship_cost, 0, '.', ',');
                      ?>
                    </td>
                  </tr>
                  <tr class="total">
                    <th><strong>Order Total</strong></th>
                    <td>
                      <strong><span class="amount">Rp <?php echo number_format($cart['total']+$ship_cost, 0, '.', ',');?></span></strong>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div> <!-- ./col -->
        </div> <!-- ./row -->
        <a class="btn btn-warning next" href="#">Continue</a>
      </div>
      <div class="tab-pane" id="step2">
        <div class="row">
          <?php if($this->session->userdata('logged')<>'in'){ ?>
          <div class="col-xs-12">
            <h3>Login / Register</h3>
            <hr>
            <p class="woocommerce-info">Silahkan untuk melakukan <a href="#registerModal" role="button" data-toggle="modal">Register</a> atau <a href="#loginModal" role="button" data-toggle="modal">Login</a> terlebih dahulu.</p>
          </div>
          <?php } ?>
          <form method="post" action="<?php echo base_url('order/place');?>" class="form-horizontal" id="form-shipping">
            <h3><span class="light">Alamat</span> Pengiriman</h3>
              <div class="col-xs-12  col-sm-6">
                <div class="row">
                  <div class="col-xs-12  col-sm-6  push-down-10">
                    <p>
                      <label>
                        Nama Depan
                        <abbr class="required">
                          *
                        </abbr>
                      </label>
                      <input class="input-text" type="text" name="ship-fn" value="<?php echo $this->session->userdata('fn');?>" required>
                    </p>
                  </div> <!-- ./firstname -->
                  <div class="col-xs-12  col-sm-6  push-down-10">
                    <p>
                      <label>
                        Nama Belakang
                        <abbr class="required">
                          *
                        </abbr>
                      </label>
                      <input class="input-text" type="text" name="ship-ln" value="<?php echo $this->session->userdata('ln');?>" required>
                    </p>
                  </div> <!-- ./lastname -->
                  <div class="col-xs-12  col-sm-12  push-down-10">
                    <p>
                      <label>
                        Alamat
                        <abbr class="required">
                          *
                        </abbr>
                      </label>
                      <input class="input-text  push-down-10" type="text" name="ship-address-1" placeholder="Street address" required>
                      <input class="input-text" type="text" name="ship-address-2" placeholder="Gedung, RT/RW, Kelurahan (optional)">
                    </p>
                  </div> <!-- ./alamat -->
                  <div class="col-xs-12  col-sm-12  push-down-10">
                    <p>
                      <label>
                        Kode Pos
                      </label>
                      <input class="input-text  push-down-10" type="text" name="ship-zip-code">
                    </p>
                  </div> <!-- ./kodepos -->
                </div> <!-- ./row -->
              </div> <!-- ./col-xs-12 -->
              <div class="col-xs-12 col-sm-6">
                <div class="row">
                  <div class="col-xs-12  col-sm-12  push-down-10">
                    <p>
                      <label>
                        Kota
                        <abbr class="required">
                          *
                        </abbr>
                      </label>
                      <input class="input-text  push-down-10" type="text" name="ship-city" required>
                    </p>
                  </div> <!-- ./kota -->
                  <div class="col-xs-12  col-sm-12  push-down-10">
                    <p>
                      <label>
                        Propinsi
                        <abbr class="required">
                          *
                        </abbr>
                      </label>
                      <input class="input-text  push-down-10" type="text" name="ship-province" required>
                    </p>
                  </div> <!-- ./propinsi -->
                  <div class="col-xs-12  col-sm-12  push-down-10">
                    <p>
                      <label>
                        Telepon/HP
                        <abbr class="required">
                          *
                        </abbr>
                      </label>
                      <input class="input-text" type="text" name="ship-phone" required>
                    </p>
                  </div> <!-- ./telepon -->
                  <div class="col-xs-12  col-sm-12  push-down-10">
                    <p>
                      <label>
                        Catatan
                      </label>
                      <textarea class="input-text" rows="3" name="ship-note"></textarea>
                    </p>
                  </div> <!-- ./catatan -->
                </div> <!-- ./row -->
              </div> <!-- ./col-xs-12 -->
              <!-- Payment methods -->
              <div class="col-xs-12">
                <div class="payment">
                  <div class="overlay pull-right" style="display:none" id="loading">
                    <i class="fa fa-refresh fa-spin fa-2x"></i>
                  </div>
                  <button type="submit" id="btn-place-order" class="btn  btn-warning  pull-right <?php if($this->session->userdata('logged')<>'in') echo "disabled"; ?>">Place order</button>
                </div> <!-- ./payment -->
              </div> <!-- ./col-xs-12 -->
            <!-- </div> -->
            <hr class="divider">
          </form>
        </div>
      </div>
      <div class="tab-pane <?php if($order_done<>"") echo 'active'; ?>" id="step3">
        <?php if($order_done<>""){ ?>
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
                      $branch = 'Cabang '.$row->bank_branch.($row->bank_city == "" ? "" : " - ".$row->bank_city);
                      
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
            <hr class="divider">
          </div>
        </div>
        <a class="btn btn-warning next" href="#">Continue</a>
        <?php } ?>
      </div>
      <div class="tab-pane" id="step4">
        <?php if($order_done<>""){ ?>
        <div class="woocommerce  push-down-30">
          <div class="container">
            <div class="row">
              <form method="post" action="<?php echo base_url('order/submit_payment_conf');?>" class="form-horizontal" id="form-shipping">
                <h3>
                  <span class="light">Konfirmasi</span> Pembayaran
                </h3>
                <div class="col-xs-12  col-sm-6">
                  <div class="row">
                    <div class="col-xs-12  col-sm-6  push-down-10">
                      <p>
                        <label>
                          Order ID
                          <abbr class="required">
                            *
                          </abbr>
                        </label>
                        <input class="input-text" type="text" name="order-id" onblur="lookup_order(this.value)" style="text-transform:uppercase" required>
                        
                      </p>
                    </div>
                    <div class="col-xs-12  col-sm-6  push-down-10">
                      <p class="replace-status">
                        <!-- <br><br>
                        <i class="fa fa-check fa-2x" style="color: green"></i>
                        *Order ID anda tidak ditemukan -->
                      </p>
                    </div>
                    <div class="col-xs-12  col-sm-12  push-down-10">
                      <p>
                        <label>
                          Nama Pengirim
                          <abbr class="required">
                            *
                          </abbr>
                        </label>
                        <input class="input-text  push-down-10" type="text" name="name" required>
                      </p>
                    </div>
                    <div class="col-xs-12  col-sm-12  push-down-10">
                      <p>
                        <label>
                          Bank Tujuan
                        </label>
                        <abbr class="required">
                            *
                          </abbr>
                        <select name="bank-dest" class="form-control" required>
                          <?php 
                          if($bank<>false){
                            foreach($bank->result() as $row){
                          ?>
                          <option value="<?php echo $row->bank_id;?>"><?php echo $row->bank_name;?></option>
                          <?php
                              }
                            } 
                          ?>
                        </select>
                        
                      </p>
                    </div>
                    <div class="col-xs-12  col-sm-12  push-down-10">
                      <p>
                        <label>
                          Total
                        </label>
                        <input class="input-text  push-down-10" type="text" name="total" id="total">
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="row">
                    <div class="col-xs-12  col-sm-12  push-down-10">
                      <p>
                        <label>
                          Tanggal Transfer
                          <abbr class="required">
                            *
                          </abbr>
                        </label>
                        <input class="input-text" type="text" id="datepicker" name="transfer-date" required>
                      </p>
                    </div>
                    <div class="col-xs-12  col-sm-12  push-down-10">
                      <p>
                        <label>
                          Catatan
                        </label>
                        <textarea class="input-text" rows="3" name="note"></textarea>
                      </p>
                    </div>
                  </div>
                  
                </div>
                <!-- Payment methods -->
                <div class="col-xs-12">
                  <div class="payment">
                    <button type="submit" id="btn-place-order" class="btn  btn-warning  pull-right">Submit</button>
                  </div>
                </div>
              </div>
              <hr class="divider">
            </form>
          </div>
        </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>


    
<script>
  $('.next').click(function(){

  var nextId = $(this).parents('.tab-pane').next().attr("id");
  $('[href=#'+nextId+']').tab('show');

})

$('.first').click(function(){

  $('#myWizard a:first').tab('show')

})
  
  <?php if($order_done<>"") {?>
    function lookup_order(order_id){
    $.ajax({
      type : "POST",
      async: false,
      url: "<?php echo base_url();?>order/lookup_order/"+order_id,
      dataType: "json",
      success:function(data){
        if(data.status=="200"){
          $('.replace-status').html('<br><br>\
                <i class="fa fa-check fa-2x" style="color: green"></i>');
          $('#total').val(data.total);
        }
        else{
          $('.replace-status').html('<br><br>\
            *Order ID tidak ditemukan');
          $('#total').val('');
        }
          
      }
    });
  }
  
  $(function () {
    $('#datepicker').datepicker({"dateFormat": "yy-mm-dd"});
  });
  <?php } ?>
</script>