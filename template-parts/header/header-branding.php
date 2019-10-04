<?php

/*
  Template Name: branding
*/

  $blocks = $post->blocks;

?>
  <div class="wrap-head">
    <div class="title-wrap">
      <h1 class="main-title"><?php echo $blocks['logo principal']['innerHTML']; ?></h1>
      <a class="show-galerie animA" href="#gal">Voir la Galerie</a>

    </div>
    <div class="main-slogan"><span class="toc-bg"></span><?php echo $blocks["slogan"]['innerHTML']; ?><span class="toc-bg"></span></div>
    <ul class="social-list">
      <li class="social-list-item fb"><a href="<?php echo $blocks['facebook link']['data']  ?>" class="png-bg"><img  src="<?php echo get_template_directory_uri()."/assets/facebook.png" ?>" alt="faceebook logo"></a></li><li class="social-list-item tripot"><a href="<?php echo $blocks['tripadvisor link']['data']  ?>" class="png-bg"><img  src="<?php echo get_template_directory_uri()."/assets/trip.png" ?>" alt="tripadvisor logo"></a></li>
    </ul>
  </div>
  <div class="filter"></div>




