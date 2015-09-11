<div class="container">
	<br><br>
	<div class="row">
		<div class="col-xs-12  col-sm-3">
      <aside class="sidebar  sidebar--shop">
        <!-- <h3 class="sidebar__title"><span class="light">Organic</span> Shop</h3> -->
        <hr class="shop__divider">
        <div class="shop-filter">

          <h5 class="sidebar__subtitle">Categories</h5>
          <ul class="nav  nav--filter">
          	<?php 
          		foreach($category->result() as $cat){
          	?>
          		<li><a data-target=".js--cat-1" class="js--filter-selectable" href="#"><?php echo $cat->category; ?></a></li>
          	<?php
          		}
          	?>
            <!-- <li><a data-target=".js--cat-1" class="js--filter-selectable" href="#">Bars</a></li>
          
            <li><a data-target=".js--cat-2" class="js--filter-selectable" href="#">Powders</a></li>
          
            <li><a data-target=".js--cat-3" class="js--filter-selectable" href="#">Bio</a></li>
          
            <li><a data-target=".js--cat-4" class="js--filter-selectable" href="#">Seed</a></li>
          
            <li><a data-target=".js--cat-5" class="js--filter-selectable" href="#">Muesli</a></li>
          
            <li><a data-target=".js--cat-6" class="js--filter-selectable" href="#">Natural Proteins</a></li>
          
            <li><a data-target=".js--cat-7" class="js--filter-selectable" href="#">Other</a></li> -->
          
          </ul>

          <hr class="divider">

          <!-- <h5 class="sidebar__subtitle">Price</h5>
          <div class="shop__filter__slider">
            <div class="js--jqueryui-price-filter"></div>
          </div>

          <hr class="divider"> -->
          <!-- <nav>
            <h5 class="sidebar__subtitle">Country</h5>
            <ul class="nav  nav--filter">
              <li><a href="#">Croatia</a></li>
              <li><a href="#">Ireland</a></li>
              <li><a href="#">Slovenia</a></li>
              <li><a href="#">United Kingdom</a></li>
              <li><a href="#">USA</a></li>
            </ul>
          </nav>
          <hr class="divider"> -->
        </div>
      </aside>
    </div> <!-- ./col-sm-3 -->
    <div class="col-xs-12  col-sm-9">
      <div class="grid">
        <!-- <ul class="pagination  shop__amount-filter">
          <li>
            <a class="shop__amount-filter__link  hidden-xs" href="shop.html"><span class="glyphicon glyphicon-th"></span></a>
          </li>
          <li>
              <a class="shop__amount-filter__link  hidden-xs" href="shop-list-view.html"><span class="glyphicon glyphicon-th-list"></span></a>
          </li>
        </ul> -->
        <!-- <div class="shop__sort-filter">
          <select class="js--isotope-sorting  btn  btn-shop">
              <option value='{"sortBy":"price", "sortAscending":"true"}'>By Price (Low to High) &uarr;</option>
              <option value='{"sortBy":"price", "sortAscending":"false"}'>By Price (High to Low) &darr;</option>
              <option value='{"sortBy":"name", "sortAscending":"true"}'>By Name (Low to High) &uarr;</option>
              <option value='{"sortBy":"name", "sortAscending":"false"}'>By Name (High to Low) &darr;</option>
              <option value='{"sortBy":"rating", "sortAscending":"true"}'>By Rating (Low to High) &uarr;</option>
              <option value='{"sortBy":"rating", "sortAscending":"false"}'>By Rating (High to Low) &darr;</option>
          </select>
        </div> -->
        <hr class="shop__divider">
        <div class="row">
          <?php 
              $page_number = ceil(sizeof($menu_rte) / 4);
              
              for($i=0; $i<$page_number; $i++){
          ?>
              <div class="row">
                <?php 
                  for($j=0;$j<4;$j++){ 
                    $idx = $i*4+$j;
                    if(isset($menu_rte[$idx])){
                      
                ?>
                  <div class="col-xs-6 col-sm-3  js--cat-1" data-price="<?php echo $menu_rte[$idx]['price'];?>" data-rating="5">
                    <div class="products__single">
                      <figure class="products__image">
                        <a href="<?php echo base_url().'product/single?po='.$menu_rte[$idx]['id'];?>">
                          <img alt="#" class="product__image" width="263" height="234" src="<?php echo UPLOAD_IMAGE_DIR;?>/<?php echo $menu_rte[$idx]['image']; ?>">
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
                        <div class="col-xs-9">
                          <h5 class="products__title">
                            <a class="products__link  js--isotope-title" href="<?php echo base_url().'product/single?po='.$menu_rte[$idx]['id'];?>"><?php echo $menu_rte[$idx]['title']; ?></a>
                          </h5>
                        </div>
                        <div class="col-xs-3">
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
                  <?php 
                          if($j==1){
                            echo '<div class="clearfix visible-xs"></div> ';
                          }
                          if($j==3){
                            echo '<div class="clearfix  visible-xs"></div>';
                            echo '<div class="clearfix  hidden-xs"></div>';
                          }
                        }
                      } 
                  ?>
                </div>
              
              <?php   
                    } 
              ?>
          
          
        </div>
        <hr class="shop__divider">
        <!-- <div class="shop__pagination">
          <ul class="pagination">
            <li><a class="pagination--nav" href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
            <li><a href="#">1</a></li>
            <li><a class="active" href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a class="pagination--nav" href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
          </ul>
        </div> -->
      </div>
    </div>
	</div> <!-- ./first-row -->
</div> <!-- ./container -->