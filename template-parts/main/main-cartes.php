<?php

/*
  Template Name: cartes
*/

  $blocks = $post->blocks;
?>
<section id="cartes" class="main-section carte border-title scrollme">
  <div class="wrap-title">
    <h2 class="carte-title main-section-title animateme" data-when="enter" data-from="1" data-to="0.8" data-opacity="0" ><?php echo $blocks["section2 titre principal"]["innerHTML"]; ?></h2>
  </div>
  <div class="animateme" data-when="enter" data-from="1" data-to="0.5" data-translatey="-200" data-opacity="0">
    <div class="carte-b eat">
      <div class="carteb-bg">
        <div class="info">
          <p class="b-title"><?php echo $blocks["section2 titre1"]["innerHTML"]; ?></p>
          <div class="b-content scrollbar-1"><?php echo $blocks["section2 descriptif1"]["innerHTML"]; ?></div>
          <div class="wrap-link">
            <a class="carte-link"  href="<?php echo $blocks['section2 fichier1']['attrs']['href'] ?>">Voir la carte</a>
          </div>
        </div>
      </div><!--
  --><div class="cover slider3 animateme" data-when="enter" data-from="1" data-to="0.5" data-translatex="200" data-opacity="0">
        <ul class="image-list">
  <?php foreach ($blocks["section2 slider1"]['data'] as $src):?>
          <li class="image-list-item">
            <img src="<?php echo $src?>" alt="image des plats e la maison du boeuf">
          </li>
  <?php endforeach;?>
        </ul>
      </div>
    </div>
  </div>
  <div class="animateme" data-when="enter" data-from="1" data-to="0.5" data-translatey="200" data-opacity="0">
    <div class="carte-b drink">
      <div class="carteb-bg">
        <div class="info">
          <p class="b-title"><?php echo $blocks["section2 titre2"]["innerHTML"]; ?></p>
          <div class="b-content scrollbar-1"><?php echo $blocks["section2 descriptif2"]["innerHTML"]; ?></div>
          <div class="wrap-link">
            <a class="carte-link"  href="<?php echo $blocks['section2 fichier2']['attrs']['href'] ?>">Voir la carte</a>
          </div>
        </div>
      </div><!--
  --><div class="cover slider4 animateme" data-when="enter" data-from="1" data-to="0.5" data-translatex="200" data-opacity="0">
        <ul class="image-list">
  <?php foreach ($blocks["section2 slider2"]['data'] as $src):?>
          <li class="image-list-item">
            <img src="<?php echo $src?>" alt="image des boissons de la maison du boeuf">
          </li>
  <?php endforeach;?>
        </ul>
      </div>
    </div>
  </div>
</section>


