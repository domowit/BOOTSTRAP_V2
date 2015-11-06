<?php
/*
* Add-on Name: HGR Button
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('HGR_VC_BUTTON')) {
	class HGR_VC_BUTTON {

		function __construct() {
			add_action('admin_init', array($this, 'hgr_button_init'));
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function hgr_button_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("HGR Button", "hgr_lang"),
					   "holder"			=>	"div",
					   "base"				=>	"hgr_button",
					   "class"				=>	"",
					   "icon"				=>	"hgr_button",
					   "description"		=>	__("Very configurable button", "hgr_lang"),
					   "category"			=>	__("HighGrade Extender", "hgr_lang"),
					   "content_element"	=>	true,
					   "params"	=>	array(
						   array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Text on the button", "hgr_lang"),
								"param_name"	=>	"hgr_buttontext",
								"value"			=>	"Buy now!",				
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Text size (pixels)", "hgr_lang"),
								"param_name"	=>	"hgr_buttontextsize",
								"value"			=>	"14",				
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Button action URL","hgr_lang"),
								 "param_name"	=>	"hgr_buttonurl",
								 "value"		=>	"",
								 "description"	=>	__("Set button link here.", "hgr_lang"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button text color", "hgr_lang"),
								"param_name"	=>	"hgr_buttontextcolor",
								"value"			=>	"#808080",							
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button text color on hover", "hgr_lang"),
								"param_name"	=>	"hgr_buttontexthovercolor",
								"value"			=>	"#808080",							
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button color", "hgr_lang"),
								"param_name"	=>	"hgr_buttoncolor",
								"value"			=>	"",							
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button color on hover", "hgr_lang"),
								"param_name"	=>	"hgr_buttoncolorhover",
								"value"			=>	"",							
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button width", "hgr_lang"),
								"description"	=>	__("Insert only numeric values",'hgr_lang'),
								"param_name"	=>	"hgr_buttonwidth",
								"value"			=>	"100",				
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Button width units", "hgr_lang"),
								"param_name"	=>	"hgr_buttonwidthunits",
								"value"			=>	array(
										"Pixels"	=>	"px",
										"Percent"	=>	"%",
										"Ems"		=>	"em",
									),
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button height", "hgr_lang"),
								"description"	=>	__("Insert only numeric values",'hgr_lang'),
								"param_name"	=>	"hgr_buttonheight",
								"value"			=>	"60",				
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Button height units", "hgr_lang"),
								"param_name"	=>	"hgr_buttonheightunits",
								"value"			=>	array(
										"Pixels"	=>	"px",
										"Percent"	=>	"%",
										"Ems"		=>	"em",
									),
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button border weight", "hgr_lang"),
								"description"	=>	__("Insert only numeric values. Pixels will be used.",'hgr_lang'),
								"param_name"	=>	"hgr_buttonborderweight",
								"value"			=>	"1",				
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button border color", "hgr_lang"),
								"param_name"	=>	"hgr_buttonbodercolor",
								"value"			=>	"",							
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button border color on hover", "hgr_lang"),
								"param_name"	=>	"hgr_buttonbordercolorhover",
								"value"			=>	"",							
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button roundness", "hgr_lang"),
								"description"	=>	__("Insert only numeric values",'hgr_lang'),
								"param_name"	=>	"hgr_buttonroundness",
								"value"			=>	"4",				
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon", "hgr_lang"),
								"param_name"	=>	"hgr_hasicon",
								"value"			=>	array(
										"No icon"	=>	"noicon",
										"Use icon"	=>	"withicon",
									),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon position", "hgr_lang"),
								"param_name"	=>	"hgr_iconposition",
								"value"			=>	array(
										"Left"		=>	"left",
										"Right"		=>	"right",
									),
								"dependency"	=>	array(
										"element"	=>	"hgr_hasicon",
										"value"		=>	array( "withicon")
									),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon type", "hgr_lang"),
								"param_name"	=>	"hgr_button_icontype",
								"value"			=>	array(
										"Font Icon Browser"	=>	"selector",
										"Custom Image Icon"	=>	"custom",
									),
								"description"	=>	__("Use an existing font icon or upload a custom image.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"hgr_hasicon",
										"value"		=>	array( "withicon" )
									),
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon ","hgr_lang"),
								"param_name"	=>	"hgr_button_icon",
								"value"			=>	"icon",
								"description"	=>	__("Click on an icon to select it.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"hgr_button_icontype",
										"value"		=>	array( "selector" )
									),
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Upload Image Icon:", "hgr_lang"),
								"param_name"	=>	"hgr_button_img",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload the custom image icon.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"hgr_button_icontype",
										"value"		=>	array( "custom" )
									),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon animation", "hgr_lang"),
								"param_name"	=>	"hgr_button_iconanimation",
								"value"			=>	array(
										"No animation"		=>	"noanimation",
										"Spin"				=>	"hgr_fa-spin",
										"Rotate 90"		=>	"hgr_fa-rotate-90",
										"Rotate 180"		=>	"hgr_fa-rotate-180",
										"Rotate 270"		=>	"hgr_fa-rotate-270",
										"Flip horizontal"	=>	"hgr_fa-flip-horizontal",
										"Flip vertical"	=>	"hgr_fa-flip-vertical",
									),
								"description"	=>	__("Does not apply to all icons!", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"hgr_hasicon",
										"value"		=>	array( "withicon" )
									),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Animate icon on", "hgr_lang"),
								"param_name"	=>	"hgr_button_iconanimationon",
								"value"			=>	array(
										"Always"			=>	"always",
										"On button hover"	=>	"onhover",
									),
								"description"	=>	__("Does not apply to all icons/animations!", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"hgr_button_iconanimation",
										"value"		=>	array(
											"hgr_fa-spin",
											"hgr_fa-rotate-90",
											"hgr_fa-rotate-180",
											"hgr_fa-rotate-270",
											"hgr_fa-flip-horizontal",
											"hgr_fa-flip-vertical",
										)
									),
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Icon size", "hgr_lang"),
								"param_name"	=>	"hgr_button_iconsize",
								"value"			=>	"",
								"description"	=>	__("Enter value in pixels, example: 24", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"hgr_hasicon",
										"value"		=>	array( "withicon" )
									),			
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Extra class", "hgr_lang"),
								"param_name"	=>	"hgr_button_extraclass",
								"value"			=>	"",
								"description"	=>	__("Enter a extra css class for this element, if you wish to override default css settings", "hgr_lang"),	
							),
					   )
					) 
				);
			}
		}
	}
	new HGR_VC_BUTTON;
}