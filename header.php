<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage mdb_1
 * @since 1.0.0
 */

do_action('rework_post', $post);
do_action('get_hours',$post);
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php  echo get_bloginfo('name');?></title>
	<meta name="description" content="<?php echo get_bloginfo('description') ?>"/>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="wrapper">
	<div id="page" class="site">
		<header id="masthead">

			
			<?php if($post->post_title!="Order"): ?>
				<nav class="main-nav" id="main-nav">
					<?php get_template_part( 'template-parts/header/header', 'nav' );?>
				</nav>
			<?php endif ?>
			<?php if($post->post_title=="Order"): ?>
				<nav class="main-nav nav-order border-title" id="main-nav">
					<?php get_template_part( 'template-parts/order/header/header', 'nav' );?>
				</nav>
			<?php endif ?>
		
			<?php if($post->post_title!="Order"): ?>
				<section class="head-sec border-title" <?php echo $post->blocks["header image fond"]['innerHTML']; ?>>
				<?php get_template_part( 'template-parts/header/header', 'branding' )?>
				</section>
			<?php endif?>
		</header><!-- #masthead -->
		<div id="content" class="site-content">