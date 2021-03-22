<?php
/*
  Template Name: policy
*/
  $blocks = $post->blocks;
?>
<section class="main-section policy border-title">
  <div class="wrap-title">
    <h2 class="policy-title main-section-title"><?php echo $blocks["policy title"]["innerHTML"]; ?></h2>
  </div>
  <div class="content">
    <?php echo $blocks["policy content"]["innerHTML"] ?>
  </div>
</section>