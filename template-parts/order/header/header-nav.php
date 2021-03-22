<?php

/*
  Template Name: nav
*/

  $blocks = $post->blocks;
  

?>
<h2 class="hidden">main nav</h2>
<ul class="nav-list">
  	
    <li class="main-nav-item"><a class="link-1 animA" href="/">Retour au site</a></li>
    <li class="main-nav-item main-logo"><a class="link-1 animA" href="/"><?php echo $blocks['navigation logo']['innerHTML']; ?></a></li>

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

      <li class="main-nav-item"><a class="link-1 animA" href="/">Retour au site</a></li>
    </ul>
  </div>
</div>