<div class="container  push-down-30">
  <hr class="divider">
  <div class="row">
    <div class="col-xs-12  col-sm-8  col-sm-push-4">
      <section>
        <?php 
          if($posts == false){ ?>
        Maaf, tidak ada postingan disini.
        <?php 
          }
          else{
            foreach($posts as $post){
        ?>
        <article>
          <?php if($post['image']<>false){ ?>
          <a href="#<?php //echo base_url('blog/view?id='.$post['id']);?>"><img class="wp-post-image" alt="Blog featured image" src="<?php echo UPLOAD_IMAGE_DIR.'/'.$post['image'];?>" width="247" height="284"></a>
          <?php } ?>
          <header>
            <h3 class="blog-title"><a href="#<?php //echo base_url('blog/view?id='.$post['id']);?>"><span class="light"><?php echo $post['title']; ?></span></a></h3>
            <div class="metadata  push-down-30">
              <time class="blog__date" datetime="<?php echo date_format(new DateTime($post['timestamp']), 'Y-m-d'); ?>"><?php echo date_format(new DateTime($post['timestamp']), 'j F Y'); ?></time> <!-- / <a class="secondary-link" href="single-post.html#comments">3 comments</a> -->
            </div>
          </header>
          <div class="blog-content__text">
            <p class="blog-content__text--highlight"><?php echo $post['content'];//substr($post['content'], 0, 200); ?></p>
            
            <?php if(strlen($post['content']) > 200) {?>
            <!-- <br>
            <a href="<?php echo base_url('blog/view?id='.$post['id']);?>"><span style="color:#FE4907">More...</span></a> -->
            <?php } ?>
          </div>
    
        </article>
        <hr class="divider">
        <?php 
            }
          } 
        ?>
        
      </section>

      <!-- <nav class="center">
        <ul class="pagination">
          <li><a class="pagination--nav" href="#"><span class="glyphicon  glyphicon-chevron-left"></span></a></li>
          <li><a href="#">1</a></li>
          <li><a class="active" href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a class="pagination--nav" href="#"><span class="glyphicon  glyphicon-chevron-right"></span></a></li>
        </ul>
      </nav> -->
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