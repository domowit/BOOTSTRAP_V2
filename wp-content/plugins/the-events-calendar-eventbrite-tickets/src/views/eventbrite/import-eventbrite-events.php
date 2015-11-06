<?php

/**
 * Import events from Eventbrite events in the admin form
 *
 * @package Tribe__Events__MainEventBrite
 * @since  3.0
 * @author Modern Tribe Inc.
 */

?>
<?php if ( ! empty( $_REQUEST['error'] ) ) : ?>
	<div class='error'>
		<p><?php esc_html_e( $_REQUEST['error'] ); ?></p>
	</div>
<?php endif; ?>
<div class="wrap">
	<!--<div class="icon32 icon32-posts-spevents"><br></div>-->
	<h2><?php esc_html_e( 'Import Eventbrite Events', 'tribe-eventbrite' ); ?></h2>
	<div>
		<?php _e( '<p>Import the event details from any public Eventbrite event.</p><p>Your Eventbrite event id can be found by going to your event page at Eventbrite.com.  Once there, examine your browser\'s address bar to see something like this - https://www.eventbrite.com/event/212356789.  The number after \'/event/\' is your event id.</p>', 'tribe-eventbrite' ); ?>
	</div>
   <br/>
	<form method="get" action="post.php">
		<input name="post_type" type="hidden" value="tribe_events"/>
		<table class="form-table">
			<tbody>
				<tr valign="top">

					<th scope="row"><label for="eventbrite_id"><?php esc_html_e( 'Eventbrite Event ID', 'tribe-eventbrite' ) ?></label></th>
					<td>
						<input name="eventbrite_id" type="text" id="eventbrite_id" value="" class="regular-text"/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="eventbrite_tz_correct"><?php esc_html_e( 'Automatically convert timezone', 'tribe-eventbrite' ) ?></label></th>
					<td>
						<input name="eventbrite_tz_correct" type="checkbox" id="eventbrite_tz_correct" value="1" />
						<?php esc_html_e( 'If the event is taking place in a different timezone, this corrects the time to your local WP timezone', 'tribe-eventbrite' ) ?>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Go"></p>
		<?php wp_nonce_field( 'import_eventbrite', 'import_eventbrite' ) ?>
	</form>
</div>
