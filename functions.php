<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage mdb_1
 * @since 1.0.0
 */

/*---------------------*/

/*-----CALL ACTIONS----*/

/*---------------------*/

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'theme_enqueue_script' );
add_action('rework_post','filter_post');
add_action('get_hours','get_hours');
add_action('get_publish','get_publish');
add_action('init','start_session',1);
add_action('login_head', 'childtheme_custom_login');

/*---------------------*/

/*------FUNCTIONS------*/

/*---------------------*/

/**
 * [Function to init session]
 * @return [none]
 */
function start_session() {
  if(!session_id()) {
    session_start(['read_and_close' => true]);
    // session_destroy();
  }
}

/**
 * [Function to get likes]
 * @param  [object wp post]
 * @return [none]
 */
function get_publish($post){
  global $wpdb;
  $_posts = get_posts();
  foreach ($_posts as $k=> $p) {
    $query = $wpdb->prepare( "SELECT id, ulike, udislike FROM m_post_like WHERE post_id =%d", $p->ID );
    $likes = $wpdb->get_row($query);
    if(!empty($likes)){
      $likes->post_id = $p->ID;
    }
    $_posts[$k]->likes = $likes;
  }
  $post->publish = $_posts;
}
/**
 * [Function to enqueue styles]
 * @return [none]
 */
function theme_enqueue_styles() {
  
  wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
  wp_enqueue_style('Font_Awesome');
 wp_enqueue_style( 'reset-style', get_template_directory_uri() . '/css/reset.css' );
 wp_enqueue_style( '404-style', get_template_directory_uri() . '/css/404.css' );
 wp_enqueue_style( 'unite-style', get_template_directory_uri() . "/js/lib/unite/dist/css/unite-gallery.css" );
 wp_enqueue_style( 'parent-style', get_template_directory_uri() . "/css/style.css" );
 wp_enqueue_style( 'responsive-style', get_template_directory_uri() . "/css/responsive.css" );
}
/**
 * [Function to change admin theme ]
 * @return [none]
 */
function childtheme_custom_login() {
 echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri(). '/css/login.css" />';
}
/**
 * [Function to enqueue script]
 * @return [none]
 */
function theme_enqueue_script() {
 wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/lib/jquery-3.4.1.min.js' );
 wp_enqueue_script( 'unitejstheme', get_template_directory_uri() . "/js/lib/unite/dist/themes/tiles/ug-theme-tiles.js" );
 wp_enqueue_script( 'unitejs', get_template_directory_uri() . "/js/lib/unite/dist/js/unitegallery.min.js" );
 wp_enqueue_script( 'scrollme', get_template_directory_uri() . "/js/lib/scrollme/jquery.scrollme.min.js" );
 wp_enqueue_script('mainjs',get_template_directory_uri() . '/js/main.js');
 wp_enqueue_script('exec',get_template_directory_uri() . '/js/exec.js');
 wp_localize_script( 'mainjs', 'postHandling', array(
    'postUrl' => plugins_url( 'block/block_posts_query.php' , 'block')
  ));
}

/**
 * [Function to rework block for custom field]
 * @param  [object wp block]
 * @return [array new block]
 */
function formatBlockType($blocks){

	foreach ($blocks as $k=> $b) {
  	if($b['blockName'] === "core/image"){
  		$blocks[$k]['innerHTML'] = strip_tags($b['innerHTML'], '<img>');
  	}
  	else if($b['blockName'] === "core/heading"){
  		$blocks[$k]['innerHTML'] = strip_tags($b['innerHTML']);
  	}
  	else if($b['blockName'] === "core/cover"){
  		preg_match("/style=\"([^\"]*)\"/", $b['innerHTML'], $m);
  		$blocks[$k]['innerHTML'] = $m[0];
  	}
    else if($b['blockName'] === "core/paragraph"){

      $blocks[$k]['data'] = strip_tags($b['innerHTML']);
    }
    else if($b['blockName'] === "core/button"){
      $blocks[$k]['data'] = strip_tags($b['innerHTML']);
    }
  	else if($b['blockName'] == null || $b['blockName'] == "core/separator"){
			unset($blocks[$k]);
  	}
    else if($b['blockName'] === "core/list"){
      preg_match_all("/<li>(.*?)<\/li>/", $b['innerHTML'], $li);
      $blocks[$k]['data'] = $li[1];
    }
  	else if($b['blockName'] === "core/gallery"){
  		preg_match_all("/src=\"(.*?)\"/", $b['innerHTML'], $l);
  		$final =[] ;
  		foreach ($l[1] as $d) {
  			array_push($final, $d);
  		}
  		$blocks[$k]['data'] = $final;
  	}
  }
  return $blocks;
}

/**
 * [Function to add to wp POST blocks content ]
 * @param  [object wp post]
 * @return [object wb post]
 */
function filter_post($post) {

	if ( has_blocks( $post->post_content ) ) {
 	  $blocks_map = parse_blocks( $post->post_content);
 	  $blocks=[];
 	  $finalBlocks = [];
 	  foreach ($blocks_map as $k=> $b) {
 	  	if($b['attrs']['ref'] !== null){
 	  		$ref = $b['attrs']['ref'];
 	  		array_push($blocks,get_post($ref));
 	  	}
 	  }
 	  foreach($blocks as $k=> $b){
 	  	$dataB = parse_blocks($b->post_content);
      $dataL = $dataB[0];
      $dataL['innerHTML']="";
      foreach($dataB as $db){
        if($db['blockName'] !==null){
          $dataL['innerHTML'].=$db['innerHTML'];
        }
      }
      $finalBlocks[$b->post_title] = $dataL;
 	  }
 	  $finalBlocks = formatBlockType($finalBlocks);
 	  $post->blocks = $finalBlocks;

 	}
	return $post;
}

/**
 * [Function to get status open or close status from the plugin]
 * @param  [$post]
 * @return [string status]
 */
function get_hours($post){
  global $wpdb;
  $hours = $wpdb->get_results( "SELECT id, openH, closeH, closeM, openM, day  FROM m_hours_mdb" );
  $days = [
    "Lundi",
    "Mardi",
    "Mercredi",
    "Jeudi",
    "Vendredi",
    "Samedi",
    "Dimanche",
  ];
  $finalHours;
  foreach ($days as $d) {
    $finalHours[$d] = [];
  }
  foreach ($hours as $h) {
    $finalHours[$h->day][] = $h;
  }
  $post->hoursMdb = $finalHours;
  date_default_timezone_set ("Europe/Paris");
  $currentTime=date("H:i");
  $currentDay=date("N")-1;
  /*checking date*/
  $selectDay =$days[$currentDay];
  $status = "Fermé";
  foreach ($finalHours[$selectDay] as $d) {
    $dateOpen = str_pad($d->openH, 2, "0",STR_PAD_LEFT).":".str_pad($d->openM, 2, "0",STR_PAD_LEFT);
    $dateClose = str_pad($d->closeH, 2, "0",STR_PAD_LEFT).":".str_pad($d->closeM, 2, "0",STR_PAD_LEFT);
    if($currentTime >= $dateOpen && $currentTime < $dateClose){
      $status = "Ouvert";
      break ;
    }
  }
  $post->openStatus = $status;
  return $status;
}