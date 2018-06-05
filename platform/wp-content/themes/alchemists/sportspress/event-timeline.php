<?php
/**
 * Timeline
 *
 * @author 		ThemeBoy
 * @package 	SportsPress_Timelines
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! isset( $id ) )
	$id = get_the_ID();

// Get linear timeline from event
$event = new SP_Event( $id );
$timeline = $event->timeline( false, true );

// Return if timeline is empty
if ( empty( $timeline ) ) return;

// Get team link option
$link_teams = get_option( 'sportspress_link_teams', 'no' ) == 'yes' ? true : false;

// Get full time of event
$minutes = $event->minutes();

// Initialize spacer
$previous = 0;

?>
<div class="sp-template sp-template-timeline sp-template-event-timeline card">
	<header class="card__header">
		<h4><?php esc_html_e('Game Timeline', 'alchemists'); ?></h4>
	</header>
	<div class="card__content">
		<!-- Timeline -->
		<div class="game-timeline-wrapper">
			<div class="game-timeline">

				<?php foreach ( $timeline as $minute => $details ) : ?>
					<?php
					$time = sp_array_value( $details, 'time', false );

					if ( false === $time ) continue;

					$icon = sp_array_value( $details, 'icon', '' );
					$side = sp_array_value( $details, 'side', 'home' );

					if ( $time < 0 ) {
						$name = sp_array_value( $details, 'name', esc_html__( 'Team', 'alchemists' ) );
						?>
						<div class="game-timeline__event game-timeline__event--kickoff game-timeline__event--side-<?php echo esc_attr( $side ); ?>" title="<?php esc_attr_e( 'Kick Off', 'alchemists' ); ?>">
							<?php if ( $icon ) : ?>
								<?php if ( $link_teams ) : ?>
									<?php $team = sp_array_value( $details, 'id' ); ?>
									<a href="<?php echo get_post_permalink( $team ); ?>" class="game-timeline__team-logo" title="<?php echo $name; ?>"><?php echo $icon; ?></a>
								<?php else : ?>
									<span class="game-timeline__team-logo" title="<?php echo $name; ?>"><?php echo $icon; ?></span>
								<?php endif; ?>
							<?php endif; ?>
							<div class="game-timeline__time game-timeline__time--kickoff game-timeline__time--kickoff-<?php echo esc_attr( $side ); ?>"><?php esc_html_e( 'KO', 'alchemists' ); ?></div>
						</div>
						<?php
					} else {
						$name = sp_array_value( $details, 'name', esc_html__( 'Player', 'alchemists' ) );
						$number = sp_array_value( $details, 'number', '' );

						if ( '' !== $number ) $name = $number . '. ' . $name;

						$offset = floor( $time / ( $minutes + 4 ) * 100 );
						if ( $offset - $previous <= 4 ) $offset = $previous + 4;
						$previous = $offset;
						?>
						<div class="game-timeline__event game-timeline__event--side-<?php echo esc_attr( $side ); ?>" style="left: <?php echo $offset; ?>%;">
							<div class="game-timeline__event-info game-timeline__event-info--side-<?php echo esc_attr( $side ); ?>">
								<div class="game-timeline__event-name"><?php echo $name; ?></div>
								<div class="game-timeline__icon game-timeline__icon--<?php echo esc_attr( $side ); ?>">
									<?php echo $icon; ?>
								</div>
							</div>
							<div class="game-timeline__time" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( strip_tags( $name ) ); ?>"><?php echo $time . "'"; ?></div>
						</div>
					<?php } ?>

				<?php endforeach; ?>

				<div class="game-timeline__event game-timeline__event--ft" title="<?php esc_attr_e( 'Full Time', 'alchemists' ); ?>">
					<div class="game-timeline__time"><?php esc_html_e( 'FT', 'alchemists' ); ?></div>
				</div>

			</div>
		</div>
		<!-- Timeline / End -->
	</div>
</div>
