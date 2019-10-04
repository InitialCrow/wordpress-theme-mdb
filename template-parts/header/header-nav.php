<?php

/*
  Template Name: nav
*/

  $blocks = $post->blocks;
?>
<h2 class="hidden">main nav</h2>
<ul class="nav-list">
  <?php
  $items = wp_get_nav_menu_items('main_nav');
  foreach ($items as $i):?>
    <?php
    if(in_array("main-logo", $i->classes)):?>
      <li class="<?php foreach($i->classes as $c) echo $c ." " ?> "><a href="<?php echo $i->url; ?>"><?php echo $blocks['navigation logo']['innerHTML']; ?></a></li><?php
    else : ?>
      <li class="<?php foreach($i->classes as $c) echo $c ." " ?>"><a class="link-1 animA" href="<?php echo $i->url; ?>"><?php echo $i->title ?></a></li><?php
    endif;
  endforeach;?>
</ul>

<div class="nav-burger hidden">

  <div class="header-nav"></div>
  <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
  <label for="openSidebarMenu" class="sidebarIconToggle">
    <div class="spinner diagonal part-1"></div>
    <div class="spinner horizontal"></div>
    <div class="spinner diagonal part-2"></div>
  </label>
  <div id="sidebarMenu">
    <ul class="sidebarMenuInner">
    <?php foreach ($items as $i):?>
      <?php if(in_array("main-logo", $i->classes)):?>

      <?php else : ?>
        <li class="<?php foreach($i->classes as $c) echo $c ." " ?>"><a class="link-1 animA" href="<?php echo $i->url; ?>"><?php echo $i->title ?></a></li><?php
      endif;
    endforeach;?>
      <li class="main-nav-item "><a class="link-1 animA" href="#gal">Galerie</a></li>
    </ul>
  </div>
</div>