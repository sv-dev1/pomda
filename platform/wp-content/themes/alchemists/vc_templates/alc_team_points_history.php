<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $team_id
 * @var $calendar_id
 * @var $date
 * @var $date_from
 * @var $date_to
 * @var $color_line
 * @var $color_point
 * @var $el_class
 * @var $el_id
 * @var $css
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Alc_Team_Points_History
 */

$title = $team_id = $calendar_id = $date = $date_from = $date_to = $color_line = $color_point = $el_class = $el_id = $css = $css_animation = '';

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'widget card';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

wp_enqueue_script( 'alchemists-chartjs' );

// Team ID
// Check if we're on Single Team page and Team is not selected
if ( is_singular('sp_team') && $team_id == 'default' ) {
	if ( ! isset( $id ) ) {
		global $post;
		$id = $post->ID;
	}
} else {
	$id = intval($team_id);
}

// Calendar ID
$calendar = new SP_Calendar( $calendar_id );
if ( $date != 'default' )
	$calendar->date = $date;
if ( $date_from != 'default' )
	$calendar->from = $date_from;
if ( $date_to != 'default' )
	$calendar->to = $date_to;
$data = $calendar->data();


// echo '<pre>' . var_export($data, true) . '</pre>';

$results_by_event = array();
$dates_by_event   = array();

if ( alchemists_sp_preset('soccer') ) {

	$results_by_event2 = array();

	// Soccer
	foreach ( $data as $event ) {

		$results        = get_post_meta( $event->ID, 'sp_results', true );
		$event_date     = $event->post_date;

		// echo '<pre>' . var_export($results, true) . '</pre>';

		if ( isset( $results[$id] )) {
			if ( isset( $results[$id]['outcome'])) {
				$results_by_event[] = $results[$id]['firsthalf'];
				$results_by_event2[] = $results[$id]['secondhalf'];
				$dates_by_event[] = date( 'M j', strtotime($event_date));
			}
		}

	}
	wp_reset_postdata();

} else {

	// Default sport (Basketball)
	foreach ( $data as $event ) {

		$results        = get_post_meta( $event->ID, 'sp_results', true );
		$event_date     = $event->post_date;

		if ( isset( $results[$id] )) {
			if ( isset( $results[$id]['outcome'])) {
				$results_by_event[] = $results[$id]['points'];
				$dates_by_event[] = date( 'M j', strtotime($event_date));
			}
		}
	}
	wp_reset_postdata();

}

$results_by_event = implode(",", $results_by_event);
if ( alchemists_sp_preset( 'soccer' ) ) {
	$results_by_event2 = implode(",", $results_by_event2);
}
$dates_by_event =  implode(',', array_map( 'alchemists_add_quotes', $dates_by_event ));


// Chart Line color
$alchemists_data = get_option( 'alchemists_data' );
if ( alchemists_sp_preset( 'football' ) ) {
	$chart_line_color = isset( $alchemists_data['color-4'] ) ? $alchemists_data['color-4'] : '#3ffeca';
} else {
	$chart_line_color = isset( $alchemists_data['color-primary'] ) ? $alchemists_data['color-primary'] : '#ffdc11';
}

if ( $color_line ) {
	$chart_line_color = $color_line;
}


// Chart Point color
$chart_point_color = '#ffcc00';
if ( alchemists_sp_preset( 'football' ) ) {
	$chart_point_color = '#3ffeca';
}
if ( $color_point ) {
	$chart_point_color = $color_point;
}

// Get the activate sport
$sp_preset_name = 'default';
if ( alchemists_sp_preset( 'soccer' ) ) {
	$sp_preset_name = 'soccer';
} elseif ( alchemists_sp_preset( 'football' ) ) {
	$sp_preset_name = 'football';
}
?>

<!-- Points History -->
<div <?php echo implode( ' ', $wrapper_attributes ); ?> class="<?php echo esc_attr( apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base'], $atts ) ); ?>">

	<?php include( locate_template( 'vc_templates/alc_team_points_history/alc_team_points_history-' . $sp_preset_name . '.php' ) ); ?>

</div>
<!-- Points History / End -->
