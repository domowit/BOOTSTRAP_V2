<?php

/**
 * displays the existing Eventbrite event meta box in the editor
 *
 * @package Tribe__Events__MainEventBrite
 * @since  3.0
 * @author Modern Tribe Inc.
 */

?>
<script type="text/javascript" charset="utf-8">
jQuery(document).ready(function($){

	// hide/show EventBrite fields
	$('.EBForm').hide();

	if ( $("#EventBriteToggleOn:checked").length ) {
		$(".EBForm").show();
	}

	$("#EventBriteToggleOn").click(function(){
		$(".EBForm").slideDown('slow');
	});
	$("#EventBriteToggleOff").click(function(){
		$(".EBForm").slideUp(200);
	});

	var paymentType = $("input[name='EventBriteIsDonation']:checked");

	if ( $('.EBForm:visible').length > 0 && paymentType.val() == 0 ) {
	    $('.eb-tec-payment-options').show(0);
	} else if ( paymentType.val() == 1 ) {
		$('.eb-tec-payment-options').show(0);
	} else {
    	$('.eb-tec-payment-options').hide(0);
	}

	var togglePaymentOptions = function(){
		if ( $("#EventBriteToggleOn:checked").length === 0 ){
			return;
		}

	    var paymentType = $("input[name='EventBriteIsDonation']:checked");
		if ( paymentType.val() == 0 ) {
			$('.eb-tec-payment-options').show(0);
			$('#EventBriteEventCost').parents('tr').show(0);
		} else if ( paymentType.val() == 1 ) {
			$('#EventBriteEventCost').parents('tr').hide(0);
			$('.eb-tec-payment-options').show(0);
		} else {
			$('#EventBriteEventCost').parents('tr').hide(0);
			$('.eb-tec-payment-options').hide(0);
		}
	}

	togglePaymentOptions();

	$("input[name='EventBriteIsDonation']").change( togglePaymentOptions );

	// hide/show additional payment option fields
	var ebTecAcceptPaymentInputs = $('#eb-tec-payment-options-checkboxes input');
	if( ebTecAcceptPaymentInputs.is(':checked') ){
		$(".tec-eb-offline-pay-options").show();
	} else {
		$(".tec-eb-offline-pay-options").hide();
	}
	function ebTecShowHideAdditionalPaymentOptions(event) {
		if ( event && $('.EBForm:visible').length > 0 ) {
			var divIndex = ebTecAcceptPaymentInputs.index(this);
			var notSelectedIndex = ebTecAcceptPaymentInputs.index( $('#eb-tec-payment-options-checkboxes input:radio:not(:checked)') );
			if(this.checked) {
				$('.eb-tec-payment-instructions:eq('+divIndex+')').slideDown(200);
				$(".tec-eb-offline-pay-options").show();
			} else {
			 $('.eb-tec-payment-instructions:eq('+divIndex+')').slideUp(200);
			}
        $('#eb-tec-payment-options-checkboxes input:radio:not(:checked)').each(function(index) {
           var notSelectedIndex = ebTecAcceptPaymentInputs.index($(this));
           if(notSelectedIndex >= 0)
             $('.eb-tec-payment-instructions:eq('+notSelectedIndex+')').slideUp(200)
        });
		} else {
			$.each('#eb-tec-payment-options-checkboxes ~ #eb-tec-payment-options div', function() {
				var thisInput = $(this).find('input');
				if(thisInput.val() != null) {
					thisInput.closest('div').slideDown(200);
					$(".tec-eb-offline-pay-options").show();
				}
			});
		}
    $('.eb-tec-payment-details td').css('display', $('#eb-tec-payment-options-checkboxes input:checked').not('#EventBritePayment_accept_online-none').size() > 0 ? 'table-cell' : 'none');
	}

	ebTecAcceptPaymentInputs.bind('focus click', ebTecShowHideAdditionalPaymentOptions);
	ebTecAcceptPaymentInputs.focus();
	$('#title').focus();

	// Define error checking routine on submit
	$("form[name='post']").submit(function() {
			var EventStartDate = $("#EventStartDate").val();

			var currentDate = new Date();
			var EventDate = new Date();
			if( $("input[name='EventRegister']:checked").val() == 'yes' &&  (typeof( EventStartDate ) == 'undefined' || !EventStartDate.length || EventDate.toDateString() < currentDate.toDateString())) {
				alert("<?php esc_attr_e( 'Eventbrite only allows events to be saved that start in the future.', 'tribe-eventbrite' ) ?>");

				$('#EventStartDate').focus();
				return false;
			}

	});

	$("form[name='post']").submit(function() {
		var ticket_name = $("input[name='EventBriteTicketName']").val();
		if( $("#EventBriteToggleOn").attr('checked') == true && typeof( ticket_name ) != 'undefined' ) {
			var ticket_price = $("input[name='EventBriteEventCost']").val();
			var ticket_quantity = $("input[name='EventBriteTicketQuantity']").val();
			var is_donation = $("input[name='EventBriteIsDonation']:checked").val();
			if( typeof( ticket_name ) == 'undefined' || !ticket_name.length ) {
				alert("<?php esc_attr_e( 'Please provide a ticket name for the Eventbrite ticket.', 'tribe-eventbrite' ); ?>");
				$("input[name='EventBriteTicketName']").focus();
				return false;
			}
			if( !ticket_price.length && !is_donation) {
				alert("<?php esc_attr_e( 'You must set a price for the ticket', 'tribe-eventbrite' ); ?>" + ticket_name);
				$("input[name='EventBriteEventCost']").focus();
				return false;
			}
			if( (parseInt(ticket_quantity) == 0 || isNaN(parseInt(ticket_quantity) ) ) ) {
				alert("<?php esc_attr_e( 'Ticket quantity is not a number', 'tribe-eventbrite' ); ?>");
				$("input[name='EventBriteTicketQuantity']").focus();
				return false;
			}
			if( $('input[name="EventBritePayment_accept_paypal"]').is(':checked') ) {
				var emailField = $('input[name="EventBritePayment_paypal_email"]');
				if( !emailField.val().length ) {
					alert("<?php esc_attr_e( 'A Paypal email address must be provided.', 'tribe-eventbrite' ); ?>");
					emailField.focus();
					return false;
				}
			}
			return true;
		}
	});

	/**
		* BEGIN: chunk copied from core events-admin.js for a datepicker patch in 3.11.
		* TODO: restructure core and this location for the next release
	 */
	var $date_format      = $( '[data-datepicker_format]' );

	// Modified from tribe_ev.data to match jQuery UI formatting.
	var datepicker_formats = {
		'main' : ['yy-mm-dd', 'm/d/yy', 'mm/dd/yy', 'd/m/yy', 'dd/mm/yy', 'm-d-yy', 'mm-dd-yy', 'd-m-yy', 'dd-mm-yy'],
		'month': ['yy-mm', 'm/yy', 'mm/yy', 'm/yy', 'mm/yy', 'm-yy', 'mm-yy', 'm-yy', 'mm-yy']
	};

	var date_format = 'yy-mm-dd';

	if ( $date_format.length && $date_format.attr( 'data-datepicker_format' ).length === 1 ) {
		var datepicker_format = $date_format.attr( 'data-datepicker_format' );
		date_format = datepicker_formats.main[ datepicker_format ];
	}
	/**
	 * END: chunk copied from core for a patch in 3.11
	 */

   var datepickerOpts = {
      dateFormat: date_format,
      showOn: 'focus',
      showAnim: 'fadeIn',
      minDate: new Date(),
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 3,
      showButtonPanel: true,
      onSelect: function(selectedDate) {
         var option = "minDate";
         var instance = $(this).data("datepicker");
         var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
      }
   };
   var dates = $(".etp-datepicker").datepicker(datepickerOpts);
   $(".etp-datepicker").bind( 'click', function() {
   		var startDate = $('#EventStartDate').val();
		if ( startDate ) {
         	$(this).datepicker( 'option', 'maxDate', startDate );
         	$(this).datepicker( 'show' );
        }
    });
}); // end document ready
</script>

<?php do_action( 'tribe_eventbrite_meta_box_top' ); ?>
<tr>
	<td colspan="2" class="tribe_sectionheader">
		<?php do_action( 'tribe_eventbrite_before_integration_header' ); ?>
		<h4><?php esc_html_e( 'Tickets', 'tribe-eventbrite' );?>
	</td>
</tr>

<?php if ( isset( $event_deleted ) && $event_deleted ) : ?>
	<div id='eventBriteDraft' class='error'>
    <p><?php esc_html_e( 'This event has been deleted from Eventbrite. It is now unregistered from Eventbrite.', 'tribe-eventbrite' ); ?></p>
	</div>
<?php endif; ?>
	<tr>
		<td>
			<?php if ( ! $_EventBriteId ) {?>
				<?php esc_html_e( 'Register this event with eventbrite.com?', 'tribe-eventbrite' );?>
	        <?php }else{ ?>
				<?php esc_html_e( 'Leave this event associated with eventbrite.com?', 'tribe-eventbrite' );?>
			<?php } ?>
		</td>
		<td>
			<input id='EventBriteToggleOn' tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='radio' name='EventRegister' value='yes' <?php checked( $isRegisterChecked, true ); ?> />&nbsp;<b><?php esc_attr_e( 'Yes', 'tribe-eventbrite' ); ?></b>
			<input id='EventBriteToggleOff' tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='radio' name='EventRegister' value='no' <?php checked( $isRegisterChecked, false ); ?>/>&nbsp;<b><?php esc_attr_e( 'No', 'tribe-eventbrite' ); ?></b>
		</td>
	</tr>
	<?php if ( $_EventBriteId ){?>
	<tr>
		<td><?php esc_html_e( 'Display tickets on event page?', 'tribe-eventbrite' );?></td>
		<td>
			<input id='EventBriteShowOn' tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='radio' name='EventShowTickets' value='yes' <?php checked( $displayTickets, true ); ?> />&nbsp;<b><?php esc_attr_e( 'Yes', 'tribe-eventbrite' ); ?></b>
			<input id='EventBriteShowOff' tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='radio' name='EventShowTickets' value='no' <?php checked( $displayTickets, false ); ?>/>&nbsp;<b><?php esc_attr_e( 'No', 'tribe-eventbrite' ); ?></b>
		</td>
	</tr>
 <?php } ?>
    <?php if ( ! $_EventBriteId ) :?>
    <?php if ( function_exists( 'tribe_is_recurring_event' ) ): ?>
       <tr><td colspan='2'><?php esc_html_e( 'Note: The Eventbrite API does not yet support recurring events, so all instances of recurring events will be associated with a single Eventbrite event.', 'tribe-eventbrite' ) ?></td></tr>
     <?php endif; ?>
    <?php if ( function_exists( 'tribe_is_recurring_event' ) ): ?>
       <tr><td colspan='2'><?php esc_html_e( 'Note: Eventbrite requires you enter an organizer. If you neglect to enter an organizer, your display name will be passed as the organizer name to Eventbrite', 'tribe-eventbrite' ) ?></td></tr>
     <?php endif; ?>

	<tr class="EBForm">
		<td colspan="2" class="snp_sectionheader">
			<h4><?php esc_html_e( 'Set up your first ticket', 'tribe-eventbrite' );?>
			<small style="text-transform:none; display:block; margin-top:8px; font-weight:normal;"><?php esc_html_e( 'To create multiple tickets per event, submit this form, then follow the link to Eventbrite.', 'tribe-eventbrite' ); ?></small></h4>
		</td>
	</tr>
	<tr class="EBForm">
		<td>
			<?php esc_html_e( 'Name', 'tribe-eventbrite' ); ?>:<span class="tec-required">✳</span>
		</td>
		<td>
			<input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="text" name="EventBriteTicketName" size="14" value="<?php echo esc_attr( $_EventBriteTicketName ); ?>" />
		</td>
	</tr>
	<tr class="EBForm">
		<td></td>
		<td class="snp_message"><small><?php esc_html_e( 'Examples: Member, Non-member, Student, Early Bird', 'tribe-eventbrite' ); ?></small></td>
	</tr>
	<tr class="EBForm">
		<td>
			<?php esc_html_e( 'Description', 'tribe-eventbrite' ); ?>:
		</td>
		<td>
			<textarea class="description_input" tabindex="<?php $tribe_ecp->tabIndex(); ?>" name="EventBriteTicketDescription" 	rows="2" cols="55"><?php echo esc_attr( $_EventBriteTicketDescription ); ?></textarea>
		</td>
	</tr>
	<tr class="EBForm">
		<td>
			<?php esc_html_e( 'Date to Start Ticket Sales', 'tribe-eventbrite' ); ?>:<span class="tec-required">✳</span>
		</td>
		<td>
			<input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="text" name="EventBriteTicketStartDate" value='<?php echo esc_attr( $_EventBriteTicketStartDate ); ?>' class='etp-datepicker'/>
    @
    <select tabindex='<?php $tribe_ecp->tabIndex(); ?>' name='EventBriteTicketStartHours'>
      <?php echo Tribe__Events__View_Helpers::getHourOptions( '00:00:00' ) ?>
    </select>
    <select tabindex='<?php $tribe_ecp->tabIndex(); ?>' name='EventBriteTicketStartMinutes'>
      <?php echo Tribe__Events__View_Helpers::getMinuteOptions( '00:00:00' ) ?>
    </select>
			<?php if ( ! strstr( get_option( 'time_format', Tribe__Events__Date_Utils::TIMEFORMAT ), 'H' ) ) : ?>
        <select tabindex='<?php $tribe_ecp->tabIndex(); ?>' name='EventBriteTicketStartMeridian'>
          <?php echo Tribe__Events__View_Helpers::getMeridianOptions( '00:00:00' ) ?>
        </select>
			<?php endif; ?>
		</td>
	</tr>
	<tr class="EBForm">
		<td>
			<?php esc_html_e( 'Date to End Ticket Sales', 'tribe-eventbrite' ); ?>:<span class="tec-required">✳</span>
		</td>
		<td>
			<input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="text" name="EventBriteTicketEndDate" value='<?php echo esc_attr( $_EventBriteTicketEndDate ); ?>' class='etp-datepicker'/>
    @
    <select tabindex='<?php $tribe_ecp->tabIndex(); ?>' name='EventBriteTicketEndHours'>
      <?php echo Tribe__Events__View_Helpers::getHourOptions( '00:00:00' ) ?>
    </select>
    <select tabindex='<?php $tribe_ecp->tabIndex(); ?>' name='EventBriteTicketEndMinutes'>
      <?php echo Tribe__Events__View_Helpers::getMinuteOptions( '00:00:00' ) ?>
    </select>
			<?php if ( ! strstr( get_option( 'time_format', Tribe__Events__Date_Utils::TIMEFORMAT ), 'H' ) ) : ?>
    		<select tabindex='<?php $tribe_ecp->tabIndex(); ?>' name='EventBriteTicketEndMeridian'>
	        <?php echo Tribe__Events__View_Helpers::getMeridianOptions( '00:00:00' ) ?>
	    </select>
			<?php endif; ?>
		</td>
	</tr>

	<tr class="EBForm">
		<td>
			<?php esc_html_e( 'Type', 'tribe-eventbrite' ); ?>:<span class="tec-required">✳</span>
		</td>
		<td>
			<span class="tec-radio-option" ><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" name="EventBriteIsDonation" value="0" <?php checked( ! isset( $_EventBriteIsDonation ) || 0 === (int) $_EventBriteIsDonation ) ?> /><?php esc_attr_e( ' Set Price', 'tribe-eventbrite' ); ?></span>
			<br/>
			<span class="tec-radio-option" ><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" name="EventBriteIsDonation" value="1" <?php checked( 1 === (int) $_EventBriteIsDonation ) ?> /><?php esc_attr_e( ' Donation Based', 'tribe-eventbrite' ); ?></span>
			<br/>
			<span class="tec-radio-option" ><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" name="EventBriteIsDonation" value="2" <?php checked( 2 === (int) $_EventBriteIsDonation ) ?> /><?php esc_attr_e( ' Free', 'tribe-eventbrite' ); ?></span>
		</td>
	</tr>
	<tr class="EBForm">
		<td><?php esc_html_e( 'Cost', 'tribe-eventbrite' ); ?>:<span class="tec-required">✳</span></td>
		<td><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='text' id='EventBriteEventCost' name='EventBriteEventCost' size='6' value='<?php echo esc_attr( ! empty( $_EventBriteEventCost ) ? $_EventBriteEventCost : '' ); ?>' /></td>
	</tr>
	<tr class="EBForm">
		<td>
			<?php esc_html_e( 'Quantity', 'tribe-eventbrite' ); ?>:<span class="tec-required">✳</span>
		</td>
		<td>
			<input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type='text' name='EventBriteTicketQuantity' size='14' value='<?php echo esc_attr( $_EventBriteTicketQuantity ); ?>' />
		</td>
	<tr  class="EBForm  eb-tec-payment-options">
		<td>
			<?php esc_html_e( 'Fee', 'tribe-eventbrite' ); ?>:<span class="tec-required">✳</span>
		</td>
		<td>
			<span class="tec-radio-option" ><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" class="radio" name="EventBriteIncludeFee" value="0" <?php checked( empty( $_EventBriteIncludeFee ) || 0 === $_EventBriteIncludeFee ) ?> /> <?php esc_attr_e( 'Add Service Fee on top of price', 'tribe-eventbrite' ); ?></span>
			<br/>
			<span class="tec-radio-option"><input tabindex="<?php $tribe_ecp->tabIndex(); ?>" type="radio" class="radio" name="EventBriteIncludeFee" value="1" <?php checked( 1 === $_EventBriteIncludeFee ) ?> /><?php esc_attr_e( ' Include Service fee in price', 'tribe-eventbrite' ); ?></span>
		</td>
	</tr>
	<tr  class="EBForm">
		<td colspan="2" class="snp_sectionheader">
		<h4><?php esc_html_e( 'Publish this post to create the Event with Eventbrite.com', 'tribe-eventbrite' );?></h4>
		<div><p><?php _e( 'When you <strong>publish</strong> this post, an event will be created for you at Eventbrite. Before you publish, you can choose whether this event will save as a draft or live event using the Eventbrite status below.', 'tribe-eventbrite' ) ?></p></div>
		</td>
	</tr>

	<tr class="EBForm">
		<td>
			<?php esc_html_e( 'Eventbrite Event Status', 'tribe-eventbrite' ); ?>:
		</td>
		<td>
		<?php if ( $tribe_ecp ) : ?>
			<select name="EventBriteStatus" tabindex="<?php $tribe_ecp->tabIndex(); ?>">
		<?php else : ?>
			<select name="EventBriteStatus">
		<?php endif; ?>
				<option value='Draft'><?php esc_html_e( 'Draft', 'tribe-eventbrite' ); ?></option>
				<option value='Live'><?php esc_html_e( 'Live', 'tribe-eventbrite' ); ?></option>
			</select>
		</td>
	</tr>

    <?php else : // have eventbrite id ?>
		<?php include( 'eventbrite-events-table.php' ); ?>
    <?php endif; // !$_EventBriteId
