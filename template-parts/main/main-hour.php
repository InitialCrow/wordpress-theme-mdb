<?php

/*
  Template Name: hour
*/

  $blocks = $post->blocks;
  $hours = $post->openStatus;
  //var_dump($blocks);
?>
<section id="hours" class="main-section hour border-title scrollme">
  <div class="wrap-title">
    <h2 class="hour-title main-section-title animateme" data-when="enter" data-from="1" data-to="0.5" data-opacity="0"><?php echo $blocks['section5 titre principal']['innerHTML']; ?></h2>
  </div>
  <div class="hour-sec open animateme" data-when="enter" data-from="1" data-to="0.5"  data-opacity="0" data-translatex="-200">
    <span class="hour-sec-title"><span class="hours-bg"></span><?php echo $blocks['section5 titre1']['innerHTML']; ?></span>
    <div class="hour-info">
      <div class="wrap-hour-info">
        <?php echo $blocks['section5 horraire']['innerHTML']; ?>

      </div>
      <div class="info-spacer"></div>
      <div class="wrap-hour-info">
        <?php echo $blocks['section5 descriptif1']['innerHTML']; ?>

      </div>
    </div>
  </div><!--
--><div class="placeholder">

  </div><!--
--><div class="hour-sec status-sec animateme" data-when="enter" data-from="1" data-to="0.5"  data-opacity="0" data-translatex="200">
    <span class="hour-sec-title"><span class="status-bg"></span><?php echo $blocks['section5 titre2']['innerHTML']; ?></span>
    <div class="hour-info">

      <div class="wrap-hour-info">
        <?php $class="closed"; if($hours == "Ouvert")$class="open";?>
        <p class="status"><span class="status-color <?php echo $class ?>"></span>STATUT : <?php echo $hours ?></p>
        <span class="warning-bg"></span><!--
      --><p class="warning"><?php echo $blocks['section5 descriptif2']['data']; ?></p>
        <div class="wrap-btn">

          <button type="button" class="reserve-btn">

            <?php echo $blocks['section5 btn1']['data']; ?>
          </button>
        </div>
      </div>
    </div>

  </div>
</section>

