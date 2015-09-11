<div class="container">
  <!-- Title for motivational stories -->
  <div class="row">
    <div class="col-xs-12">
      <div class="main__title">
        <h3 class="main__title__text"><span class="light">Beli</span> Poin</h3>
      </div>
    </div>
  </div>

  <!-- Motivational stories -->
  <div class="motivational-stories">
    <div class="row">
      <div class="overlay" style="display:none" id="loading">
        <i class="fa fa-refresh fa-spin fa-5x"></i>
      </div>
      <?php foreach($points->result() as $row){ ?>
      <div class="col-xs-12  col-sm-3  push-down-30">
        <div class="motivational-stories__circle">
          <?php echo $row->point; ?>
        </div>
        <h5><?php echo strtoupper($row->title); ?></h5>
        <h2>Rp <?php echo number_format($row->price, 0, ',', '.'); ?></h2>
        <button class="btn btn-warning--reverse-transition" type="button" onclick="add_to_cart_buy_point('<?php echo $row->id;?>')">Add to Cart</button>
      </div>
      <?php } ?>

    </div>
  </div>
    
  </div>
</div>
<script>
  function add_to_cart_buy_point(point_id){
      $('#loading').toggle();
      var qty = '1';
      cart_data(point_id, qty, 'add');
      $('#loading').toggle();
    }
</script>