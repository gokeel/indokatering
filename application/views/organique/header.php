<?php
  define('ORGANIQUE_DIR', base_url('assets/themes/organique/'));
  define('GENERAL_JS_DIR', base_url('assets/themes/js/'));
  define('GENERAL_CSS_DIR', base_url('assets/themes/css/'));
  define('UPLOAD_IMAGE_DIR', base_url('assets/uploads/'));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="IndoKatering">
    <link rel="icon" type="image/ico" href="<?php echo ORGANIQUE_DIR;?>/images/favicon.png">

    <title><?php echo $options['web_title']; ?></title>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo ORGANIQUE_DIR;?>/stylesheets/2eef9d0d.main.css"/>
    <link rel="stylesheet" href="<?php echo GENERAL_CSS_DIR;?>/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4//jquery-ui.js" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Google fonts -->
    <script type="text/javascript">
      WebFontConfig = {
        google: { families: [ 'Arvo:700:latin', 'Open+Sans:400,600,700:latin' ] }
      };
      (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
          '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })();
    </script>
    <script src="<?php echo GENERAL_JS_DIR;?>/jQuery-2.1.3.min.js"></script>
    <script src="<?php echo GENERAL_JS_DIR;?>/jquery-ui.js"></script>
    <script src="<?php echo GENERAL_JS_DIR;?>/functions.js"></script>
    <!--<script src="<?php echo GENERAL_JS_DIR;?>/carousel.js"></script>-->
    
  </head>
  <body>
    <div class="top  js--fixed-header-offset">
  <div class="container">
    <div class="row">
      <div class="col-xs-12  col-sm-6">
        <div class="top__slogan">
          <?php // echo $options['web_slogan']; ?>
        </div>
      </div>
      <div class="col-xs-12  col-sm-6">
        <div class="top__menu">
          <ul class="nav  nav-pills">
            <?php if($this->session->userdata('logged')<>'in'){?>
            <li><a href="#registerModal" role="button" data-toggle="modal">Register</a></li>
            <li><a href="#loginModal" role="button" data-toggle="modal">Login</a></li>
            <?php }
              else{
            ?>
            <li>Hai, <?php echo $this->session->userdata('fn');?></li>
            <li class="dropdown  js--mobile-dropdown">
              <a class="dropdown-toggle" href="#">
                <span class="glyphicon  glyphicon-user"></span> <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url('profile');?>">My Account</a></li>
                <li><a href="<?php echo base_url('users/do_logout');?>">Log Out</a></li>
              </ul>
            </li>
            <?php } ?>
          </ul>
        </div> <!-- ./top_menu -->
      </div> <!-- ./col -->
    </div> <!-- ./row -->
  </div> <!-- ./container -->
</div>

<!-- Modal register-->
<div class="modal  fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content  center">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h3><span class="light">Register</span> to <?php echo $options['web_title'];?></h3>
        <hr class="divider">
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('users/user_add');?>" class="push-down-15">
          <div class="form-group">
            <input type="email" class="form-control form-control--contact input-sm" name="email" placeholder="Email" required>
            <input type="hidden" name="level" value="customer" />
          </div>
          <div class="form-group">
            <input type="password" class="form-control form-control--contact input-sm" name="pass" placeholder="Password" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control--contact input-sm" name="fn" placeholder="First Name" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control--contact input-sm" name="ln" placeholder="Last Name">
          </div>
          <div class='input-group'>
            <label>Enter text/number appear on image below:</label><br />
            <?php echo $captcha;?>
            <input class="form-control"  type="text" name="captcha" id="captcha" required />
          </div>
          <button type="submit" class="btn  btn-primary">REGISTER</button>
        </form>
        <a data-toggle="modal" role="button" href="#loginModal" data-dismiss="modal">Already Registered?</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal login-->
<div class="modal  fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content  center">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3><span class="light">Login</span> to <?php echo $options['web_title'];?></h3>
        <hr class="divider">
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('users/do_login');?>" class="push-down-15" id="form-login">
          <div class="form-group">
            <input type="email" id="name" name="email" class="form-control  form-control--contact" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="password" id="subject" name="password" class="form-control  form-control--contact" placeholder="Password">
          </div>
          <a href="<?php echo base_url('frontpage/forgot_password');?>"><span style="color: #A3080C">Forgot password?</span></a>
          <button type="button" id="sign-in" class="btn btn-primary">SIGN IN</button>
          <p id="message"></p>
        </form>
      </div>
    </div>
  </div>
</div>
<header class="header">
  <div class="container">
    <div class="row">
      <div class="col-xs-10  col-md-3">
        <div class="header-logo">
          <a href="<?php echo base_url();?>"><img alt="Logo" src="<?php echo ORGANIQUE_DIR;?>/images/logo.png" width="200" height="90"></a>
        </div>
      </div>
      <div class="col-xs-2  visible-sm  visible-xs">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle  collapsed" data-toggle="collapse" data-target="#collapsible-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
      </div>
      <div class="col-xs-12  col-md-7">
        <nav class="navbar  navbar-default" role="navigation">
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse  navbar-collapse" id="collapsible-navbar">
            <ul class="nav  navbar-nav">
              <li>
                <a href="<?php echo base_url();?>" class="dropdown-toggle">Home</a>
              </li>
              <li>
                <a href="<?php echo base_url('catering');?>" class="dropdown-toggle">Catering</a>
              </li>
              <li>
                <a href="<?php echo base_url('ready-to-eat');?>" class="dropdown-toggle">Ready To Eat</a>
              </li>
              <!-- <li><a href="#">Catering</a></li>
              <li><a href="#">Recipes</a></li> -->
              <li>
                <a href="<?php echo base_url('points');?>">Beli Poin</a>
              </li>
              <li>
                <a href="<?php echo base_url('blog/cat/resep');?>">Resep</a>
              </li>
            </ul>
            <!-- search for mobile devices -->
            <form action="#" method="post" class="visible-xs  visible-sm  mobile-navbar-form" role="form">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon">
                  <button type="submit" class="mobile-navbar-form__appended-btn"><span class="glyphicon  glyphicon-search  glyphicon-search--nav"></span></button>
                </span>
              </div>
            </form>
            <div class="mobile-cart  visible-xs  visible-sm  push-down-15">
                <span class="header-cart__text--price"><span class="header-cart__text">CART</span> Rp <?php echo number_format($cart['total'], 0, '.', ',');?></span>
              <a href="<?php echo base_url('frontpage/checkout');?>" class="header-cart__items">
                <span id="mobile-cart-num" class="header-cart__items-num"><?php echo $cart['count'];?></span>
              </a>
            </div>
          </div><!-- /.navbar-collapse -->
        </nav>
      </div>
      <div class="col-xs-12  col-md-2  hidden-sm  hidden-xs">
        <!-- Cart in header -->
        <div class="header-cart">
          <span class="header-cart__text--price"><span class="header-cart__text">CART</span> Rp <?php echo number_format($cart['total'], 0, '.', ',');?></span>
          <a href="#" class="header-cart__items">
            <span id="header-cart-num" class="header-cart__items-num"><?php echo $cart['count'];?></span>
          </a>
          <!-- Open cart panel -->
          
          <div class="header-cart__open-cart">
            <div id="cart-product">
              <?php if($cart['count']>0){ 
                      foreach($cart['data'] as $row){?>
              <div class="header-cart__product  clearfix  js--cart-remove-target">
                <div class="header-cart__product-image">
                  <img alt="Product in the cart" src="<?php echo $this->config->item('upload_path').$row['image'];?>" width="40" height="50">
                </div>
                <div class="header-cart__product-image--hover">
                  <a onclick="remove_cart_item('<?php echo $row['id'];?>')" class="js--remove-item" data-target=".js--cart-remove-target"><span class="glyphicon  glyphicon-circle  glyphicon-remove"></span></a>\
                </div>
                <div class="header-cart__product-title">
                  <a class="header-cart__link" href="#"><?php echo $row['title'];?></a>
                  <span class="header-cart__qty">
                    Qty: <?php echo $row['qty'];?> 
                    <?php if($row['price'] >= 1000) echo 'x Rp '.number_format($row['price'], 0, '.', ',');
                          else echo 'x '.$row['price'].' Poin';
                    ?>
                  </span>
                </div>
                <div class="header-cart__price">
                  <?php 
                    if($row['price']<1000)
                      echo $row['total_price_item'].' Poin';
                    else
                      echo 'Rp '.number_format($row['total_price_item'], 0, '.', ',');?>
                </div>
              </div>
              <?php }
                } ?>
            </div>
          
            <hr class="header-cart__divider">
            <div class="header-cart__subtotal-box">
              <span class="header-cart__subtotal">CART SUBTOTAL:</span>
              <span class="header-cart__subtotal-price">Rp <?php echo number_format($cart['total'], 0, '.', ',');?></span>
            </div>
            <a class="btn btn-darker" href="<?php echo base_url('frontpage/checkout');?>">Proceed to checkout</a>
          </div>
        </div>
  
      </div>
    </div>
  </div>

  <!--Search open pannel-->
  <!-- <div class="search-panel">
    <div class="container">
      <div class="row">
        <div class="col-sm-11">
          <form class="search-panel__form" action="search-results.html">
            <button type="submit"><span class="glyphicon  glyphicon-search"></span></button>
            <input type="text" name="s" class="form-control" placeholder="Enter your search keyword">
          </form>
        </div>
        <div class="col-sm-1">
          <div class="search-panel__close  pull-right">
            <a href="#" class="js--toggle-search-mode"><span class="glyphicon  glyphicon-circle  glyphicon-remove"></span></a>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</header>
<!-- <div class="breadcrumbs  no-margin">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <nav>
          <ol class="breadcrumb">
            
            <li><a href="index.html">Home</a></li>
            
            <li><a href="shop.html">Shop</a></li>
            
            <li class="active">Cart</li>
            
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div> -->
      <?php //for message after submitting data
        if($this->session->flashdata('err_no')=='200' or $this->session->flashdata('err_no')=='0'){
      ?>
      <div class="alert alert-success uppercase fade in" style="margin:20px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-check"></i>
        <?php echo $this->session->flashdata('err_msg');?>
      </div>
      <?php 
        } else if($this->session->flashdata('err_no')=='204' or $this->session->flashdata('error_upload_no')=="204"){
      ?>
      <div class="alert alert-danger uppercase fade in" style="margin:20px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        <?php echo $this->session->flashdata('err_msg');?>
      </div>
      <?php 
        }
      ?>

<script>
  //submitting form
    $('#sign-in').on('click', function() {
      $.ajax({
        type : "POST",
        url: '<?php echo base_url();?>users/do_login',
        data: $( "#form-login" ).serialize(),
        dataType: "json",
        success:function(data){
          if(data.status == "200")
            window.location.href = "<?php echo base_url($this->session->flashdata('curr_page'));?>";
          else if(data.status == "204"){
            $('#message').empty();
            $('#message').append('Username and password not matched.');
          }
        }
      });
    });
</script>