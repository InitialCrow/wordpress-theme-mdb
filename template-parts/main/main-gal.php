<?php

/*
  Template Name: gal
*/

  $blocks = $post->blocks;

  //var_dump($blocks);
?>
<section class="main-section gal scrollme" id="gal">
  <div class="wrap-title">
    <h2 class="gal-title main-section-title"><?php echo $blocks["section6 titre principal"]['innerHTML'] ?></h2>
  </div>
  <div class="wrap-gal animateme" data-when="enter" data-from="1" data-to="0.5" data-opacity="0" >
    <?php if(empty($blocks["section6 galerie"]['data'])): ?>
            <p class="no-image">Pas encore d'images disponibles.</p>
    <?php endif; ?>
    <div id="gallery" style="display: none">
  <?php foreach ($blocks["section6 galerie"]['data'] as $img):?>
          <img src="<?php echo $img ?>" data-image="<?php echo $img ?>" alt="image de galerie de la maison du boeuf">
  <?php endforeach; ?>

    </div>
  </div>
</section>

