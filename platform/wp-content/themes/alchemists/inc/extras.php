<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package alchemists
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function alchemists_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'alchemists_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function alchemists_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'alchemists_pingback_header' );


/**
 * WooCommerce Custom Functions
 */
function alchemists_woo_exists() {
	if ( class_exists( 'WooCommerce' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * WPML Custom Functions
 */
function alchemists_wpml_exists() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php');
	if ( is_plugin_active('sitepress-multilingual-cms/sitepress.php') ) {
		return true;
	}
	else {
		return false;
	}
}


/**
 * Check if it's a menu page
 */
if(!function_exists('alchemists_theme_is_menus')) {
	function alchemists_theme_is_menus() {
		if ('nav-menus.php' == basename($_SERVER['PHP_SELF'])) {
			return true;
		}

		// to be add some check code for validate only in theme options pages
		return false;
	}
}


/**
 * Register Fonts
 *
 */
if(!function_exists('alchemists_fonts_url')) {

	function alchemists_fonts_url() {
		$fonts_url = '';

		if ( alchemists_sp_preset('football') ) {

			/* Translators: If there are characters in your language that are not
			* supported by Exo 2, translate this to 'off'. Do not translate
			* into your own language.
			*/
			$font_base       = _x( 'on', 'Roboto font: on or off', 'alchemists' );
			$font_base_arg   = 'Roboto:400,400i';

			$font_accent     = _x( 'on', 'Exo 2: on or off', 'alchemists' );
			$font_accent_arg = 'Exo+2:400,700,700i,800';

		} else {

			/* Translators: If there are characters in your language that are not
			* supported by Roboto, translate this to 'off'. Do not translate
			* into your own language.
			*/
			$font_base       = _x( 'on', 'Source Sans Pro font: on or off', 'alchemists' );
			$font_base_arg   = 'Source+Sans+Pro:400,700';

			$font_accent     = _x( 'on', 'Montserrat: on or off', 'alchemists' );
			$font_accent_arg = 'Montserrat:400,700';
		}

		if ( 'off' !== $font_base || 'off' !== $font_accent ) {
			$font_families = array();

			if ( 'off' !== $font_base ) {
				$font_families[] = $font_base_arg;
			}

			if ( 'off' !== $font_accent ) {
				$font_families[] = $font_accent_arg;
			}

			$query_args = array(
				'family' => implode( '%7C', $font_families ),
				'subset' => 'latin,latin-ext',
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
}

if(!function_exists('alchemists_scripts_styles')) {
	function alchemists_scripts_styles() {
		wp_enqueue_style( 'alchemists-fonts', alchemists_fonts_url(), array(), null );
	}
	add_action( 'wp_enqueue_scripts', 'alchemists_scripts_styles' );
}


/**
 * Filter the Categories archive widget to add a span around post count
 */
if(!function_exists('alchemists_categories_count_span')) {
	function alchemists_categories_count_span($links) {
		$links = str_replace('</a> (', '</a> <span class="count">(', $links);
		$links = str_replace(')', ')</span>', $links);
		return $links;
	}
	add_filter('wp_list_categories', 'alchemists_categories_count_span');
}


/**
 * Filter the Archives widget to add a span around post count
 */
if(!function_exists('alchemists_archives_count_span')) {
	function alchemists_archives_count_span($links) {
		$links = str_replace('</a>&nbsp;(', '</a> <span class="count">(', $links);
		$links = str_replace(')', ')</span>', $links);
		return $links;
	}
	add_filter('get_archives_link', 'alchemists_archives_count_span');
}


/**
 * Removes font-sizes from the tagcloud
 */
if( !function_exists( 'alchemists_remove_inline_style_tagcloud' ) ) {
	function alchemists_remove_inline_style_tagcloud( $tagcloud ) {
		return preg_replace( '/ style=(["\'])[^\1]*?\1/i', '', $tagcloud, -1 );
	}
	add_filter( 'wp_tag_cloud', 'alchemists_remove_inline_style_tagcloud' );
}


/**
 * Adds custom classes to tags
 */
if( !function_exists( 'alchemists_tag_cloud_add_class' ) ) {
	function alchemists_tag_cloud_add_class( $tags_data ) {
		foreach ( $tags_data as $key => $tag ) {
			// get tag count
			$count = $tag [ 'real_count' ];
			$tags_data [ $key ] [ 'class' ] .= ' btn btn-primary btn-xs btn-outline btn-sm ';
		}
		// return adjusted data
		return $tags_data;
	}
	add_filter( 'wp_generate_tag_cloud_data', 'alchemists_tag_cloud_add_class', 10, 1 );
}



/**
 * The excerpt based on words
 */
if(!function_exists('alchemists_string_limit_words')) {
	function alchemists_string_limit_words( $string, $word_limit ) {
		$words = explode(' ', $string, ( $word_limit + 1 ));
		if(count($words) > $word_limit)
		array_pop( $words );
		return implode(' ', $words) . '... ';
	}
}



/**
 * Filter the except length to 24 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function alchemists_custom_excerpt_length( $length ) {
	return 24;
}
add_filter( 'excerpt_length', 'alchemists_custom_excerpt_length', 999 );



/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function alchemists_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'alchemists_excerpt_more' );



/**
 * Move Comment field to bottom (Comments)
 */
if (!function_exists('alchemists_move_comment_field_to_bottom')) {
	function alchemists_move_comment_field_to_bottom( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}

	add_filter( 'comment_form_fields', 'alchemists_move_comment_field_to_bottom' );
}


/**
 * Thumbnail URL helper
 */
if ( ! function_exists( 'alchemists_get_thumbnail_url' ) ) {
	function alchemists_get_thumbnail_url( $post_id = 0, $image_id = 0, $image_size = "alchemists_thumbnail" ) {
		$return = '';
		if ( ! $image_id ) {
			$image = get_post_thumbnail_id( $post_id );
		} else {
			$image = $image_id;
		}
		if ( ! empty( $image ) ) {
			$image = wp_get_attachment_image_src( $image, $image_size );
			if ( ! empty( $image[0] ) ) {
				$return = $image[0];
			}
		}

		return $return;
	}
}


/**
 * Add quotes to values
 */
if ( ! function_exists( 'alchemists_add_quotes' ) ) {
	function alchemists_add_quotes($str) {
		return sprintf('"%s"', $str);
	}
}


/**
 * Password protected post
 */
if(!function_exists('alchemists_password_form')) {
	function alchemists_password_form() {
		global $post;
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$output = '<form class="form-inline form-post-pass-protected" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		<p>' . esc_html__( "To view this protected post, enter the password below:", "alchemists" ) . '</p>
		<div class="form-group"><label for="' . esc_attr( $label ) . '">' . esc_html__( "Password:", "alchemists" ) . ' </label> &nbsp; <input class="form-control input-sm" name="post_password" id="' . esc_attr( $label ) . '" type="password" size="20" maxlength="20" /> &nbsp; </div><input type="submit" class="btn btn-primary" name="Submit" value="' . esc_attr__( "Submit", "alchemists" ) . '" />
		</form>
		';
		return $output;
	}
}
add_filter( 'the_password_form', 'alchemists_password_form' );

// Add the Password Form to the Excerpt (for password protected posts)
if(!function_exists('alchemists_excerpt_password_form')) {
	function alchemists_excerpt_password_form( $excerpt ) {
		if ( post_password_required() )
			$excerpt = get_the_password_form();
		return $excerpt;
	}
	add_filter( 'the_excerpt', 'alchemists_excerpt_password_form' );
}



/**
 * Demo Import
 */

if(!function_exists('alchemists_import_files')) {
	// Import content, widgets and theme options
	function alchemists_import_files() {
		return array(
			array(
				'import_file_name'           => 'Basketball',
				'categories'                 => array( 'Basketball' ),
				'local_import_file'          => trailingslashit( get_template_directory() ) . 'inc/demo/basketball/content.xml',
				'local_import_widget_file'   => trailingslashit( get_template_directory() ) . 'inc/demo/basketball/widgets.json',
				'import_preview_image_url'   => get_template_directory_uri() . '/inc/demo/basketball/screenshot.png',
				'preview_url'                => 'http://alchemists-wp.dan-fisher.com/basketball/',
			),
			array(
				'import_file_name'           => 'Soccer',
				'categories'                 => array( 'Soccer' ),
				'local_import_file'          => trailingslashit( get_template_directory() ) . 'inc/demo/soccer/content.xml',
				'local_import_widget_file'   => trailingslashit( get_template_directory() ) . 'inc/demo/soccer/widgets.json',
				'local_import_redux'         => array(
					array(
						'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demo/soccer/redux_options.json',
						'option_name' => 'alchemists_data',
					),
				),
				'import_preview_image_url'   => get_template_directory_uri() . '/inc/demo/soccer/screenshot.png',
				'preview_url'                => 'http://alchemists-wp.dan-fisher.com/soccer/',
			),
			array(
				'import_file_name'           => 'Football',
				'categories'                 => array( 'Football' ),
				'local_import_file'          => trailingslashit( get_template_directory() ) . 'inc/demo/football/content.xml',
				'local_import_widget_file'   => trailingslashit( get_template_directory() ) . 'inc/demo/football/widgets.json',
				'local_import_redux'         => array(
					array(
						'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demo/football/redux_options.json',
						'option_name' => 'alchemists_data',
					),
				),
				'import_preview_image_url'   => get_template_directory_uri() . '/inc/demo/football/screenshot.png',
				'preview_url'                => 'http://alchemists-wp.dan-fisher.com/football/',
			),
		);
	}
	add_filter( 'pt-ocdi/import_files', 'alchemists_import_files' );
}


// Assign Front Page and Posts Page and menu locations, options etc.
if(!function_exists('alchemists_after_import_setup')) {
	function alchemists_after_import_setup( $selected_import ) {

		$import_sport_demo = $selected_import['import_file_name'];

		// Assign menus to their locations.
		$primary_menu = get_term_by( 'name',  esc_html__( 'Primary Menu', 'alchemists' ), 'nav_menu' );
		$top_menu     = get_term_by( 'name',  esc_html__( 'Top Menu', 'alchemists' ), 'nav_menu' );
		$footer_menu  = get_term_by( 'name',  esc_html__( 'Footer Menu', 'alchemists' ), 'nav_menu' );

		if ( isset( $primary_menu->term_id ) ) {
			set_theme_mod( 'nav_menu_locations', array(
				'primary'     => $primary_menu->term_id,
				'top_menu'    => $top_menu->term_id,
				'footer_menu' => $footer_menu->term_id,
			));
		}

		// Assign home and posts page (blog page).
		if ( 'Soccer' === $import_sport_demo ) {
			$front_page_id = get_page_by_title( 'Home' );
		} else {
			$front_page_id = get_page_by_title( 'Home - Version 1' );
		}
		$blog_page_id  = get_page_by_title( 'News' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );

		// SporstPress: General
		if ( 'Soccer' === $import_sport_demo ) {

			// Soccer
			SP_Admin_Sports::apply_preset( 'soccer' );
			update_option('sportspress_sport', 'soccer');

		} elseif ( 'Basketball' === $import_sport_demo ) {

			// Basketball
			SP_Admin_Sports::apply_preset( 'basketball' );
			update_option('sportspress_sport', 'basketball');

		} elseif ( 'Football' === $import_sport_demo ) {

			// American Football
			SP_Admin_Sports::apply_preset( 'football' );
			update_option('sportspress_sport', 'football');

		}


		// SportsPress: Games

		// Details
		update_option( 'sportspress_event_show_day', 'yes');
		update_option( 'sportspress_event_show_full_time', 'yes');

		// Teams
		update_option( 'sportspress_event_logos_format', 'block');
		update_option( 'sportspress_event_logos_show_time', 'yes');
		update_option( 'sportspress_event_logos_show_results', 'yes');

		// Event List
		update_option( 'sportspress_event_list_show_logos', 'yes');

		// Event Blocks
		update_option( 'sportspress_event_blocks_show_title', 'yes');
		update_option( 'sportspress_event_blocks_show_league', 'yes');
		update_option( 'sportspress_event_blocks_show_season', 'yes');
		update_option( 'sportspress_event_blocks_show_venue', 'yes');

		// Countdown
		update_option( 'sportspress_countdown_show_logos', 'yes');


		// SportsPress: Team
		update_option( 'sportspress_table_increment', 'yes');


		// SportsPress: Players

		// Details
		update_option( 'sportspress_player_show_number', 'yes');
		update_option( 'sportspress_player_show_name', 'yes');
		update_option( 'sportspress_player_show_leagues', 'yes');
		update_option( 'sportspress_player_show_seasons', 'yes');

		// Birthday
		update_option( 'sportspress_player_show_birthday', 'yes');
		update_option( 'sportspress_player_show_age', 'yes');

		// Statistics
		update_option( 'sportspress_player_show_total', 'yes');
		update_option( 'sportspress_player_show_career_total', 'yes');

		// SportsPress: Staff
		update_option( 'sportspress_staff_show_birthday', 'yes');
		update_option( 'sportspress_staff_show_age', 'yes');
	}
	add_action( 'pt-ocdi/after_import', 'alchemists_after_import_setup' );
}

// Disable branding
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );


/**
 * Site URL relative
 */

if (!is_admin()) {
	add_action('init', 'alchemists_site_url_shortcode_ob_callback_trigger');
}

if(!function_exists('alchemists_site_url_shortcode_ob_callback')) {
	function alchemists_site_url_shortcode_ob_callback($html) {
		// Don't bother looking for shortcode if not a wordpress page (e.g. binary)
		if (!preg_match('/(<\/html>|<\/rss>|<\/feed>|<\/urlset|<\?xml)/i', $html )) {
			return $html;
		}

		$html = apply_filters('site_url_shortcode_pre', $html);

		// Site url
		$siteUrl = site_url();
		$siteUrlNoProtocol = preg_replace('%^((.*?)//)%', '', $siteUrl);

		/* First replace instances of [site-url] preceded by a protocl
				with protocol-less site url, preserving the specified protocol */
		$html = str_replace('//[site-url]', sprintf('//%s', $siteUrlNoProtocol), $html);

		// Then replace standalone [site-url] with the full site url with protocol
		$html = str_replace('[site-url]', $siteUrl, $html);

		return apply_filters('site_url_shortcode', $html);
	}
}

if(!function_exists('alchemists_site_url_shortcode_ob_callback_trigger')) {
	function alchemists_site_url_shortcode_ob_callback_trigger() {
		ob_start('alchemists_site_url_shortcode_ob_callback');
	}
}



/**
 * Page Title Highlighting
 */
if(!function_exists('alchemists_page_title_highlight')) {
	function alchemists_page_title_highlight() {
		$alchemists_data = get_option('alchemists_data');
		$page_title_highlight  = isset( $alchemists_data['alchemists__opt-page-title-highlight'] ) ? $alchemists_data['alchemists__opt-page-title-highlight'] : 1;

		if ( $page_title_highlight == 1 ) {
	?>
	<script type="text/javascript">
		(function($){
			$(document).on('ready', function() {
				// Highlight the last word in Page Heading
				$(".page-heading__title").html(function(){
					var text= $(this).text().trim().split(" ");
					var last = text.pop();
					return text.join(" ") + (text.length > 0 ? " <span class='highlight'>" + last + "</span>" : last);
				});
			});
		})(jQuery);
	</script>
	<?php
		}
	}
	add_action( 'wp_footer', 'alchemists_page_title_highlight' );
}


/**
 * Convert hexdec color string to rgb(a) string
 */
if (!function_exists('hex2rgba')) {
	function hex2rgba($color, $opacity = false) {

		$default = 'rgb(0,0,0)';

		//Return default if no color provided
		if(empty($color)) {
			return $default;
		}

		//Sanitize $color if "#" is provided
		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		//Check if color has 6 or 3 characters and get values
		if (strlen($color) == 6) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}

		//Convert hexadec to rgb
		$rgb =  array_map('hexdec', $hex);

		//Check if opacity is set(rgba or rgb)
		if($opacity){
			if(abs($opacity) > 1)
				$opacity = 1.0;
			$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
		} else {
			$output = 'rgb('.implode(",",$rgb).')';
		}

		//Return rgb(a) color string
		return $output;
	}
}


/**
 * Convert RGBA color to array
 */
if ( ! function_exists( 'alchemists_parseRGBa' ) ) {
	function alchemists_parseRGBa($rgba) {
		$rgba = trim(str_replace(' ', '', $rgba));
		if ( stripos( $rgba, 'rgba' ) !== false ) {
			$res = sscanf($rgba, "rgba(%d, %d, %d, %f)");
		}
		else {
			$res = sscanf($rgba, "rgb(%d, %d, %d)");
			$res[] = 1;
		}
		return array_combine(array('r', 'g', 'b', 'a'), $res);
	}
}


/**
 * Allow SVG icon upload
 */
if (!function_exists( 'alchemists_mime_types_upload' )) {
	function alchemists_mime_types_upload( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
}
add_filter('upload_mimes', 'alchemists_mime_types_upload' );



/**
 * Generates SVG duotone filters
 */
if ( ! function_exists( 'alchemists_set_duotone_filters') ) {
	function alchemists_set_duotone_filters( $color_name, $color1, $color2 ) {
		$output = '';

		// convert colors to rgb
		$color1_rgb = hex2rgba( $color1 );
		$color2_rgb = hex2rgba( $color2 );

		// parse rgb colors to array
		$color1_output = alchemists_parseRGBa( $color1_rgb );
		$color2_output = alchemists_parseRGBa( $color2_rgb );

		// get the first color result
		$color1_array = array();
		foreach ( $color1_output as $key => $value ) {
			$color1_array[$key] = round( ( $value / 255 ), 10 );
		}

		// get the second color result
		$color2_array = array();
		foreach ( $color2_output as $key => $value ) {
			$color2_array[$key] = round( ( $value / 255 ), 10 );
		}

		$output .= '<filter id="duotone_' . $color_name . '">';
			$output .= '<feColorMatrix type="matrix" result="grayscale"
				values="1 0 0 0 0
								1 0 0 0 0
								1 0 0 0 0
								0 0 0 1 0" />';
			$output .= '<feComponentTransfer color-interpolation-filters="sRGB" result="duotone_' . $color_name . '">';
				$output .= '<feFuncR type="table" tableValues="' . $color1_array['r'] . ' ' . $color2_array['r'] . '"></feFuncR>';
				$output .= '<feFuncG type="table" tableValues="' . $color1_array['g'] . ' ' . $color2_array['g'] . '"></feFuncG>';
				$output .= '<feFuncB type="table" tableValues="' . $color1_array['b'] . ' ' . $color2_array['b'] . '"></feFuncB>';
				$output .= '<feFuncA type="table" tableValues="0 1"></feFuncA>';
			$output .= '</feComponentTransfer>';
		$output .= '</filter>';

		return $output;
	}
}


/**
 * Get Duotone SVG filters
 */
if ( ! function_exists( 'alchemists_duotone_filters') ) {
	function alchemists_duotone_filters() {

		$alchemists_data = get_option( 'alchemists_data' );
		$color_dark      = isset( $alchemists_data['color-dark-2'] ) ? $alchemists_data['color-dark-2'] : '#282840';
		$color_1         = isset( $alchemists_data['alchemists__blog-cat-group-1'] ) && ! empty( $alchemists_data['alchemists__blog-cat-group-1'] ) ? $alchemists_data['alchemists__blog-cat-group-1'] : '#f92552';
		$color_2         = isset( $alchemists_data['alchemists__blog-cat-group-2'] ) && ! empty( $alchemists_data['alchemists__blog-cat-group-2'] ) ? $alchemists_data['alchemists__blog-cat-group-2'] : '#9e69ee';
		$color_3         = isset( $alchemists_data['alchemists__blog-cat-group-3'] ) && ! empty( $alchemists_data['alchemists__blog-cat-group-3'] ) ? $alchemists_data['alchemists__blog-cat-group-3'] : '#0fe3ab';
		$color_4         = isset( $alchemists_data['alchemists__blog-cat-group-4'] ) && ! empty( $alchemists_data['alchemists__blog-cat-group-4'] ) ? $alchemists_data['alchemists__blog-cat-group-4'] : '#f92552';
		$color_5         = isset( $alchemists_data['alchemists__blog-cat-group-5'] ) && ! empty( $alchemists_data['alchemists__blog-cat-group-5'] ) ? $alchemists_data['alchemists__blog-cat-group-5'] : '#f92552';

		$colors = array(
			'category-1' => array( $color_dark, $color_1 ),
			'category-2' => array( $color_dark, $color_2 ),
			'category-3' => array( $color_dark, $color_3 ),
			'category-4' => array( $color_dark, $color_4 ),
			'category-5' => array( $color_dark, $color_5 ),
		);

		$output = '';

		$output .= '<svg xmlns="http://www.w3.org/2000/svg" class="svg-filters">';
			$output .= '<filter id="duotone_dark">';
				$output .= '<feColorMatrix type="matrix" result="grayscale"
					values="1 0 0 0 0
									1 0 0 0 0
									1 0 0 0 0
									0 0 0 1 0" />';
				$output .= '<feComponentTransfer color-interpolation-filters="sRGB" result="duotone_dark">';
					$output .= '<feFuncR type="table" tableValues="0.1568627451 0.2980392157"></feFuncR>';
					$output .= '<feFuncG type="table" tableValues="0.1568627451 0.2941176471"></feFuncG>';
					$output .= '<feFuncB type="table" tableValues="0.2509803922 0.4509803922"></feFuncB>';
					$output .= '<feFuncA type="table" tableValues="0 1"></feFuncA>';
				$output .= '</feComponentTransfer>';
			$output .= '</filter>';

			// generate color filters
			foreach ( $colors as $color_key => $color_value ) {
				$output .= alchemists_set_duotone_filters( 'post-' . $color_key, $colors[$color_key][0], $colors[$color_key][1] );
			}

		$output .= '</svg>';

		echo $output;
	}

	add_action( 'wp_footer', 'alchemists_duotone_filters' );
}


/**
 * Top Menu custom walker
 */
class Alchemists_Top_Menu_Walker extends Walker_Nav_Menu {

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);

		$output .= "\n$indent<ul class=\"main-nav__sub-".$depth."\">\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

		if ( $depth === 0 ) {
			array_push( $classes, 'nav-account__item' );
		}

		$class_names = join(
			' ',
			apply_filters(
				'nav_menu_css_class',
				array_filter( $classes ), $item
			)
		);

		! empty ( $class_names )
				and $class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= "<li id='menu-item-$item->ID' $class_names>";

		$attributes  = '';

		! empty( $item->attr_title )
				and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
		! empty( $item->target )
				and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
		! empty( $item->xfn )
				and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
		! empty( $item->url )
				and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$item_output = $args->before
				. "<a $attributes>"
				. $args->link_before
				. $title
				. '</a> '
				. $args->link_after
				. $args->after;

		// Since $output is called by reference we don't need to return anything.
		$output .= apply_filters(
				'walker_nav_menu_start_el'
		,   $item_output
		,   $item
		,   $depth
		,   $args
		);
	}
}
