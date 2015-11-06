<?php
/*
* Add-on Name: Blog POsts
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('HGR_VC_BLOGPOSTS')) {
	class HGR_VC_BLOGPOSTS {

		function __construct() {
			add_action('admin_init', array($this, 'hgr_posts_init'));
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function hgr_posts_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("HGR Blog Posts",'hgr_lang'),
					   "holder"			=>	"div",
					   "base"				=>	"hgr_blog_posts",
					   "class"				=>	"",
					   "icon"				=>	"hgr_blog_posts",
					   "category"			=>	__("HighGrade Extender",'hgr_lang'),
					   "description"		=>	__("Grid style blog posts.","hgr_lang"),
					   "content_element"	=>	true,
					   "params"			=>	array(
								array(
									"type"			=>	"textfield",
									"class"			=>	"",
									"heading"		=>	__("How many posts to fetch?", "hgr_lang"),
									"param_name"	=>	"posts_number",
									"value"			=>	"",
									"description"	=>	__("Enter the desired number of posts to fetch from blog. Recomended: 6", "hgr_lang")					
								),
								array(
									"type"			=>	"textfield",
									"class"			=>	"",
									"heading"		=>	__("How many posts to display on a row?", "hgr_lang"),
									"param_name"	=>	"posts_columns",
									"value"			=>	"",
									"description"	=>	__("Enter the desired number of posts to display on each row.", "hgr_lang")					
								),
								array(
									"type"			=>	"dropdown",
									"class"			=>	"",
									"heading"		=>	__("Display order", "hgr_lang"),
									"param_name"	=>	"display_order",
									"value"			=>	array(
										"Image > Title > Text" => "img_title_txt",
										"Title > Text" => "title_txt",
									),
									"description"	=>	__("How to display posts", "hgr_lang")
								),
								array(
									"type"			=>	"dropdown",
									"class"			=>	"",
									"heading"		=>	__("Order posts by", "hgr_lang"),
									"param_name"	=>	"display_by",
									"value"			=>	array(
										"Publish date"	=>	"ordr_by_publish_date",
										"Title"			=>	"ordr_by_date",
									),
								),
								array(
									"type"			=>	"dropdown",
									"class"			=>	"",
									"heading"		=>	__("Order", "hgr_lang"),
									"param_name"	=>	"order",
									"value"			=>	array(
										"Ascending"	=>	"ascending",
										"Descending"	=>	"descending",
									),
								),
								array(
									"type"			=>	"dropdown",
									"class"			=>	"",
									"heading"		=>	__("Blog post footer type", "hgr_lang"),
									"param_name"	=>	"blogpost_footer",
									"value"			=>	array(
										"Icon based"	=>	"iconbased",
										"Compact"		=>	"compact",
										"Simple"		=>	"simple",
									),
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"hgr_left_floated",
									"heading"		=>	__("Footer background color:", "hgr_lang"),
									"param_name"	=>	"footer_bg_color",
									"value"			=>	"",	
									"dependency"	=>	array(
										"element"		=>	"blogpost_footer",
										"value"			=>	array("compact")
									),						
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"",
									"heading"		=>	__("Footer border & separators color:", "hgr_lang"),
									"param_name"	=>	"footer_sep_border_color",
									"value"			=>	"",	
									"dependency"	=>	array(
										"element"		=>	"blogpost_footer",
										"value"			=>	array("compact")
									),						
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"",
									"heading"		=>	__("Links color:", "hgr_lang"),
									"param_name"	=>	"links_color",
									"value"			=>	"",							
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"",
									"heading"		=>	__("Background color:", "hgr_lang"),
									"param_name"	=>	"bg_color",
									"value"			=>	"",							
								),
								array(
									"type"			=>	"textfield",
									"class"			=>	"",
									"heading"		=>	__("Extra class", "hgr_lang"),
									"param_name"	=>	"extra_class",
									"value"			=>	"",
									"description"	=>	__("Extra CSS class for custom CSS", "hgr_lang")					
								),
					   )
					) 
				);
			}
		}
	}
	new HGR_VC_BLOGPOSTS;
}