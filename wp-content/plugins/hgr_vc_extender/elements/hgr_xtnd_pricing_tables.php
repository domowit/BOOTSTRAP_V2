<?php
/*
* Add-on Name: Pricing Tables
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('HGR_VC_PRICINGTABLES')) {
	class HGR_VC_PRICINGTABLES {
		var $team_nav_color;
		var $team_nav_min_height;

		function __construct() {
			add_action('admin_init', array($this, 'add_pricingtable'));
			
			/*
				Param type "number"
			*/ 
			if ( function_exists('add_shortcode_param')){
				add_shortcode_param('number' , array('HGR_XTND', 'make_number_input' ) );
			}
		}
		
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/	
		function add_pricingtable() {
			if(function_exists('vc_map')) {
				/*
					Parent element
				*/
				vc_map(
					array(
					   "name"						=>	__("Pricing Tables", "hgr_lang"),
					   "base"						=>	"hgr_pricing_tables",
					   "class"						=>	"",
					   "icon"						=>	"hgr_pricing_tables",
					   "category"					=>	__("HighGrade Extender", "hgr_lang"),
					   "as_parent"					=>	array(
									"only" => "hgr_pricing_table"
								),
					   "description"				=>	__("Pricing Tables block", "hgr_lang"),
					   "content_element"			=>	true,
					   "show_settings_on_create"	=>	true,
					   "params"					=>	array(
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Pricing table header text color:", "hgr_lang"),
								"param_name"		=>	"pt_header_text_color",
								"value"				=>	"#7e7e7e",
								"dependency"		=>	array(
										"not_empty"		=>	true
									),								
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Pricing table body text color:", "hgr_lang"),
								"param_name"		=>	"pt_body_text_color",
								"value"				=>	"#7e7e7e",
								"dependency"		=>	array(
										"not_empty"		=>	true
									),								
							),
							array(
								"type"				=>	"textfield",
								"class"				=>	"",
								"heading"			=>	__("Extra class", "hgr_lang"),
								"param_name"		=>	"extra_class",
								"value"				=>	"",
							),
							array(
								"type"				=>	"heading",
								"sub_heading"		=>	"This is a global setting page for the whole \"Pricing Tables\" block. Add some \"Tables\" in the container row to make it complete.",
								"param_name"		=>	"notification",
							),
						),
						"js_view" => 'VcColumnView'
					));
				
				/*
					Child element
				*/
				vc_map(
					array(
					   "name"					=>	__("Pricing Table", "hgr_lang"),
					   "holder"				=>	"div",
					   "base"					=>	"hgr_pricing_table",
					   "class"					=>	"",
					   "icon"					=>	"",
					   "content_element"		=>	true,
					   "as_child"				=>	array(
					   			"only"			=>	"hgr_pricing_tables"
							),
					   "params"				=>	array(
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Package name", "hgr_lang"),
								"param_name"	=>	"package_name",
								"value"			=>	"",
							),
							array(
								"type"			=>	"checkbox",
								"class"			=>	"",
								"heading"		=>	__("Recommended package", "hgr_lang"),
								"param_name"	=>	"recommended_package",
								"value"			=>	"",
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Recommended package", "hgr_lang"),
								"param_name"	=>	"recommended_package",
								"value" => array(
										"No"	=>	"false",
										"Yes"	=>	"true",
									),
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Package short text", "hgr_lang"),
								"param_name"	=>	"package_short_text",
								"value"			=>	"",
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Package price", "hgr_lang"),
								"param_name"	=>	"package_price",
								"value"			=>	"",
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Cost is per:", "hgr_lang"),
								"param_name"	=>	"cost_is_per",
								"value"			=>	array(
										"Day"		=>	"day",
										"Week"		=>	"week",
										"Month"		=>	"mo",
										"Year"		=>	"year",
										"Custom"	=>	"custom",
									),
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Custom cost per:", "hgr_lang"),
								"param_name"	=>	"custom_per_cost",
								"value"			=>	"item",
								"description"	=>	__("Set cost per item, package etc.", "hgr_lang"),
								"dependency"	=>	array(
										"element"		=>	"cost_is_per",
										"value"			=>	array( "custom" ),
									),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Currency:", "hgr_lang"),
								"param_name"	=>	"pt_currency",
								"value"			=>	array(
										"Dollar"	=>	"$",
										"Euro"		=>	"&euro;",
										"Custom"	=>	"custom",
									),
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Custom currency", "hgr_lang"),
								"param_name"	=>	"custom_currency",
								"value"			=>	"",
								"dependency"	=>	array(
										"element"	=>	"pt_currency",
										"value"		=>	array( "custom" ),
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Price color", "hgr_lang"),
								"param_name"	=>	"price_color",
								"value"			=>	"#fff",
								"description"	=>	__("If empty, white will be used", "hgr_lang")							
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Header background color", "hgr_lang"),
								"param_name"	=>	"header_color",
								"value"			=>	"#dff0d8",
								"description"	=>	__("If empty, a default color will be used", "hgr_lang")							
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Header background second color", "hgr_lang"),
								"param_name"	=>	"header_sec_color",
								"value"			=>	"#eef4ea",
								"description"	=>	__("If empty, a default color will be used", "hgr_lang")							
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Second background color", "hgr_lang"),
								"param_name"	=>	"body_bg_color",
								"value"			=>	"",
								"description"	=>	__("This is background color for price area. If empty, white will be used", "hgr_lang")							
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Package content background color", "hgr_lang"),
								"param_name"	=>	"package_bg_color",
								"value"			=>	"",
								"description"	=>	__("This is background color for package content area. If empty, white will be used", "hgr_lang")							
							),
							array(
								"type"			=>	"textarea_html",
								"class"			=>	"",
								"heading"		=>	__("Table body content", "hgr_lang"),
								"param_name"	=>	"pt_content",
								"value"			=>	"",
								"description"	=>	__("Add a unordered list (ul) with package elements", "hgr_lang")
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Buy button text", "hgr_lang"),
								"param_name"	=>	"buy_btn_text",
								"value"			=>	"",
								"description"	=>	__("Buy Now! or Start Now! or whatever you want... ", "hgr_lang")
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button action URL", "hgr_lang"),
								"param_name"	=>	"btn_url",
								"value"			=>	"",
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Buy button position", "hgr_lang"),
								"param_name"	=>	"buy_btn_position",
								"value"			=>	array(
										"In header"	=>	"header",
										"In footer"	=>	"footer",
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Buy button color", "hgr_lang"),
								"param_name"	=>	"buy_btn_color",
								"value"			=>	"",
								"description"	=>	__("If empty, a transparent backgroung button will be rendered.", "hgr_lang")							
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Buy button border color", "hgr_lang"),
								"param_name"	=>	"buy_btn_border_color",
								"value"			=>	"",
								"description"	=>	__("If empty, no border will be rendered", "hgr_lang")							
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Button border thickness", "hgr_lang"),
								"param_name"	=>	"buy_btn_border_width",
								"value"			=>	"",
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Thickness of the border (1-10).", "hgr_lang")
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Button roundness", "hgr_lang"),
								"param_name"	=>	"buy_btn_border_roundness",
								"value"			=>	'',
								"min"			=>	1,
								"max"			=>	6,
								"suffix"		=>	"px",
								"description"	=>	__("Button corners roundness (1-6).", "hgr_lang"),
								"dependency"	=>	array(
										"element"		=>	"buy_btn_border_width",
										"not_empty"	=>	true
									),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Button size", "hgr_lang"),
								"param_name"	=>	"buy_btn_size",
								"value"			=>	array(
										"Default"		=>	"default-size",
										"Large"			=>	"btn-lg",
										"Small"			=>	"btn-sm",
										"Extra small"	=>	"btn-xs",
									),
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Table side margins (left & right)", "hgr_lang"),
								"param_name"	=>	"table_margins",
								"description"	=>	__("Add a margin to left and right of the table, in pixles", "hgr_lang"),
								"value" => "",
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Table border thickness", "hgr_lang"),
								"param_name"	=>	"table_border_thickness",
								"description"	=>	__("Add a border the table, in pixles", "hgr_lang"),
								"value"			=>	"",
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Table border color", "hgr_lang"),
								"param_name"	=>	"table_border_color",
								"value"			=>	"",
								"dependency"	=>	array(
										"element"		=>	"table_border_thickness",
										"not_empty"	=>	true
									),							
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Table extra class", "hgr_lang"),
								"param_name"	=>	"table_extra_class",
								"value"			=>	"",
							),
					   )
					) 
				);
			}
		}
	}
	new HGR_VC_PRICINGTABLES;
}