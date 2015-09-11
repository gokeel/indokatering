<div class="container">
	<?php 
		foreach($menu_catering as $key => $menu){
	?>
	<div class="products-navigation  push-down-15">
      <div class="products-navigation__title">
        <h3><span class="light"><?php echo $key; ?></span> </h3>
      </div>
    </div>
    <!-- Products -->
    <?php 
        $page_number = ceil(sizeof($menu) / 4);
        
        for($i=0; $i<$page_number; $i++){
    ?>
    <div class="row">
         <?php 
         for($j=0;$j<4;$j++){ 
                $idx = $i*4+$j;
                if(isset($menu[$idx])){
                  if($i==2){
                    echo '<div class="clearfix visible-xs"></div> ';
                  }
                  
        ?>
        <div class="col-xs-6 col-sm-3  js--isotope-target  js--cat-2" data-price="<?php echo $menu[$idx]['point']; ?>" data-rating="5">
          <div class="products__single">
            <figure class="products__image">
              <a href="<?php echo base_url().'product/single?po='.$menu[$idx]['id'];?>">
                <img alt="#" class="product__image" width="263" height="334" src="<?php echo UPLOAD_IMAGE_DIR;?>/<?php echo $menu[$idx]['image']; ?>">
              </a>
              <div class="product-overlay">
                <a class="product-overlay__more" href="<?php echo base_url().'product/single?po='.$menu[$idx]['id'];?>">
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
                  <a class="products__link  js--isotope-title" href="<?php echo base_url().'product/single?po='.$menu[$idx]['id'];?>"><?php echo $menu[$idx]['title']; ?></a>
                </h5>
              </div>
              <div class="col-xs-6">
                <div class="products__price">
                  <?php echo number_format($menu[$idx]['point'], 0, ',', '.'); ?> Poin
                </div>
              </div>
            </div>
            <div class="products__category">
              <?php echo $menu[$idx]['tags']; ?>
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
	<?php
		}
	?>
	

    
</div>