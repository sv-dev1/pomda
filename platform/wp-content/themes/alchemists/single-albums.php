<?php
/**
 * The template for displaying single Album Custom Post Type
 *
 * @author 		Dan Fisher
 * @package 	Alchemists
 * @version   1.0
 */

get_header();

$alchemists_data = get_option('alchemists_data');
$page_heading_overlay  = isset( $alchemists_data['alchemists__opt-page-title-overlay-on'] ) ? esc_html( $alchemists_data['alchemists__opt-page-title-overlay-on'] ) : '';
$breadcrumbs           = isset( $alchemists_data['alchemists__opt-page-title-breadcrumbs'] ) ? esc_html( $alchemists_data['alchemists__opt-page-title-breadcrumbs'] ) : '';

$container_class = '';
$sp_preset_name = 'default';

if ( alchemists_sp_preset( 'football' ) ) {
	$container_class = 'container';
	$sp_preset_name = 'football';
} elseif ( alchemists_sp_preset( 'soccer') ) {
	$sp_preset_name = 'soccer';
}
?>

<!-- Page Heading
================================================== -->
<div class="page-heading <?php echo esc_attr( $page_heading_overlay ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<?php the_title( '<h1 class="page-heading__title">', '</h1>' ); ?>
				<?php
				// Breadcrumb
				if ( function_exists( 'breadcrumb_trail' ) && $breadcrumbs != 0 ) {
					breadcrumb_trail( array(
						'show_browse' => false,
					));
				}?>
			</div>
		</div>
	</div>
</div>

<div class="site-content" id="content">

	<div class="container">
		<div class="content-title">
			<a href="<?php echo wp_get_referer(); ?>" class="btn btn-xs btn-default btn-outline"><?php esc_html_e( 'Go Back to the Albums', 'alchemists' ); ?></a>
		</div>
	</div>

	<div class="row">

		<div id="primary" class="content-area">
			<main id="main" class="site-main <?php echo esc_attr( $container_class ); ?>">

				<?php
				$images = get_field('album_photos');

				if ( $images ): ?>
				<!-- Gallery Album -->
				<div class="album album--condensed container-fluid">
					<div class="row">

						<?php
						foreach ( $images as $image ) :
							include( locate_template( 'sportspress/single-team/albums/album-' . $sp_preset_name . '.php' ) );
						endforeach;
						?>

					</div>
				</div>
				<!-- Gallery Album / End -->
				<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

	</div>
</div>


<?php get_footer();
