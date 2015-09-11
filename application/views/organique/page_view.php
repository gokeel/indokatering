<div class="container  push-down-30">
  <hr class="divider">
  <div class="row">
    <div class="col-xs-12  col-sm-8  col-sm-push-4">
      <section>
        <?php 
          if($page == false){ ?>
        Maaf, halaman anda cari tidak ditemukan.
        <?php 
          }
          else{
        ?>
        <h3><span class="light"><?php echo $page->title; ?></span></h3>
        <hr>
        <div class="row">
          <div class="col-xs-12 col-sm-12">
            <p><?php echo $page->content; ?></p>
          </div>
        </div>
        <?php 
            }
        ?>
        
      </section>
    </div>
    <div class="col-xs-12  col-sm-4  col-sm-pull-8">
      <aside class="sidebar  sidebar--blog">
        <div class="sidebar-container">
          <h3><span class="light">Flickr</span> Images</h3>
          <hr>
            <!-- Go to http://www.flickrbadge.com/, generate a code, paste it here and remove the <style> tag -->
          <div class="flickr-badge  clearfix">
            <div id="flickr_badge_wrapper"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=10&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=41370268@N04"></script></div>
          </div>
        </div>
        <nav class="sidebar-container">
          <h3><span class="light">Blog</span> Posts Archive</h3>
          <hr>
          <ul class="nav-blog">
            <?php if($group_month <> false) {
              foreach($group_month as $month){
            ?>
            <li><a href="#"><?php echo $month->group_date;?></a> (<?php echo $month->count; ?>)</li>
            <?php }
            } ?>
          </ul>
        </nav>
        <div class="sidebar-container">
          <h3><span class="light">Twitter</span> Feed</h3>
          <hr>
          <a class="twitter-timeline" href="https://twitter.com/ProteusNetCom" data-widget-id="428877992446554113">Tweets by @ProteusNetCom</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
        <!-- <nav class="sidebar-container">
          <h3><span class="light">Latest</span> Comments</h3>
          <hr>
          <ul class="nav-blog">
            <li><a href="#">Jaka Smid</a> on <a href="#">Simple Post Without Image</a></li>
            <li><a href="#">Primoz Cigler</a> on <a href="#">Hello World!</a></li>
            <li><a href="#">Marko Prelec</a> on <a href="#">Organique post with an image</a></li>
            <li><a href="#">Jaka Smid</a> on <a href="#">Simple Post Without Image</a></li>
            <li><a href="#">Primoz Cigler</a> on <a href="#">Hello World!</a></li>
            <li><a href="#">Marko Prelec</a> on <a href="#">Organique post with an image</a></li>
            <li><a href="#">Jaka Smid</a> on <a href="#">Simple Post Without Image</a></li>
            <li><a href="#">Primoz Cigler</a> on <a href="#">Hello World!</a></li>
            <li><a href="#">Marko Prelec</a> on <a href="#">Organique post with an image</a></li>
          </ul>
        </nav> -->
      </aside>
          </div>
        </div>
      </div>