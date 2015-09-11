<div class="container">
  <div class="push-down-30">
    <div class="row">
      <div class="col-xs-12 col-sm-4">
        <div class="product-preview">
          <div class="push-down-20">
            <img class="js--product-preview" alt="Single product image" src="<?php echo $this->config->item('upload_path').$prod_image->file_name;?>" width="360" height="458">
          </div>
          <div class="product-preview__thumbs  clearfix">
            <div class="product-preview__thumb  active  js--preview-thumbs">
              <a href=".js--product-preview" data-src="<?php echo $this->config->item('upload_path').$prod_image->file_name;?>">
                <img src="<?php echo $this->config->item('upload_path').$prod_image->file_name;?>" alt="<?php echo $prod_image->file_name;?>" width="66" height="82" />
              </a>
            </div>
            <?php if($more_images<>false){
              foreach($more_images->result() as $row){
            ?>
            <div class="product-preview__thumb  js--preview-thumbs">
              <a href=".js--product-preview" data-src="<?php echo $this->config->item('upload_path').$row->file_name;?>">
                <img src="<?php echo $this->config->item('upload_path').$row->file_name;?>" alt="<?php echo $row->file_name;?>" width="66" height="82" />
              </a>
            </div>
            <?php
                }
              } 
            ?>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-8">
        <div class="products__content">
          <div class="push-down-30"></div>
          
          <span class="products__category"><?php echo $post_data->category_name; ?></span>
          <h1 class="single-product__title"><span class="light"><?php echo $post_data->title; ?></span></h1>
          <span class="single-product__price">
            <?php 
              if($root<>'catering')
                echo 'Rp '.number_format($prod_detail->price, 0, ',', '.');
              else
                echo $prod_detail->equal_to_point.' Poin';
            ?>

          </span>
          <!-- <div class="single-product__rating">
            <span class="glyphicon  glyphicon-star  star-on"></span>
            <span class="glyphicon  glyphicon-star  star-on"></span>
            <span class="glyphicon  glyphicon-star  star-on"></span>
            <span class="glyphicon  glyphicon-star  star-on"></span>
            <span class="glyphicon  glyphicon-star  star-off"></span>
          </div> -->
          
          <div class="in-stock--single-product">
            <span class="in-stock">&bull;</span> <span class="in-stock--text">In stock</span>
          </div>
          <hr class="bold__divider">
          <p class="single-product__text">
            <?php echo $post_data->content; ?>
          </p>
          <hr class="bold__divider">
          <!-- Single button -->
          <!-- <select class="btn  btn-shop">
            <option>350g</option>
            <option>700g</option>
            <option>1200g</option>
          </select>
           --><!-- Quantity buttons -->
          <div class="quantity  js--quantity">
            <input type="button" value="-" class="quantity__button  js--minus-one  js--clickable">
            <input type="text" name="quantity" id="quantity" value="1" class="quantity__input">
            <input type="button" value="+" class="quantity__button  js--plus-one  js--clickable">
          </div>
          <!-- Add to cart button -->
          <button class="btn btn-primary--transition" id="btn-add-cart">
            <span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-shopping-cart"></span>
            <span class="single-product__btn-text">Add to shopping cart</span>
          </button>
          <span id="message-after-add-cart"></span>
          <!-- Social banners -->
          <div class="row">
            <div class="col-xs-12  col-sm-6  col-md-4">
              <div class="banners--small  banners--small--social">
                <a href="#" class="social"><span class="zocial-facebook"></span>
                Share on<br>
                <span class="banners--small--text">Facebook</span>
                </a>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6  col-md-4">
              <div class="banners--small  banners--small--social">
                <a href="#" class="social"><span class="zocial-twitter"></span>
                Tweet it<br>
                <span class="banners--small--text">Twitter</span>
                </a>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6  col-md-4">
              <div class="banners--small  banners--small--social">
                <a href="#" class="social"><span class="zocial-pinterest"></span>
                Pin on<br>
                <span class="banners--small--text">Pinterest</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabs -->
  <!-- <div class="push-down-30">
    <div class="row">
      <div class="col-xs-12"> -->
        <!-- Nav tabs -->
<!-- <ul class="nav  nav-tabs">
  <li class="active"><a href="#tabDesc" data-toggle="tab">Description</a></li>
  <li><a href="#tabManufacturer" data-toggle="tab">Manufacturer</a></li>
  <li><a href="#tabReviews" data-toggle="tab">Reviews (0)</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane  fade  in  active" id="tabDesc">
    <div class="row">
      <div class="col-xs-12  col-sm-6">
        <h5>Description</h5>
        <p class="tab-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce est purus, fringilla sit amet arcu quis, feugiat ultrices metus. Vestibulum lorem dolor, pharetra sit amet urna nec, hendrerit scelerisque risus. In hac habitasse platea dictumst. Vestibulum lorem dolor, pharetra sit amet urna nec, hendrerit scelerisque risus. Vestibulum lorem dolor, pharetra sit amet urna nec, hendrerit scelerisque risus. In hac habitasse platea dictumst.</p>
      </div>
      <div class="col-xs-12  col-sm-6">
        <h5>About us</h5>
        <p class="tab-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce est purus, fringilla sit amet arcu quis, feugiat ultrices metus. Vestibulum lorem dolor, pharetra sit amet urna nec, hendrerit scelerisque risus. In hac habitasse platea dictumst. Vestibulum lorem dolor, pharetra sit amet urna nec, hendrerit scelerisque risus. Vestibulum lorem dolor, pharetra sit amet urna nec, hendrerit scelerisque risus. In hac habitasse platea dictumst.</p>
      </div>
    </div>
  </div>
  <div class="tab-pane  fade" id="tabManufacturer">
    <h5>Manufacturer details</h5>
    <p class="tab-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce est purus, fringilla sit amet arcu quis, feugiat ultrices metus. Vestibulum lorem dolor, pharetra sit amet urna nec, hendrerit scelerisque risus. In hac habitasse platea dictumst.</p>
  </div>
  <div class="tab-pane  fade" id="tabReviews">
    <h5>Reviews</h5>
    <p class="tab-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce est purus, fringilla sit amet arcu quis, feugiat ultrices metus. Vestibulum lorem dolor, pharetra sit amet urna nec, hendrerit scelerisque risus. In hac habitasse platea dictumst. Vestibulum lorem dolor, pharetra sit amet urna nec, hendrerit scelerisque risus.</p>
  </div>
</div>


      </div>
    </div>
  </div> -->

</div>
<script>
  $("#btn-add-cart").click(function(e){
      var post_id = "<?php echo $this->input->get('po');?>";
      var qty = $('#quantity').val();
      
      cart_data(post_id, qty, 'add');
      $('#message-after-add-cart').text('Pesanan telah masuk ke cart');
            
    });
</script>