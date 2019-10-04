<?php

/*
  Template Name: news
*/

  $blocks = $post->blocks;
  do_action('get_publish',$post);
  $p = $post->publish;

?>
<section id="news" class="main-section news scrollme">
  <div class="wrap-title">
    <h2 class="news-title main-section-title animateme" data-when="enter" data-from="1" data-to="0.7"  data-opacity="0"><?php echo $blocks["section3 titre principal"]["innerHTML"]; ?></h2>
    <div class="network-content animateme" data-when="enter" data-from="1" data-to="0.5"  data-opacity="0">
      <ul class="social-post">
        <?php foreach($p as $po): $class="unclickable";?>

          <li class="social-network-item">
            <div class="publish-title">
              <span class="title-social"><?php echo $po->post_title ?></span><!--
            --><span class="date"><?php $origDate = $po->post_date ; $newDate = date("d M Y h:i", strtotime($origDate)); echo $newDate ?></span>

            </div>
            <div class="publish-info">
              <div class="publish-content">
                <?php echo $po->post_content; ?>
              </div>
            </div><!--
         --><div class="publish-logo">
            </div><!--
         --><div class="publish-func">
              <ul class="publish-func-list" data-post-id="<?php echo $po->ID?>">
                <?php
                      if($_SESSION['can_like'][$po->ID] !== true){
                        $class="clickable-like";
                      }
                ?>
                <li data-like="1" class="like-bg <?php echo $class ?>"><?php echo $po->likes->ulike?$po->likes->ulike : '0' ?></li><!--
             --><li data-like="0" class="unlike-bg <?php echo $class ?>"><?php echo $po->likes->udislike?$po->likes->udislike : '0' ?></li>
              </ul>
            </div>
          </li>
        <?php endforeach; ?>
        <?php if(empty($p)): ?>
          <li class="social-network-item center">
            <div class="publish-title">
              <span class="title-social">Rien à partager</span>
            </div>
            <div class="publish-info">
              <div class="publish-content">
                <p> Pas de news spéciales pour le moment .</p>
              </div>
            </div>
          </li>
        <?php endif; ?>
      </ul>
    </div>
    <div class="fb-content border-title">

      <div class="wrap-content animateme" data-when="enter" data-from="1" data-to="0"  data-opacity="0" data-translatex="600">
        <img class="profile-img" src="<?php echo get_template_directory_uri().'/assets/fb.png'?>" alt="logo de facebook"><!--
        --><div class="info">
          <span class="title"><?php echo $blocks["section3 titre1"]["innerHTML"]; ?><span class="underline"></span></span>
          <p class="content-info scrollbar-1">
            <?php echo $blocks["section3 descriptif1"]["data"]; ?>
          </p>
          <a href="<?php echo $blocks['facebook link']['data'] ?>" class="link-fb-page"><span class="link-text">Voir la page </span><span class="arrow">&#8594;</span></a>
        </div>
      </div>

    </div>
  </div>
</section>

