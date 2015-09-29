<div id="carousel-example-generic" class="carousel  slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php 
      $cnt = 0;
      foreach($image_slider_data->result() as $row){
    ?>
    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $cnt;?>" <?php if($cnt==0) echo 'class="active"';?>></li>
    <?php } ?>
    <!-- <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li> -->
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php 
      $cnt = 0;
      foreach($image_slider_data->result() as $row){
    ?>
    <div class="item <?php if($cnt==0) echo "active"?>">
      <img src="<?php echo UPLOAD_IMAGE_DIR.'/'.$image_on_slider[$row->id];?>" alt="">
      <div class="carousel-caption">
        <div class="jumbotron__container">
          <h2 class="jumbotron__subtitle">
            <?php echo $row->content; ?>
          </h2>
          <h1 class="jumbotron__title">
            <?php echo $row->title; ?>
          </h1>
          <!-- <a class="btn  btn-warning" href="http://themeforest.net/item/organique-html-template-for-healthy-food-store/6779086?ref=ProteusThemes" target="_blank">Buy theme</a> &nbsp; -->
          <!-- <a class="btn  btn-jumbotron" href="features.html">More details</a> -->
        </div>
      </div>
    </div>
    <?php 
        $cnt++;
      } 
    ?>
    <!-- <div class="item">
      <img src="<?php echo ORGANIQUE_DIR;?>/images/organic-slider-2.jpg" alt="">
      <div class="carousel-caption">
        <div class="jumbotron__container">
          <h2 class="jumbotron__subtitle">
            Awesome oppurtunity to save a lof of money on
          </h2>
          <h1 class="jumbotron__title">
            Fresh organic food
          </h1>
          <a class="btn  btn-jumbotron" href="features.html">More details</a>
        </div>
      </div>
    </div>
    <div class="item">
      <img src="<?php echo ORGANIQUE_DIR;?>/images/organic-slider-3.jpg" alt="">
      <div class="carousel-caption">
        <div class="jumbotron__container">
          <h2 class="jumbotron__subtitle">
            Awesome oppurtunity to save a lof of money on
          </h2>
          <h1 class="jumbotron__title">
            Fresh organic food
          </h1>
          <a class="btn  btn-jumbotron" href="features.html">More details</a>
        </div>
      </div>
    </div> -->
  </div>

  <!-- Controls -->
  <a class="left  carousel-control" href="#carousel-example-generic" data-slide="prev">
    <span class="glyphicon  glyphicon-chevron-left"></span>
  </a>
  <a class="right  carousel-control" href="#carousel-example-generic" data-slide="next">
    <span class="glyphicon  glyphicon-chevron-right"></span>
  </a>
</div>
<div class="banners  push-down-30">
  <div class="container">
    <div class="row">
      <div class="col-xs-12  col-sm-6  col-md-3">
        <div class="banners-box">
          <span class="glyphicon glyphicon-earphone glyphicon--banners"></span>
          <b class="banners__title">CALL US ANYTIME</b>
          <?php echo $options['company_mobile'];?>
        </div>
      </div>
      <div class="col-xs-12  col-sm-6  col-md-3">
        <div class="banners-box">
          <span class="glyphicon glyphicon-road glyphicon--banners"></span>
          <b class="banners__title">FREE DELIVERY</b>
          Jabodetabek Only
        </div>
      </div>
      <div class="col-xs-12  col-sm-6  col-md-3">
        <div class="banners-box">
          <span class="glyphicon glyphicon-credit-card glyphicon--banners"></span>
          <b class="banners__title">PAYMENT METHODS</b>
          Bank Transfer
        </div>
      </div>
      <div class="col-xs-12  col-sm-6  col-md-3">
        <div class="banners-box">
          <span class="glyphicon glyphicon-leaf glyphicon--banners"></span>
          <b class="banners__title">MADE WITH LOVE</b>
          For mother nature
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <!-- Title for motivational stories -->
  <div class="row">
    <div class="col-xs-12">
      <div class="main__title">
        <h3 class="main__title__text"><span class="light">Why</span> is Quality Food Very Important?</h3>
      </div>
    </div>
  </div>

  <!-- Motivational stories -->
  <div class="motivational-stories">
    <div class="row">
      <div class="col-xs-12  col-sm-4  push-down-30">
        <div class="motivational-stories__circle">
          <span class="glyphicon  glyphicon-heart" style="color:#DC2742"></span>
        </div>
        <h5>It is good for your heart</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam auctor pulvinar et, cursus quis neque. Donec suscipit dui leo, vehicula pellentesque nunc rhoncus vel. Aliquam tempus justo eu orci faucibus fermentum. </p>
      </div>
      <div class="col-xs-12  col-sm-4  push-down-30">
        <div class="motivational-stories__circle">
          <span class="glyphicon  glyphicon-leaf" style="color:#DC2742"></span>
        </div>
        <h5>Because it is from nature</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam auctor pulvinar et, cursus quis neque. Donec suscipit dui leo, vehicula pellentesque nunc rhoncus vel. Aliquam tempus justo eu orci faucibus fermentum. </p>
      </div>
      <div class="col-xs-12  col-sm-4  push-down-30">
        <div class="motivational-stories__circle">
          <span class="glyphicon  glyphicon-record" style="color:#DC2742"></span>
        </div>
        <h5>It increase your health resistance</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam auctor pulvinar et, cursus quis neque. Donec suscipit dui leo, vehicula pellentesque nunc rhoncus vel. Aliquam tempus justo eu orci faucibus fermentum. </p>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <!-- Navigation for products -->
  <div class="products-navigation  push-down-15">
    <div class="row">
      <div class="col-xs-12  col-sm-8">
        <div class="products-navigation__title">
          <h3><span class="light">Menu</span> Katering</h3>
        </div>
      </div>
      <div class="col-xs-12  col-sm-4">
        <div class="products-navigation__arrows">
          <a href="#js--latest-products-carousel" data-slide="prev"><span class="glyphicon  glyphicon-chevron-left  glyphicon-circle  products-navigation__arrow"></span></a>&nbsp;
          <a href="#js--latest-products-carousel" data-slide="next"><span class="glyphicon  glyphicon-chevron-right  glyphicon-circle  products-navigation__arrow"></span></a>
        </div>
      </div>
    </div> <!-- ./row -->
  </div> <!-- ./products-navigation -->
  <!-- Products -->
  <div id="js--latest-products-carousel" class="carousel slide" data-ride="carousel" data-interval="3000">
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <div class="row">
          <?php 
            for($i=0; $i<4; $i++){ 
              if(isset($menu_catering[$i])){
                    
          ?>
          <div class="col-xs-6 col-sm-3  js--isotope-target  js--cat-5" data-price="<?php echo $menu_catering[$i]['point']; ?>" data-rating="5">
            <div class="products__single">
              <figure class="products__image">
                <a href="<?php echo base_url().'product/single?po='.$menu_catering[$i]['id'];?>">
                  <img alt="#" class="product__image" width="263" height="334" src="<?php echo UPLOAD_IMAGE_DIR;?>/<?php echo $menu_catering[$i]['image']; ?>">
                </a>
                <div class="product-overlay">
                  <a class="product-overlay__more" href="<?php echo base_url().'product/single?po='.$menu_catering[$i]['id'];?>">
                    <span class="glyphicon glyphicon-search"></span>
                  </a>
                  <a class="product-overlay__cart" href="#">
                    +<span class="glyphicon glyphicon-shopping-cart"></span>
                  </a>
                  <div class="product-overlay__stock">
                    <span class="in-stock">&bull;</span> <span class="in-stock--text">In stock</span>
                  </div>
                </div>
              </figure>
              <div class="row">
                <div class="col-xs-6">
                  <h5 class="products__title">
                    <a class="products__link  js--isotope-title" href="<?php echo base_url().'product/single?po='.$menu_catering[$i]['id'];?>"><?php echo $menu_catering[$i]['title']; ?></a>
                  </h5>
                </div>
                <div class="col-xs-6">
                  <div class="products__price">
                    <?php echo number_format($menu_catering[$i]['point'], 0, ',', '.'); ?> Point
                  </div>
                </div>
              </div>
              <div class="products__category">
                <?php echo $menu_catering[$i]['category']; ?>
              </div>
            </div>
          </div>
          <?php   
            if($i==1 or $i==3){
              echo '<div class="clearfix visible-xs"></div> ';
              }
            }
          } 
          ?>          
        </div> <!-- ./row -->
      </div> <!-- ./item-active -->
      <?php 
        if(sizeof($menu_catering) > 4){ 
          $page_number = ceil(sizeof($menu_catering) / 4);
          
          for($i=1; $i<$page_number; $i++){
      ?>
      <div class="item">
        <div class="row">
           <?php 
           for($j=0;$j<4;$j++){ 
                  $idx = $i*4+$j;
                  if(isset($menu_catering[$idx])){
                    
          ?>
          <div class="col-xs-6 col-sm-3  js--isotope-target  js--cat-5" data-price="<?php echo $menu_catering[$idx]['point']; ?>" data-rating="5">
            <div class="products__single">
              <figure class="products__image">
                <a href="<?php echo base_url().'product/single?po='.$menu_catering[$idx]['id'];?>">
                  <img alt="#" class="product__image" width="263" height="334" src="<?php echo UPLOAD_IMAGE_DIR;?>/<?php echo $menu_catering[$idx]['image']; ?>">
                </a>
                <div class="product-overlay">
                  <a class="product-overlay__more" href="<?php echo base_url().'product/single?po='.$menu_catering[$idx]['id'];?>">
                    <span class="glyphicon glyphicon-search"></span>
                  </a>
                  <a class="product-overlay__cart" href="#">
                    +<span class="glyphicon glyphicon-shopping-cart"></span>
                  </a>
                  <div class="product-overlay__stock">
                    <span class="in-stock">&bull;</span> <span class="in-stock--text">In stock</span>
                  </div>
                </div>
              </figure>
              <div class="row">
                <div class="col-xs-6">
                  <h5 class="products__title">
                    <a class="products__link  js--isotope-title" href="<?php echo base_url().'product/single?po='.$menu_catering[$idx]['id'];?>"><?php echo $menu_catering[$idx]['title']; ?></a>
                  </h5>
                </div>
                <div class="col-xs-6">
                  <div class="products__price">
                    <?php echo number_format($menu_catering[$idx]['point'], 0, ',', '.'); ?> Poin
                  </div>
                </div>
              </div>
              <div class="products__category">
                <?php echo $menu_catering[$idx]['tags']; ?>
              </div>
            </div>
          </div>
          <?php 
                  if($j==1 or $j==3){
                      echo '<div class="clearfix visible-xs"></div> ';
                    }
                }
              } 
          ?>
        </div>
      </div>
      <?php   
            }
          } 
      ?>
    </div> <!-- ./carousel-inner -->
  </div> <!-- ./js-product-carousel -->
  <script>
    //$(document).ready(function() { $('#js--latest-products-carousel').carousel({ interval: 2000, cycle: true }); });
  </script>
  <!-- Navigation -->
  <div class="products-navigation  push-down-15">
    <div class="products-navigation__title">
      <h3><span class="light">Ready to</span> Eat</h3>
    </div>
  </div>

  <!-- Products -->
  <?php 
      $page_number = ceil(sizeof($menu_rte) / 4);
      
      for($i=0; $i<$page_number; $i++){
  ?>
  <div class="row">
    <?php 
      for($j=0;$j<4;$j++){ 
        $idx = $i*4+$j;
        if(isset($menu_rte[$idx])){
          if($j==2){
            echo '<div class="clearfix visible-xs"></div> ';
          }
              
    ?>
    <div class="col-xs-6 col-sm-3  js--isotope-target  js--cat-2" data-price="<?php echo $menu_rte[$idx]['price']; ?>" data-rating="5">
      <div class="products__single">
        <figure class="products__image">
          <a href="<?php echo base_url().'product/single?po='.$menu_rte[$idx]['id'];?>">
            <img alt="#" class="product__image" width="263" height="334" src="<?php echo UPLOAD_IMAGE_DIR;?>/<?php echo $menu_rte[$idx]['image']; ?>">
          </a>
          <div class="product-overlay">
            <a class="product-overlay__more" href="<?php echo base_url().'product/single?po='.$menu_rte[$idx]['id'];?>">
              <span class="glyphicon glyphicon-search"></span>
            </a>
            <a class="product-overlay__cart" href="#">
              +<span class="glyphicon glyphicon-shopping-cart"></span>
            </a>
            <div class="product-overlay__stock">
              <span class="in-stock">&bull;</span> <span class="in-stock--text">In stock</span>
            </div>
          </div>
        </figure>
        <div class="row">
          <div class="col-xs-6">
            <h5 class="products__title">
              <a class="products__link  js--isotope-title" href="<?php echo base_url().'product/single?po='.$menu_rte[$idx]['id'];?>"><?php echo $menu_rte[$idx]['title']; ?></a>
            </h5>
          </div>
          <div class="col-xs-6">
            <div class="products__price">
              Rp <?php echo number_format($menu_rte[$idx]['price'], 0, ',', '.'); ?>
            </div>
          </div>
        </div>
        <div class="products__category">
          <?php echo $menu_rte[$idx]['tags']; ?>
        </div>
      </div>
    </div>
    <?php }
        } 
    ?>
  </div>      
  <?php   
        } 
  ?>
  <!-- ./Products -->
</div><!-- ./Products-container -->
<!-- <div class="simple-map  js--where-we-are" data-latlng="<?php echo $options['company_map_lat'];?>,<?php echo $options['company_map_long'];?>" data-markers="[{lat: <?php echo $options['company_map_lat'];?>,lng: <?php echo $options['company_map_long'];?>,title: '<?php echo $options['company_map_name'];?>'}]" data-zoom="14"></div> -->