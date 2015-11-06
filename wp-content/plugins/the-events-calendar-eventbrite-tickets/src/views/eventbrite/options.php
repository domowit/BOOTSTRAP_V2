<?php

/**
 * add Eventbrite options fields
 *
 * @package Tribe__Events__MainEventBrite
 * @since  3.0
 * @author Modern Tribe Inc.
 */
$tribeEvents = Tribe__Events__Main::instance();

?>
<h3><?php esc_html_e( 'Eventbrite Options', 'tribe-eventbrite' ); ?></h3>
<p><?php esc_html_e( 'These settings change the default event form. For example, if you set a default venue, this field will be automatically filled in on a new event.', 'tribe-eventbrite' ) ?></p>

<table class="form-table">
	<tr>
		<th scope="row"><?php esc_html_e( 'Automatically replace empty fields with default values', 'tribe-eventbrite' ); ?></th>
		<td>
			<fieldset>
				<legend class="screen-reader-text">
					<span><?php esc_html_e( 'Automatically replace empty fields with default values', 'tribe-eventbrite' ); ?></span>
				</legend>
				<label title='Replace empty fields'>
					<input type="checkbox" name="defaultValueReplace" value="1" <?php checked( tribe_get_option( 'defaultValueReplace' ) ); ?> />
					<?php esc_html_e( 'Enabled', 'tribe-eventbrite' ); ?>
				</label>
			</fieldset>
		</td>
	</tr>