<?php
/**
 * Template part for displaying posts on a Single Post Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author    Dan Fisher
 * @package   Alchemists
 * @since     3.0.0
 * @version   3.0.0
 */

$alchemists_data   = get_option('alchemists_data');
$post_author       = isset( $alchemists_data['alchemists__opt-single-post-author'] ) ? esc_html( $alchemists_data['alchemists__opt-single-post-author'] ) : 1;
$categories_toggle = isset( $alchemists_data['alchemists__posts-categories'] ) ? $alchemists_data['alchemists__posts-categories'] : 1;

// get post category class
$post_class = alchemists_post_category_class();

$post_classes = array(
	'card',
	'card--lg',
	'post',
	'post--single',
	$post_class
);

?>

<!-- Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>

	<?php if( has_post_thumbnail() ) { ?>
	<figure class="post__thumbnail">
		<?php the_post_thumbnail('alchemists_thumbnail-lg'); ?>
	</figure>
	<?php } ?>

	<div class="clearfix">
		<!-- Post Meta - Side -->
		<div class="post__meta-block post__meta-block--side-wide">

			<?php if ( $categories_toggle ) : ?>
				<?php alchemists_post_category_labels( 'post__category' ); ?>
			<?php endif; ?>

			<header class="post__header">
				<?php the_title( '<h2 class="post__title">', '</h2>' ); ?>

				<?php alchemists_entry_meta_single('on', 'post__meta--in-side-wide'); ?>
			</header>

			<!-- Post Author -->
			<div class="post-author">
				<figure class="post-author__avatar">
					<?php echo get_avatar( get_the_author_meta('email'), '24' ); ?>
				</figure>
				<div class="post-author__info">
					<h4 class="post-author__name"><?php the_author(); ?></h4>
					<span class="post-author__slogan"><?php echo get_the_author_meta('nickname'); ?></span>
				</div>
			</div>
			<!-- Post Author / End -->

			<?php

			// Post Meta
			alchemists_entry_meta_single( $date = 'off' );

			// Post Social Sharing
			if ( function_exists( 'alc_post_social_share_buttons_labels' )) {
				alc_post_social_share_buttons_labels();
			}

			?>


		</div>
		<!-- Post Meta - Side / End -->

		<div class="card__content">

			<div class="post__content">

				<?php the_content(); ?>

			</div>

			<footer class="post__footer">

				<?php $terms = get_the_terms( $post->ID, 'post_tag' );
					if ($terms && ! is_wp_error($terms)): ?>
					<div class="post__tags">
						<?php foreach($terms as $term): ?>
							<a href="<?php echo esc_url( get_term_link( $term->slug, 'post_tag') ); ?>" rel="tag" class="tag-link-<?php echo esc_attr( $term->slug ); ?> btn btn-primary btn-outline btn-xs"><?php echo esc_html( $term->name ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

			</footer>
		</div>
	</div>

</article>

<?php
// Page Links
alchemists_page_links();
