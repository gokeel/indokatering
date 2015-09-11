  <footer class="js--page-footer">
    <div class="footer-widgets">
      <div class="container">
        <div class="row">
          <div class="col-xs-12  col-sm-3">
            <div class="footer-widgets__social">
              <img class="push-down-10" alt="Footer Logo" src="<?php echo ORGANIQUE_DIR;?>/images/logo-footer.png" width="139" height="35">
              <p class="push-down-15"><?php echo $options['web_slogan']; ?></p>
              <p class="push-down-15">Kami juga hadir di social media:</p>
              <a class="social-container" href="<?php echo $options['company_fb_link']; ?>"><span class="zocial-facebook"></span></a>
              <!-- <a class="social-container" href="https://twitter.com/ProteusNetCom"><span class="zocial-twitter"></span></a> -->
              <a class="social-container" href="mailto:<?php echo $options['company_email']; ?>"><span class="zocial-email"></span></a>
              <!-- <a class="social-container" href="http://www.youtube.com/user/ProteusNetCompany"><span class="zocial-youtube"></span></a> -->
            </div>
          </div>
          <div class="col-xs-12  col-sm-3">
            <nav class="footer-widgets__navigation">
              <div class="footer-wdgets__heading--line">
                <h4 class="footer-widgets__heading">Commerce</h4>
              </div>
              <ul class="nav nav-footer">
                <li><a href="index.html">Home</a></li>
                <li><a href="<?php echo base_url('frontpage/payment_confirmation');?>">Konfirmasi Pembayaran</a></li>
                <li><a href="<?php echo base_url('points');?>">Beli Poin</a></li>
                <!-- <li><a href="shop.html">Catering</a></li>
                <li><a href="blog.html">Recipe</a></li> -->
              </ul>
            </nav>
          </div>
          <div class="col-xs-12  col-sm-3">
            <div class="footer-widgets__navigation">
              <div class="footer-wdgets__heading--line">
                <h4 class="footer-widgets__heading">Panduan</h4>
              </div>
              <ul class="nav nav-footer">
                <li><a href="<?php echo base_url('page/how-it-works');?>">How It Works</a></li>
                <li><a href="<?php echo base_url('page/terms-and-conditions');?>">Terms and Conditions</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xs-12  col-sm-3">
            <div class="footer-widgets__navigation">
                <div class="footer-wdgets__heading--line">
                  <h4 class="footer-widgets__heading">Contact Us</h4>
                </div>
                <a class="footer__link" href="#"><?php echo $options['company_name']; ?></a><br>
                <?php echo $options['company_address']; ?><br>
                <?php echo $options['company_address_2']; ?><br>
                <?php echo $options['company_city']; ?>, <?php echo $options['company_province']; ?><br><br>
                <!-- <a class="footer__link--small" href="contact-2.html">View Google map <span class="glyphicon glyphicon-chevron-right glyphicon--footer-small"></span></a><br><br> -->
                <a class="footer__link" href="#"><span class="glyphicon glyphicon-earphone glyphicon--footer"></span> <?php echo $options['company_mobile']; ?></a><br>
                <a class="footer__link" href="#"><span class="glyphicon glyphicon-envelope glyphicon--footer"></span> <?php echo $options['company_email']; ?></a>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-xs-12  col-sm-6">
            <div class="footer__text--link">
              <a class="footer__link" href="#"></a> © Copyright 2015. <?php echo $options['web_title'];?>
            </div>
          </div>
          <div class="col-xs-12  col-sm-6">
            <div class="footer__text">
              Made with <span class="glyphicon  glyphicon-heart"></span> by <a class="footer__link" href="http://www.licosyd.com/" target="_blank">Licosyd</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <div class="search-mode__overlay"></div>
    
    
<script type="text/javascript">
  function downloadJSAtOnload() {
    var element = document.createElement("script");
    element.src = "<?php echo ORGANIQUE_DIR;?>/js/main.js";
    document.body.appendChild(element);
  }
  if (window.addEventListener)
    window.addEventListener("load", downloadJSAtOnload, false);
  else if (window.attachEvent)
    window.attachEvent("onload", downloadJSAtOnload);
  else window.onload = downloadJSAtOnload;
</script>

<script>
  $('[data-slide-to=0]').trigger('click');
  // $('.carousel').carousel({
  //   interval: 3000
  // })
  function cart_data(id, qty, type){
    var url_string = '';
    if (type=='add')
      url_string = '<?php echo base_url();?>order/add_cart/'+id+'/'+qty;
    else if(type=='remove')
      url_string = '<?php echo base_url();?>order/remove_item_from_cart/'+id;
    $.ajax({
        type : "POST",
        async: false,
        url: url_string,
        dataType: "json",
        success:function(data){
          $('#cart-product').empty();
          for(var i=0; i<data.cart.length; i++){
            var price_string = '';
            if(data.cart[i].price < 1000)
              price_string = data.cart[i].total_price_item+' Poin';
            else
              price_string = 'Rp '+currency_separator(data.cart[i].total_price_item, ',');

            var base_price = '';
            if(data.cart[i].price >= 1000)
              base_price = 'x Rp '+currency_separator(data.cart[i].price, ',');
            else
              base_price = 'x '+data.cart[i].price+' Poin';

            $('#cart-product').append('\
              <div class="header-cart__product  clearfix  js--cart-remove-target">\
                <div class="header-cart__product-image">\
                  <img alt="Product in the cart" src="<?php echo $this->config->item('upload_path');?>'+data.cart[i].image+'" width="40" height="50">\
                </div>\
                <div class="header-cart__product-image--hover">\
                  <a onclick="remove_cart_item(\''+data.cart[i].id+'\')" class="js--remove-item" data-target=".js--cart-remove-target"><span class="glyphicon  glyphicon-circle  glyphicon-remove"></span></a>\
                </div>\
                <div class="header-cart__product-title">\
                  <a class="header-cart__link" href="#">'+data.cart[i].title+'</a>\
                  <span class="header-cart__qty">Qty: '+data.cart[i].qty+' '+base_price+'</span>\
                </div>\
                <div class="header-cart__price">\
                  '+price_string+'\
                </div>\
              </div>');
          }
          $('.header-cart__items-num').text(data.count);
          $('.header-cart__text--price').empty();
          $('.header-cart__text--price').append('<span class="header-cart__text">CART</span> Rp '+currency_separator(data.total, ','));
          $('.header-cart__subtotal-price').text('Rp '+currency_separator(data.total, ','));
        }
      });
    }

    function remove_cart_item(id){
      cart_data(id, 0, 'remove');
    }

    function checkout_remove_cart_item(id){
      cart_data(id, 0, 'remove');
      location.reload();
    }
</script>    
</body>
</html>