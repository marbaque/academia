<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package academia
 */

get_header(); ?>



<?php
	if( function_exists('bcn_display') && !is_singular('lp_course') ) {
		echo '<div class="migajas">';
		bcn_display();
		echo '</div>';
	}
?>

	

			<?php if ( have_posts() ) : ?>
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					
					<?php
						the_archive_title( '<h2 class="recursos-title">', '</h2>' );
					?>
				
				<?php 
					$countPosts = $wp_the_query->post_count; 
					$count = $GLOBALS['wp_query']->found_posts;
				?>
				<p class="small">Mostrando <?php echo $countPosts; ?> de <?php echo $count;?> recursos</p>
			
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					if ( get_post_type() =='recurso' ) {
						get_template_part( 'template-parts/content', 'recurso' );
					} else {
						get_template_part( 'template-parts/content', get_post_format() );
					}

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );
				return;
			
			endif;

			the_posts_pagination( array(
				'prev_text' => academia_get_svg( array( 'icon' => 'arrow-long-left', 'fallback' => true ) ) . __( 'Recientes', 'academia' ),
				'next_text' => __( 'Anteriores', 'academia' ) . academia_get_svg( array( 'icon' => 'arrow-long-right' , 'fallback' => true ) ),
				'before_page_number' => '<span class="screen-reader-text">' . __( 'Página ', 'academia' ) . '</span>',
			));

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	

<?php
get_sidebar( 'recursos' );
get_footer();
