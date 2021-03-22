<?php

/*
  Template Name: welcome
*/
  $blocks = $post->blocks;


?>
<section id="welcome" class="main-section welcome border-title scrollme" <?php echo $post->blocks['section1 image fond']['innerHTML']; ?>>
  <div class="wrap-welcome">
    <div class="wrap-title">
      <div class="animateme" data-when="enter" data-from="1" data-to="0.5" data-opacity="0">
        <h2 class="welcome-title main-section-title scrollme">
          <?php echo $blocks["section1 titre principal"]["innerHTML"]; ?>
        </h2>
      </div>
    </div>
    <div class="animateme" data-when="enter" data-from="1" data-to="0.5" data-translatex="-200" data-opacity="0">
      <div class="welcome-b work">
        <div class="cover slider" >
          <ul class="image-list">
    <?php foreach ($blocks["section1 slider1"]['data'] as $src):?>
            <li class="image-list-item">
              <img src="<?php echo $src?>" alt="image de slider de la maison du boeuf">
            </li>
    <?php endforeach;?>
          </ul>
        </div><!--
        --><div class="info">
          <p class="b-title"><?php echo $blocks["section1 titre1"]["innerHTML"]; ?></p>
          <div class="b-content scrollbar-1"><?php echo $blocks["section1 descriptif1"]["innerHTML"]; ?></div>
        </div>
      </div>
    </div>
    <div class="animateme" data-when="enter" data-from="1" data-to="0.5" data-translatex="200" data-opacity="0">
      <div class="welcome-b house">
        <div class="info">
          <p class="b-title"><?php echo $blocks["section1 titre2"]["innerHTML"]; ?></p>
          <div class="b-content scrollbar-1"><?php echo $blocks["section1 descriptif2"]["innerHTML"]; ?></div>
        </div><!--
     --><div class="cover slider2" >
          <ul class="image-list">
    <?php foreach ($blocks["section1 slider2"]['data'] as $src):?>
            <li class="image-list-item">
              <img src="<?php echo $src?>" alt="image de slider de la maison du boeuf">
            </li>
    <?php endforeach;?>
          </ul>
        </div>

      </div>
    </div>
  </div>
  <div class="filter"></div>
</section>

