

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
                <input class="input-text" type="text" id="datepicker" name="transfer-date">
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
<script>
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
</script>