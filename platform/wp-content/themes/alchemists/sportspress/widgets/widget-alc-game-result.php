<?php
/**
 * Game Result
 *
 * @author    Dan Fisher
 * @package   Alchemists
 * @since     1.0.0
 * @version   3.0.5
 */


// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}


/**
 * Widget class.
 */

class Alchemists_Widget_Event_Result extends WP_Widget {


	/**
	 * Constructor.
	 *
	 * @access public
	 */
	function __construct() {

		$widget_ops = array(
			'classname' => 'widget-game-result',
			'description' => esc_html__( 'Display event results.', 'alchemists' ),
		);
		$control_ops = array(
			'id_base' => 'widget-game-result'
		);

		parent::__construct( 'widget-game-result', 'ALC: Event Results', $widget_ops, $control_ops );

	}


	/**
	 * Outputs the widget content.
	 */

	function widget( $args, $instance ) {

		extract( $args );

		$id = empty($instance['id']) ? null : $instance['id'];

		$title                = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$caption              = empty($instance['caption']) ? null : $instance['caption'];
		$date                 = empty($instance['date']) ? 'default' : $instance['date'];
		$date_from            = empty($instance['date_from']) ? 'default' : $instance['date_from'];
		$date_to              = empty($instance['date_to']) ? 'default' : $instance['date_to'];
		$date_past            = empty($instance['date_past']) ? 'default' : $instance['date_past'];
		$date_future          = empty($instance['date_future']) ? 'default' : $instance['date_future'];
		$date_relative        = empty($instance['date_relative']) ? 'default' : $instance['date_relative'];
		$day                  = empty($instance['day']) ? 'default' : $instance['day'];
		$number               = empty($instance['number']) ? null : $instance['number'];
		$layout_style         = isset( $instance['layout_style'] ) ? $instance['layout_style'] : 'horizontal';
		$show_stats           = isset( $instance['show_stats'] ) ? true : false;

		if ( alchemists_sp_preset( 'soccer' ) ) {
			$show_timeline      = isset( $instance['show_timeline'] ) ? true : false;
		}


		echo wp_kses_post( $before_widget );

		if( $title ) {
			echo wp_kses_post( $before_title ) . esc_html( $title ) . wp_kses_post( $after_title );
		}

		$event_result_array = array(
			'id'            => $id,
			'title'         => $caption,
			'status'        => 'publish',
			'date'          => $date,
			'date_from'     => $date_from,
			'date_to'       => $date_to,
			'date_past'     => $date_past,
			'date_future'   => $date_future,
			'date_relative' => $date_relative,
			'day'           => $day,
			'number'        => $number,
			'order'         => 'default',
			'layout_style'  => $layout_style,
			'show_stats'    => $show_stats
		);

		if ( alchemists_sp_preset( 'soccer' ) ) {
			$event_result_array['show_timeline'] = $show_timeline;
		}

		sp_get_template( 'game-result.php', $event_result_array );

		echo wp_kses_post( $after_widget );
	}

	/**
	 * Updates a particular instance of a widget.
	 */

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title']                = strip_tags( $new_instance['title'] );
		$instance['id']                   = intval($new_instance['id']);
		$instance['caption']              = strip_tags($new_instance['caption']);
		$instance['date']                 = $new_instance['date'];
		$instance['date_from']            = $new_instance['date_from'];
		$instance['date_to']              = $new_instance['date_to'];
		$instance['date_past']            = $new_instance['date_past'];
		$instance['date_future']          = $new_instance['date_future'];
		$instance['date_relative']        = $new_instance['date_relative'];
		$instance['day']                  = $new_instance['day'];
		$instance['number']               = intval($new_instance['number']);
		$instance['layout_style']         = $new_instance['layout_style'];
		$instance['show_stats']           = $new_instance['show_stats'];

		if ( alchemists_sp_preset( 'soccer' ) ) {
			$instance['show_timeline']      = $new_instance['show_timeline'];
		}

		return $instance;
	}


	/**
	 * Outputs the settings update form.
	 */

	function form( $instance ) {

		$defaults = array(
			'title'                => '',
			'id'                   => null,
			'caption'              => '',
			'status'               => 'publish',
			'date'                 => 'default',
			'date_from'            => date_i18n( 'Y-m-d' ),
			'date_to'              => date_i18n( 'Y-m-d' ),
			'date_past'            => 7,
			'date_future'          => 7,
			'date_relative'        => false,
			'day'                  => '',
			'number'               => 1,
			'order'                => 'default',
			'show_all_events_link' => false,
			'layout_style'         => 'horizontal',
			'show_stats'           => 'on'
		);

		if ( alchemists_sp_preset( 'soccer' ) ) {
			$defaults['show_timeline'] = false;
		}

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title                = strip_tags($instance['title']);
		$id                   = intval($instance['id']);
		$caption              = strip_tags($instance['caption']);
		$date                 = $instance['date'];
		$date_from            = $instance['date_from'];
		$date_to              = $instance['date_to'];
		$date_past            = $instance['date_past'];
		$date_future          = $instance['date_future'];
		$date_relative        = $instance['date_relative'];
		$day                  = $instance['day'];
		$number               = intval($instance['number']);
		$layout_style         = $instance['layout_style'];
		$show_stats           = $instance['show_stats'];

		if ( alchemists_sp_preset( 'soccer' ) ) {
			$show_timeline = $instance['show_timeline'];
		}
		?>

		<p><label for="<?php echo esc_attr( $this->get_field_id('caption') ); ?>"><?php esc_html_e( 'Title:', 'alchemists' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('caption') ); ?>" name="<?php echo esc_attr( $this->get_field_name('caption') ); ?>" type="text" value="<?php echo esc_attr( $caption ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id('id') ); ?>"><?php printf( esc_html__( 'Select %s:', 'alchemists' ), esc_html__( 'Calendar', 'alchemists' ) ); ?></label>
		<?php
		$args = array(
			'post_type'       => 'sp_calendar',
			'show_option_all' => esc_html__( 'All', 'alchemists' ),
			'name'            => $this->get_field_name('id'),
			'id'              => $this->get_field_id('id'),
			'selected'        => $id,
			'values'          => 'ID',
			'class'           => 'sp-event-calendar-select widefat',
		);
		if ( ! sp_dropdown_pages( $args ) ):
			sp_post_adder( 'sp_calendar', esc_html__( 'Add New', 'alchemists' ) );
		endif;
		?>
		</p>

		<div class="sp-date-selector">
			<p><label for="<?php echo esc_attr( $this->get_field_id('date') ); ?>"><?php esc_html_e( 'Date:', 'alchemists' ); ?></label>
				<?php
				$args = array(
					'show_option_default' => esc_html__( 'Default', 'alchemists' ),
					'name' => $this->get_field_name('date'),
					'id' => $this->get_field_id('date'),
					'selected' => $date,
					'class' => 'sp-event-date-select widefat',
				);
				sp_dropdown_dates( $args );
				?>
			</p>
			<div class="sp-date-range<?php if ( 'range' !== $date ): ?> hidden<?php endif; ?>">
				<p class="sp-date-range-absolute<?php if ( $date_relative ): ?> hidden<?php endif; ?>">
					<input type="text" name="<?php echo $this->get_field_name( 'date_from' ); ?>" value="<?php echo $date_from; ?>" placeholder="yyyy-mm-dd" size="10">
					:
					<input type="text" name="<?php echo $this->get_field_name( 'date_to' ); ?>" value="<?php echo $date_to; ?>" placeholder="yyyy-mm-dd" size="10">
				</p>

				<p class="sp-date-range-relative<?php if ( ! $date_relative ): ?> hidden<?php endif; ?>">
					<?php esc_html_e( 'Past', 'alchemists' ); ?>
					<input type="number" min="0" step="1" class="tiny-text" name="<?php echo $this->get_field_name( 'date_past' ); ?>" value="<?php echo $date_past; ?>">
					&rarr;
					<?php esc_html_e( 'Next', 'alchemists' ); ?>
					<input type="number" min="0" step="1" class="tiny-text" name="<?php echo $this->get_field_name( 'date_future' ); ?>" value="<?php echo $date_future; ?>">
					<?php esc_html_e( 'days', 'alchemists' ); ?>
				</p>

				<p class="sp-date-relative">
					<label>
						<input type="checkbox" name="<?php echo $this->get_field_name( 'date_relative' ); ?>" value="1" id="<?php echo $this->get_field_id( 'date_relative' ); ?>" <?php checked( $date_relative ); ?>>
						<?php esc_html_e( 'Relative', 'alchemists' ); ?>
					</label>
				</p>
			</div>
		</div>

		<p><label for="<?php echo esc_attr( $this->get_field_id('day') ); ?>"><?php esc_html_e( 'Match Day:', 'alchemists' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id('day') ); ?>" name="<?php echo esc_attr( $this->get_field_name('day') ); ?>" type="text" placeholder="<?php esc_attr_e( 'All', 'alchemists' ); ?>" value="<?php echo esc_attr( $day ); ?>" size="10"></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id('number') ); ?>"><?php esc_html_e( 'Number of events to show:', 'alchemists' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3"></p>

		<?php if ( alchemists_sp_preset( 'soccer' ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $instance['show_timeline'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_timeline' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_timeline' ) ); ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'show_timeline' ) ); ?>"><?php esc_attr_e( 'Show Timeline', 'alchemists' ); ?></label>
			</p>
		<?php endif; ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'layout_style' ) ); ?>"><?php esc_html_e( 'Layout:', 'alchemists' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'layout_style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout_style' ) ); ?>" class="widefat" style="width:100%;">
				<option value="horizontal" <?php echo ( 'horizontal' == $instance['layout_style'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Horizontal', 'alchemists' ); ?></option>
				<option value="vertical" <?php echo ( 'vertical' == $instance['layout_style'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Vertical', 'alchemists' ); ?></option>
			</select>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_stats'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_stats' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_stats' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_stats' ) ); ?>"><?php esc_attr_e( 'Show Stats', 'alchemists' ); ?></label>
		</p>

		<?php

	}
}

register_widget('Alchemists_Widget_Event_Result');
