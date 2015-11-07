
esg_tiny_reset_all();

ess_grid_is_vc = true; //set for the saving that we are visual composer

jQuery('.wpb-element-edit-modal').hide(); //hide the normal VC window and use own

jQuery('#ess-grid-tiny-dialog-step-1').show();
jQuery('#ess-grid-tiny-dialog-step-2').hide();
jQuery('#ess-grid-tiny-dialog-step-3').hide();

jQuery('#ess-grid-tiny-mce-dialog').dialog({
	id       : 'ess-grid-tiny-mce-dialog',
	title	 : eg_lang.shortcode_generator,
	width    : 720,
	height   : 'auto'
});