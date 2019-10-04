<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage mdb_1
 * @since 1.0.0
 */

get_header();
?>

  <section id="primary" class="content-area">
    <main id="main" class="site-main">

      <?php
      /* Start the Loop */
      while ( have_posts() ) :
        the_post();

        if($post->post_name =="home"){
          get_template_part( 'template-parts/main/main','welcome');
          get_template_part( 'template-parts/main/main','cartes');
          get_template_part( 'template-parts/main/main','news');
          get_template_part( 'template-parts/main/main','find');
          get_template_part( 'template-parts/main/main','hour');
          get_template_part( 'template-parts/main/main','gal');
        }
        else if($post->post_name == "politique-de-confidentialite" ){
          get_template_part( 'template-parts/policy/policy','policy');
        }
      endwhile; // End of the loop.
      ?>

    </main><!-- #main -->
  </section><!-- #primary -->

<?php
get_footer();
