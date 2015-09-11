<div class="woocommerce  push-down-30">
  <div class="container">
    <div class="navbar">
      <div class="navbar-inner">
            <ul class="nav nav-pills">
              <li <?php if($tab=="") echo 'class="active"';?>>
                <a href="#my-order" data-toggle="tab">Status Pesanan</a>
              </li>
              <li <?php if($tab=="profile") echo 'class="active"';?>>
                <a href="#profile" data-toggle="tab">Profil</a>
              </li>
              <li <?php if($tab=="password") echo 'class="active"';?>>
                <a href="#change-password" data-toggle="tab">Ubah Password</a>
              </li>
            </ul>
      </div>
   </div>
   <div class="tab-content">
      <div class="tab-pane <?php if($tab=="") echo 'active';?>" id="my-order">
        <div class="row">
          <div class="col-xs-12  push-down-30">
            <!-- <h3>Histori & Detil Pesanan</h3>
            <hr> -->
            <div class="col-xs-12 col-sm-6">
              <h3 class="pull-right"><span class="light">Pesanan</span> Aktif</h3>
              <table class="shop-table shop-cart">
                <thead>
                  <tr class="cart_table_title" style="line-height:2.5">
                    <th>Order ID</th>
                    <th>Qty</th>
                    <th>Grand Total</th>
                    <th>Status</th>
                    <th>Tgl Pesan</th>
                    <th>Detil</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($orders <> false){ 
                    $any = 0;
                    foreach($orders->result() as $row)
                      if($row->order_status=="Open"){
                        $any += 1;
                  ?>
                    <tr class="cart_table_item">
                      <td><b><?php echo $row->order_id; ?></b></td>
                      <td><?php echo $row->total_items; ?></td>
                      <td class="product-price" style="text-align:right; width:17%"><?php echo number_format($row->total_price, 0, ',', '.'); ?></td>
                      <td><?php echo $row->order_status; ?></td>
                      <td><?php echo date_format(new DateTime($row->entry_date), 'd M Y H:i:s');?></td>
                      <td><a href="<?php echo base_url().'order/detail/'.$row->order_id;?>"><button class="btn btn-warning"><span class="glyphicon glyphicon-search"></span></button></a></td>
                    </tr>
                    <?php }
                      if($any==0){
                      ?>
                    <tr class="cart_table_item" style="line-height:2.5">
                      <td colspan="6" class="actions">
                        Tidak ada pesanan aktif saat ini.
                      </td>
                    </tr>
                    <?php }
                      } ?>
                </tbody>
              </table>
            </div>
            <div class="col-xs-12 col-sm-6">
              <!-- Your order - table -->
              <h3 class="pull-right"><span class="light">Histori</span> Pesanan</h3>
              <table class="shop-table shop-cart">
                <thead>
                  <tr class="cart_table_title" style="line-height:2.5">
                    <th>Order ID</th>
                    <th>Qty</th>
                    <th>Grand Total</th>
                    <th>Status</th>
                    <th>Tgl Pesan</th>
                    <th>Detil</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($orders <> false){ 
                    $any = 0;
                    foreach($orders->result() as $row)
                      if($row->order_status<>"Open"){
                        $any += 1;
                  ?>
                    <tr class="cart_table_item">
                      <td><b><?php echo $row->order_id; ?></b></td>
                      <td><?php echo $row->total_items; ?></td>
                      <td class="product-price" style="text-align:right; width:17%"><?php echo number_format($row->total_price, 0, ',', '.'); ?></td>
                      <td><?php echo $row->order_status; ?></td>
                      <td><?php echo date_format(new DateTime($row->entry_date), 'd M Y H:i:s');?></td>
                      <td><a href="<?php echo base_url().'order/detail/'.$row->order_id;?>"><button class="btn btn-danger"><span class="glyphicon glyphicon-search"></span></button></a></td>
                    </tr>
                    <?php }
                      if($any==0){
                      ?>
                    <tr class="cart_table_item" style="line-height:2.5">
                      <td colspan="6" class="actions">
                        Tidak ada data pesanan saat ini.
                      </td>
                    </tr>
                    <?php }
                      } ?>
                </tbody>
              </table>
            </div>
          </div> <!-- ./col -->
        </div> <!-- ./row -->
      </div> <!-- ./tab-pane -->
      <div class="tab-pane <?php if($tab=="profile") echo 'active';?>" id="profile">
        <form method="post" action="<?php echo base_url('users/change_profile');?>" class="form-horizontal" id="form-profile">
          <input type="hidden" name="userid" value="<?php echo $this->session->userid?>">
          <div class="row">
            <h3><span class="light">Akun</span>-Ku</h3>
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
                      <input class="input-text" type="text" name="fn" value="<?php echo $user_main->first_name;?>" required>
                    </p>
                  </div> <!-- ./firstname -->
                  <div class="col-xs-12  col-sm-6  push-down-10">
                    <p>
                      <label>
                        Nama Belakang
                      </label>
                      <input class="input-text" type="text" name="ln" value="<?php echo $user_main->last_name;?>">
                    </p>
                  </div> <!-- ./lastname -->
                </div> <!-- ./row -->
              </div> <!-- ./col-xs-12 -->
              <div class="col-xs-12 col-sm-6">
                <div class="row">
                  <div class="col-xs-12  col-sm-6  push-down-10">
                    <p>
                      <label>
                        Poin Anda Saat Ini
                      </label><br>
                      <font size="24" style="color:green"><?php echo $user_main->point_balance;?></font>
                    </p>
                  </div> <!-- ./lastname -->
                </div> <!-- ./row -->
              </div> <!-- ./col-xs-12 -->
              
          </div> <!-- ./row -->
          <hr class="divider">
          <div class="row">
            <h3><span class="light">Alamat</span> Pengiriman</h3>
              <div class="col-xs-12  col-sm-6">
                <div class="row">
                  <div class="col-xs-12  col-sm-12  push-down-10">
                    <p>
                      <label>
                        Alamat
                      </label>
                      <input class="input-text  push-down-10" type="text" name="ship-address-1" placeholder="Nama Jalan" value="<?php if($user_info<>false) echo $user_info->address_1;?>">
                      <input class="input-text" type="text" name="ship-address-2" placeholder="Gedung, RT/RW, Kelurahan (optional)" value="<?php if($user_info<>false) echo $user_info->address_2;?>">
                    </p>
                  </div> <!-- ./alamat -->
                  <div class="col-xs-12  col-sm-12  push-down-10">
                    <p>
                      <label>
                        Kode Pos
                      </label>
                      <input class="input-text  push-down-10" type="text" name="ship-zip-code" value="<?php if($user_info<>false) echo $user_info->zip_code;?>">
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
                      </label>
                      <input class="input-text  push-down-10" type="text" name="ship-city" value="<?php if($user_info<>false) echo $user_info->city;?>">
                    </p>
                  </div> <!-- ./kota -->
                  <div class="col-xs-12  col-sm-12  push-down-10">
                    <p>
                      <label>
                        Propinsi
                      </label>
                      <input class="input-text  push-down-10" type="text" name="ship-province" value="<?php if($user_info<>false) echo $user_info->province;?>">
                    </p>
                  </div> <!-- ./propinsi -->
                  <div class="col-xs-12  col-sm-12  push-down-10">
                    <p>
                      <label>
                        Telepon/HP
                      </label>
                      <input class="input-text" type="text" name="ship-phone" value="<?php if($user_info<>false) echo $user_info->phone;?>">
                    </p>
                  </div> <!-- ./telepon -->
                </div> <!-- ./row -->
              </div> <!-- ./col-xs-12 -->
              <!-- Payment methods -->
              <div class="col-xs-12">
                <div class="payment">
                  <div class="overlay pull-right" style="display:none" id="loading">
                    <i class="fa fa-refresh fa-spin fa-2x"></i>
                  </div>
                  <button type="submit" class="btn  btn-warning  pull-right">Simpan Perubahan</button>
                </div> <!-- ./payment -->
              </div> <!-- ./col-xs-12 -->
            <!-- </div> -->      
          </div>
          <hr class="divider">
        </form>
      </div>
      <div class="tab-pane <?php if($tab=="password") echo 'active';?>" id="change-password">
        <div class="row">
          <form class="form-horizontal" id="form-password">
            <input type="hidden" name="email" value="<?php echo $this->session->userdata('email');?>">
            <h3><span class="light">Ubah</span> Password Anda</h3>
              <div class="col-xs-12  col-sm-3">
                <div class="row">
                  <div class="col-xs-12  col-sm-12 push-down-10">
                    <p>
                      <label>
                        Password lama
                        <abbr class="required">
                          *
                        </abbr>
                      </label>
                      <input class="input-text" type="password" name="old" required>
                    </p>
                  </div> <!-- ./Old password -->
                  <div class="col-xs-12  col-sm-12 push-down-10">
                    <p>
                      <label>
                        Password Baru
                        <abbr class="required">
                          *
                        </abbr>
                      </label>
                      <input class="input-text" type="password" name="new" required>
                    </p>
                  </div> <!-- ./New password -->
                </div> <!-- ./row -->
              </div> <!-- ./col-xs-12 -->
              <div class="col-xs-12 col-sm-9">
                
              </div> <!-- ./col-xs-12 -->
              <!-- Payment methods -->
              <div class="col-xs-12">
                <div class="payment">
                  <button type="button" id="btn-submit" class="btn  btn-warning">Submit</button>
                  <p id="message"></p>
                </div> <!-- ./payment -->
              </div> <!-- ./col-xs-12 -->
            <!-- </div> -->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('#btn-submit').on('click', function() {
    $.ajax({
      type : "POST",
      async: false,
      url: "<?php echo base_url();?>users/password_change",
      data: $('#form-password').serialize(),
      dataType: "json",
      success:function(data){
        if(data.status=="200")
          $('#message').text('Password berhasil diubah');
        
        else
          $('#message').text(data.message);
        
      }
    });
  })
</script>