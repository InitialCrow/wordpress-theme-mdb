<?php

/*
  Template Name: find
*/

  $blocks = $post->blocks;
  $hours = $post->openStatus;
?>
<section id="contact" class="main-section find border-title scrollme">
  <div class="wrap-title animateme" data-when="enter" data-from="1" data-to="0.5"  data-opacity="0">
    <h2 class="find-title main-section-title"><?php echo $blocks["section4 titre principal"]["innerHTML"]; ?></h2>
  </div>
  <div class="find-sec map-sec animateme" data-when="enter" data-from="1" data-to="0.5"  data-translatex="-200" data-opacity="0">
    <div class="map-title-wrap">
      <div class="pos-bg">

      </div>
      <p class="title-map"><span class="map-title">Map</span> <span class="map-info">* Parking publique à proximité</span></p>

    </div>
    <div class="map-wrap">
      <?php echo do_shortcode($blocks["map shortcode"]["innerHTML"]);  ?>
    </div>
  </div><!--
--><div class="find-sec findus animateme" data-when="enter" data-from="1" data-to="0.5"  data-translatex="200" data-opacity="0">
    <span class="findus-title"><span class="findus-bg"></span> Nous Contacter</span>
    <div class="findus-info">
      <ul class="contact-list">
<?php    $i = 0; $classLi = "contact-list-item"; ?>
<?php    foreach ($blocks["section4 contact"]["data"] as $li): ?>
<?php       if($i == 0 ){
            $classLi = "contact-list-item phone-bg";
          }
          else if($i ==1){
            $classLi = "contact-list-item email-bg";
          }
          else if($i ==2){
            $classLi = "contact-list-item email-address-bg";
          }
          else{
            $classLi = "contact-list-item";
          }
?>
          <li class="<?php echo $classLi; ?>"><?php echo $li; ?></li>
<?php     $i++ ;endforeach;?>
      </ul>
      <div class="info-spacer"></div>
      <?php $class="closed"; if($hours == "Ouvert")$class="open";?>
      <p class="status"><span class="status-color <?php echo $class ?>"></span>STATUT : <?php echo $hours ?></p>

    </div>
  </div>

</section>

