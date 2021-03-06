<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package academia
 */

get_header(); ?>



<header class="page-header">
	<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );

		if ( get_post_type() =='recurso' ) {
			echo do_shortcode( '[searchandfilter fields="search,temas,cobertura,tipo_recurso,tipo_medio"
				post_types="recurso"
				search_placeholder="Buscar recursos..."
				types=",select,select,select"
				submit_label="Filtrar"
				class="recursos-searchandfilter"
				headings=",Ejes temáticos,Cobertura,Tipo de contenido,Formato de archivo"]' );

		}
	?>
</header><!-- .page-header -->

<?php
	if( function_exists('bcn_display') && !is_singular('lp_course') ) {
		echo '<div class="migajas">';
		bcn_display();
		echo '</div>';
	}
	?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				if ( get_post_type() =='recurso' ) {
	 				get_template_part( 'template-parts/content', 'recurso' );
	 			} else {
					get_template_part( 'template-parts/content', get_post_format() );
				}

			endwhile;

			the_posts_pagination( array(
				'prev_text' => academia_get_svg( array( 'icon' => 'arrow-long-left', 'fallback' => true ) ) . __( 'Recientes', 'academia' ),
				'next_text' => __( 'Anteriores', 'academia' ) . academia_get_svg( array( 'icon' => 'arrow-long-right' , 'fallback' => true ) ),
				'before_page_number' => '<span class="screen-reader-text">' . __( 'Página ', 'academia' ) . '</span>',
			));

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
