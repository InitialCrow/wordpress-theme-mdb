<?php

/*
  Template Name: branding
*/
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  $blocks = $post->blocks;

?>
  <div class="wrap-head">
    <div class="title-wrap">
      <h1 class="main-title"><?php echo $blocks['logo principal']['innerHTML']; ?></h1>
      <a class="show-galerie animA" href="#gal">Voir la Galerie</a>
      <?php if(is_plugin_active('wordpress-plugin-mdb-order/product.php')):?>
        <a class="show-buy" href="/commander">Commander</a>
      <?php endif ?>
    </div>
    <div class="main-slogan"><span class="toc-bg"></span><?php echo $blocks["slogan"]['innerHTML']; ?><span class="toc-bg"></span></div>
    <ul class="social-list">
      <li class="social-list-item fb"><a href="<?php echo $blocks['facebook link']['data']  ?>" class="png-bg"><img  src="<?php echo get_template_directory_uri()."/assets/facebook.png" ?>" alt="faceebook logo"></a></li><li class="social-list-item tripot"><a href="<?php echo $blocks['tripadvisor link']['data']  ?>" class="png-bg"><img  src="<?php echo get_template_directory_uri()."/assets/trip.png" ?>" alt="tripadvisor logo"></a></li>
    </ul>
  </div>
  <div class="filter"></div>




