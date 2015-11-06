<?php
/*
Plugin Name: Parallax Backgrounds for VC
Description: Adds new options to Visual Composer rows to enable parallax scrolling to row background images.
Author: Benjamin Intal - Gambit
Version: 2.7
Author URI: http://gambit.ph
Plugin URI: http://codecanyon.net/user/gambittech/portfolio
Text Domain: gambit-vc-parallax-bg
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

defined( 'VERSION_GAMBIT_VC_PARALLAX_BG' ) or define( 'VERSION_GAMBIT_VC_PARALLAX_BG', '2.6' );

defined( 'GAMBIT_VC_PARALLAX_BG' ) or define( 'GAMBIT_VC_PARALLAX_BG', 'gambit-vc-parallax-bg' );


if ( ! class_exists( 'GambitVCParallaxBackgrounds' ) ) {

	/**
	 * Parallax Background Class
	 *
	 * @since	1.0
	 */
	class GambitVCParallaxBackgrounds {

		private static $parallaxID = 1;

		/**
		 * Constructor, checks for Visual Composer and defines hooks
		 *
		 * @return	void
		 * @since	1.0
		 */
		function __construct() {
			// Our translations
			add_action( 'plugins_loaded', array( $this, 'loadTextDomain' ), 1 );

			// Gambit links
			add_filter( 'plugin_row_meta', array( $this, 'pluginLinks' ), 10, 2 );

            add_action( 'after_setup_theme', array( $this, 'init' ), 1 );
			add_filter( 'gambit_add_parallax_div', array( __CLASS__, 'createParallaxDiv' ), 10, 3 );
            add_action( 'admin_head', array( $this, 'printAdminScripts' ) );

			// Activation instructions & CodeCanyon rating notices
			$this->createNotices();

			// Add plugin specific filters and actions here
		}


		/**
		 * Hook into Visual Composer
		 *
		 * @return	void
		 * @since	2.3
		 */
        public function init() {
			// Check if Visual Composer is installed
            if ( ! defined( 'WPB_VC_VERSION' ) ) {
                return;
            }

            if ( version_compare( WPB_VC_VERSION, '4.2', '<' ) ) {
        		add_action( 'init', array( $this, 'addParallaxParams' ), 100 );
            } else {
        		add_action( 'vc_after_mapping', array( $this, 'addParallaxParams' ) );
            }
        }


		/**
		 * There is a bug in Visual Composer where the dependencies do not refresh if the settings
         * are inside a tab, this mini-script fixes this error
		 *
		 * @return	void
		 * @since	2.0
		 */
        public function printAdminScripts() {
            echo "<script>
                jQuery(document).ready(function(\$) {
                \$('body').on('click', '[role=tab]', function() { \$('[name=gmbt_prlx_bg_type]').trigger('change') });
                });
                </script>";
        }


		/**
		 * Loads the translations
		 *
		 * @return	void
		 * @since	1.0
		 */
		public function loadTextDomain() {
			load_plugin_textdomain( GAMBIT_VC_PARALLAX_BG, false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}


		/**
		 * Creates the placeholder for the row with the parallax bg
		 *
		 * @param	string $output An empty string
		 * @param	array $atts The attributes of the vc_row shortcode
		 * @param	string $content The contents of vc_row
		 * @return	string The placeholder div
		 * @since	1.0
		 */
		public static function createParallaxDiv( $output, $atts, $content ) {
			extract( shortcode_atts( array(
				// Old parameter names, keep these for backward rendering compatibility
				'parallax'                => '',
				'speed'                   => '',
				'enable_mobile'           => '',
				'break_parents'           => '',
				'row_span'                => '',
                // BG type
                'gmbt_prlx_bg_type'       => '',
				'gmbt_background_position' => '',
				// Our new parameter names
				'gmbt_prlx_parallax'      => '',
				'gmbt_prlx_speed'         => '',
				'gmbt_prlx_enable_mobile' => '',
				'gmbt_prlx_break_parents' => '',
				'gmbt_prlx_row_span'      => '',
                // Video options
                'gmbt_prlx_video_height_correction' => '0',
                'gmbt_prlx_video_width_correction' => '0',
                'gmbt_prlx_video_youtube' => '',
                'gmbt_prlx_video_youtube_mute' => '',
                'gmbt_prlx_video_youtube_loop_trigger' => '0',
                'gmbt_prlx_video_vimeo'   => '',
                'gmbt_prlx_smooth_scrolling' => '',

			), $atts ) );

			/*
			 * We're using new param names now, support the old ones
			 */

			if ( empty( $gmbt_prlx_parallax ) ) {
				$gmbt_prlx_parallax = $parallax;
			}
			if ( empty( $gmbt_prlx_speed ) ) {
				$gmbt_prlx_speed = $speed;
			}
			if ( empty( $gmbt_prlx_enable_mobile ) ) {
				$gmbt_prlx_enable_mobile = $enable_mobile;
			}
			if ( empty( $gmbt_prlx_break_parents ) ) {
				$gmbt_prlx_break_parents = $break_parents;
			}
			if ( empty( $gmbt_prlx_row_span ) ) {
				$gmbt_prlx_row_span = $row_span;
			}

			/*
			 * Main parallax method
			 */

            $type = 'video';
            if ( empty( $gmbt_prlx_bg_type ) || $gmbt_prlx_bg_type == 'parallax' ) {
                $type = 'parallax';
            }

			if ( empty( $gmbt_prlx_parallax ) ) {
				return "";
			}


            /*
             * Enqueue scripts
             */

            $pluginData = get_plugin_data( __FILE__ );

            // Our main script
            wp_enqueue_script(
                'vc-row-parallax',
                plugins_url( 'js/script-ck.js', __FILE__ ),
                array( 'jquery' ),
                VERSION_GAMBIT_VC_PARALLAX_BG,
                true
            );

            // Our main styles
            wp_enqueue_style(
                'vc-row-parallax',
                plugins_url( 'css/style.css', __FILE__ ),
                array(),
                VERSION_GAMBIT_VC_PARALLAX_BG
            );

            // Our image scroller
			wp_enqueue_script(
                'vc-row-parallax-scrolly',
                plugins_url( 'js/jquery.scrolly-ck.js', __FILE__ ),
                array( 'jquery' ),
                VERSION_GAMBIT_VC_PARALLAX_BG,
                true
            );

            // Our video handler
            if ( $type == 'video' ) {
    			wp_enqueue_script(
                    'vc-row-parallax-video',
                    plugins_url( 'js/bg-video-ck.js', __FILE__ ),
                    array( 'jquery' ),
                    VERSION_GAMBIT_VC_PARALLAX_BG,
                    true
                );
            }


			$parallaxClass = ( $gmbt_prlx_parallax == "none" ) ? "" : "bg-parallax";
			$parallaxClass = in_array( $gmbt_prlx_parallax, array( "none", "up", "down", "left", "right", "bg-parallax" ) ) ? $parallaxClass : "";

            if ( ! empty( $gmbt_prlx_smooth_scrolling ) ) {
                $parallaxClass .= $parallaxClass ? ' ' : '';
                $parallaxClass .= $gmbt_prlx_smooth_scrolling;
            }

            if ( $type == 'video' ) {
                $parallaxClass = "bg-parallax";
            }

            if ( ! $parallaxClass ) {
                return '';
            }

            $videoDiv = "";


            if ( $type == 'video' ) {
                if ( ! empty( $gmbt_prlx_video_youtube ) ) {
                    $videoDiv = "<div id='video-" . self::$parallaxID++ . "' data-youtube-video-id='" . $gmbt_prlx_video_youtube . "' data-mute='" . ( $gmbt_prlx_video_youtube_mute == 'mute' ? 'true' : 'false' ) . "' data-loop-adjustment='" . $gmbt_prlx_video_youtube_loop_trigger . "' data-height-correction='" . $gmbt_prlx_video_height_correction . "' data-width-correction='" . $gmbt_prlx_video_width_correction . "'><div id='video-" . self::$parallaxID++ . "-inner'></div></div>";
                } else if ( ! empty( $gmbt_prlx_video_vimeo ) ) {
                    $videoDiv = '<div id="video-' . self::$parallaxID++ . '" data-vimeo-video-id="' . $gmbt_prlx_video_vimeo . '"  data-height-correction="' . $gmbt_prlx_video_height_correction . '" data-width-correction="' . $gmbt_prlx_video_width_correction . '"><iframe src="//player.vimeo.com/video/' . $gmbt_prlx_video_vimeo . '?html5=1&autopause=0&autoplay=1&badge=0&byline=0&loop=1&title=0" frameborder="0"></iframe></div>';
                }
            }


			return  "<div style='pointer-events : none;' class='" . esc_attr( $parallaxClass ) . "' " .
				"data-bg-align='" . esc_attr( $gmbt_background_position ) . "' " .
				"data-direction='" . esc_attr( $gmbt_prlx_parallax ) . "' " .
				"data-velocity='" . esc_attr( (float)$gmbt_prlx_speed * -1 ) . "' " .
				"data-mobile-enabled='" . esc_attr( $gmbt_prlx_enable_mobile ) . "' " .
				"data-break-parents='" . esc_attr( $gmbt_prlx_break_parents ) . "' " .
				"data-row-span='" . esc_attr( $gmbt_prlx_row_span ) . "'>" . $videoDiv . "</div>";
		}


		/**
		 * Adds the parameter fields to the VC row
		 *
		 * @return	void
		 * @since	1.0
		 */
		public function addParallaxParams() {
			$setting = array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Background Type", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_bg_type",
				"value" => array(
					__( "Image Parallax", GAMBIT_VC_PARALLAX_BG ) => "parallax",
					__( "Video", GAMBIT_VC_PARALLAX_BG ) => "video",
				),
				"description" => __( "", GAMBIT_VC_PARALLAX_BG ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __( "Enable Smooth Scrolling", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_smooth_scrolling",
				"value" => array( __( "Check this to enable smooth scrolling for the whole page. If this is checked, and others aren't the page will still scroll smoothly.", GAMBIT_VC_PARALLAX_BG ) => "gambit_parallax_enable_smooth_scroll" ),
				"description" => __( "", GAMBIT_VC_PARALLAX_BG ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "YouTube Video ID", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_video_youtube",
				"value" => "",
				"description" => __( "Enter the video ID of the YouTube video you want to use as your background. You can see the video ID from your video's URL: https://www.youtube.com/watch?v=XXXXXXXXX (The X's is the video ID). <em>Ads will show up in the video if it has them.</em> No video will be shown if left blank. <strong>Tip: newly uploaded videos may not display right away and might show an error message</strong>", GAMBIT_VC_PARALLAX_BG ),
                "dependency" => array(
                    "element" => "gmbt_prlx_bg_type",
                    "value" => array( "video" ),
                ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Vimeo Video ID", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_video_vimeo",
				"value" => "",
				"description" => __( "Enter the video ID of the Vimeo video you want to use as your background. You can see the video ID from your video's URL: https://vimeo.com/XXXXXXX (The X's is the video ID). No video will be shown if left blank. <strong>Tip: Vimeo sometimes has problems with Firefox</strong>", GAMBIT_VC_PARALLAX_BG ),
                "dependency" => array(
                    "element" => "gmbt_prlx_bg_type",
                    "value" => array( "video" ),
                ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __( "Mute YouTube Video", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_video_youtube_mute",
				"value" => array( __( "Check this to mute your video", GAMBIT_VC_PARALLAX_BG ) => "mute" ),
				"description" => __( "", GAMBIT_VC_PARALLAX_BG ),
                "dependency" => array(
                    "element" => "gmbt_prlx_video_youtube",
                    "not_empty" => true,
                ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __( "Mute YouTube Video", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_video_youtube_mute",
				"value" => array( __( "Check this to mute your video", GAMBIT_VC_PARALLAX_BG ) => "mute" ),
				"description" => __( "", GAMBIT_VC_PARALLAX_BG ),
                "dependency" => array(
                    "element" => "gmbt_prlx_video_youtube",
                    "not_empty" => true,
                ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "YouTube Loop Triggering Refinement", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_video_youtube_loop_trigger",
				"value" => "0",
				"description" => '<div class="dashicons dashicons-megaphone" style="color: #e74c3c"></div> ' . __( "<strong>Use this if you see a noticeable dark video frame before the video loops.</strong> Because YouTube performs it's video looping with a huge noticeable delay, we try our best to guess when the video exactly ends and trigger a loop when we <em>just</em> reach the end. If there's a dark frame, put in a time here in milliseconds that we can use to push back the looping trigger. Try values from 5-100 milliseconds.", GAMBIT_VC_PARALLAX_BG ),
                "dependency" => array(
                    "element" => "gmbt_prlx_video_youtube",
                    "not_empty" => true,
                ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Vertical Black Bars Fix (Video Height Correction)", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_video_height_correction",
				"value" => '0',
				"description" => '<div class="dashicons dashicons-megaphone" style="color: #e74c3c"></div> ' . __( "<strong>Use this if your video is showing black bars on its sides</strong>. To get rid of the black bars, we need to make your video a bit <strong>taller</strong>. The value you put here will be added to the height of the video. Your video will be clipped a little on the sides because of this. This is a percentage value, try using a value of 0.1 to 100.0", GAMBIT_VC_PARALLAX_BG ),
                "dependency" => array(
                    "element" => "gmbt_prlx_bg_type",
                    "value" => array( "video" ),
                ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Horizontal Black Bars Fix (Video Width Correction)", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_video_width_correction",
				"value" => '0',
				"description" => '<div class="dashicons dashicons-megaphone" style="color: #e74c3c"></div> ' . __( "<strong>Use this if your video is showing black bars on the top and bottom</strong>. To get rid of the black bars, we need to make your video a bit <strong>wider</strong>. The value you put here will be added to the width of the video. Your video will be clipped a little on the top and bottom. because of this. This is a percentage value, try using a value of 0.1 to 100.0", GAMBIT_VC_PARALLAX_BG ),
                "dependency" => array(
                    "element" => "gmbt_prlx_bg_type",
                    "value" => array( "video" ),
                ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Background Image Parallax", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_parallax",
				"value" => array(
					"No Parallax" => "none",
					"Up" => "up",
					"Down" => "down",
					"Left" => "left",
					"Right" => "right",
				),
				"description" => __( "<strong><em>To select a background image, head over to the <strong>Design Options</strong> tab and upload an image there.</em></strong><br><br>Select the parallax effect for your background image in this field. Be mindful of the <strong>background size</strong> and the <strong>dimensions</strong> of your background image when setting this value. For example, if you're performing a vertical parallax (up or down), make sure that your background image has a large height that can provide sufficient scrolling space for the parallax effect.", GAMBIT_VC_PARALLAX_BG ),
                "dependency" => array(
                    "element" => "gmbt_prlx_bg_type",
                    "value" => array( "parallax" ),
                ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Background Position / Alignment", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_background_position",
				"value" => array(
					__( "Centered", GAMBIT_VC_PARALLAX_BG ) => "",
					__( "Left (only applies to up or down parallax)", GAMBIT_VC_PARALLAX_BG ) => "left",
					__( "Right (only applies to up or down parallax)", GAMBIT_VC_PARALLAX_BG ) => "right",
					__( "Top (only applies to left or right parallax)", GAMBIT_VC_PARALLAX_BG ) => "top",
					__( "Bottom (only applies to left or right parallax)", GAMBIT_VC_PARALLAX_BG ) => "bottom",
				),
				"description" => __( "The alignment of the background / parallax image. Note that this will only be followed if the background image is larger than your container. For example", GAMBIT_VC_PARALLAX_BG ),
                "dependency" => array(
                    "element" => "gmbt_prlx_bg_type",
                    "value" => array( "parallax" ),
                ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "textfield",
				"class" => "",
				"heading" => __( "Parallax Speed", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_speed",
				"value" => "0.3",
				"description" => __( "The movement speed, value should be between 0.1 and 1.0. A lower number means slower scrolling speed. Be mindful of the <strong>background size</strong> and the <strong>dimensions</strong> of your background image when setting this value. Faster scrolling means that the image will move faster, make sure that your background image has enough width or height for the offset.", GAMBIT_VC_PARALLAX_BG ),
                "dependency" => array(
                    "element" => "gmbt_prlx_bg_type",
                    "value" => array( "parallax" ),
                ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "checkbox",
				"class" => "",
				"param_name" => "gmbt_prlx_enable_mobile",
				"value" => array( __( "Check this to enable the parallax effect in mobile devices", GAMBIT_VC_PARALLAX_BG ) => "parallax-enable-mobile" ),
				"description" => __( "Parallax effects would most probably cause slowdowns when your site is viewed in mobile devices. If the device width is less than 980 pixels, then it is assumed that the site is being viewed in a mobile device.", GAMBIT_VC_PARALLAX_BG ),
                "dependency" => array(
                    "element" => "gmbt_prlx_bg_type",
                    "value" => array( "parallax" ),
                ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Breakout Parallax & Video Background", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_break_parents",
				"value" => array(
					"Don't break out the row container" => "0",
					sprintf( _n( "Break out of 1 container", "Break out of %d containers", 1, GAMBIT_VC_PARALLAX_BG ), 1 ) => "1",
					sprintf( _n( "Break out of 1 container", "Break out of %d containers", 2, GAMBIT_VC_PARALLAX_BG ), 2 ) => "2",
					sprintf( _n( "Break out of 1 container", "Break out of %d containers", 3, GAMBIT_VC_PARALLAX_BG ), 3 ) => "3",
					sprintf( _n( "Break out of 1 container", "Break out of %d containers", 4, GAMBIT_VC_PARALLAX_BG ), 4 ) => "4",
					sprintf( _n( "Break out of 1 container", "Break out of %d containers", 5, GAMBIT_VC_PARALLAX_BG ), 5 ) => "5",
					sprintf( _n( "Break out of 1 container", "Break out of %d containers", 6, GAMBIT_VC_PARALLAX_BG ), 6 ) => "6",
					sprintf( _n( "Break out of 1 container", "Break out of %d containers", 7, GAMBIT_VC_PARALLAX_BG ), 7 ) => "7",
					sprintf( _n( "Break out of 1 container", "Break out of %d containers", 8, GAMBIT_VC_PARALLAX_BG ), 8 ) => "8",
					sprintf( _n( "Break out of 1 container", "Break out of %d containers", 9, GAMBIT_VC_PARALLAX_BG ), 9 ) => "9",
					sprintf( _n( "Break out of 1 container", "Break out of %d containers", 10, GAMBIT_VC_PARALLAX_BG ), 10 ) => "10",
					__( "Break out of all containers (full page width)", GAMBIT_VC_PARALLAX_BG ) => "99",
				),
				"description" => __( "The parallax or video effect is contained inside a Visual Composer row, depending on your theme, this container may be too small for your parallax effect. Adjust this option to let the parallax effect stretch outside it's current container and occupy the parent container's width.", GAMBIT_VC_PARALLAX_BG ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );

			$setting = array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( "Breakout Parallax & Video Row Span", GAMBIT_VC_PARALLAX_BG ),
				"param_name" => "gmbt_prlx_row_span",
				"value" => array(
					"Occupy this row only" => "0",
					sprintf( _n( "Occupy also the next row", "Occupy also the next %d rows", 1, GAMBIT_VC_PARALLAX_BG ), 1 ) => "1",
					sprintf( _n( "Occupy also the next row", "Occupy also the next %d rows", 2, GAMBIT_VC_PARALLAX_BG ), 2 ) => "2",
					sprintf( _n( "Occupy also the next row", "Occupy also the next %d rows", 3, GAMBIT_VC_PARALLAX_BG ), 3 ) => "3",
					sprintf( _n( "Occupy also the next row", "Occupy also the next %d rows", 4, GAMBIT_VC_PARALLAX_BG ), 4 ) => "4",
					sprintf( _n( "Occupy also the next row", "Occupy also the next %d rows", 5, GAMBIT_VC_PARALLAX_BG ), 5 ) => "5",
					sprintf( _n( "Occupy also the next row", "Occupy also the next %d rows", 6, GAMBIT_VC_PARALLAX_BG ), 6 ) => "6",
					sprintf( _n( "Occupy also the next row", "Occupy also the next %d rows", 7, GAMBIT_VC_PARALLAX_BG ), 7 ) => "7",
					sprintf( _n( "Occupy also the next row", "Occupy also the next %d rows", 8, GAMBIT_VC_PARALLAX_BG ), 8 ) => "8",
					sprintf( _n( "Occupy also the next row", "Occupy also the next %d rows", 9, GAMBIT_VC_PARALLAX_BG ), 9 ) => "9",
					sprintf( _n( "Occupy also the next row", "Occupy also the next %d rows", 10, GAMBIT_VC_PARALLAX_BG ), 10 ) => "10",
				),
				"description" => __( "The parallax or video effect is normall only applied for this Visual Composer row. You can choose here if you want this parallax background to also span across the next Visual Composer row. Remember to clear the background of the next row so as not to cover up the parallax.", GAMBIT_VC_PARALLAX_BG ),
				"group" => __( "Image Parallax / Video", GAMBIT_VC_PARALLAX_BG ),
			);
			vc_add_param( 'vc_row', $setting );
		}


		/**
		 * Adds plugin links
		 *
		 * @access	public
		 * @param	array $plugin_meta The current array of links
		 * @param	string $plugin_file The plugin file
		 * @return	array The current array of links together with our additions
		 * @since	2.6
		 **/
		public function pluginLinks( $plugin_meta, $plugin_file ) {
			if ( $plugin_file == plugin_basename( __FILE__ ) ) {
				$pluginData = get_plugin_data( __FILE__ );

				$plugin_meta[] = sprintf( "<a href='%s' target='_blank'>%s</a>",
					"http://support.gambit.ph?utm_source=" . urlencode( $pluginData['Name'] ) . "&utm_medium=plugin_link",
					__( "Get Customer Support", GAMBIT_VC_PARALLAX_BG )
				);
				$plugin_meta[] = sprintf( "<a href='%s' target='_blank'>%s</a>",
					"http://codecanyon.net/user/GambitTech/portfolio?utm_source=" . urlencode( $pluginData['Name'] ) . "&utm_medium=plugin_link",
					__( "Get More Plugins", GAMBIT_VC_PARALLAX_BG )
				);
			}
			return $plugin_meta;
		}


		/************************************************************************
		 * Activation instructions & CodeCanyon rating notices START
		 ************************************************************************/
		/**
		 * For theme developers who want to include our plugin, they will need
		 * to disable this section. This can be done by include this line
		 * in their theme:
		 *
		 * defined( 'GAMBIT_DISABLE_RATING_NOTICE' ) or define( 'GAMBIT_DISABLE_RATING_NOTICE', true );
		 */

		/**
		 * Adds the hooks for the notices
		 *
		 * @access	protected
		 * @return	void
		 * @since	2.6
		 **/
		protected function createNotices() {
			register_activation_hook( __FILE__, array( $this, 'justActivated' ) );
			register_deactivation_hook( __FILE__, array( $this, 'justDeactivated' ) );

			if ( defined( 'GAMBIT_DISABLE_RATING_NOTICE' ) ) {
				return;
			}

			add_action( 'admin_notices', array( $this, 'remindSettingsAndSupport' ) );
			add_action( 'admin_notices', array( $this, 'remindRating' ) );
			add_action( 'wp_ajax_' . __CLASS__ . '-ask-rate', array( $this, 'ajaxRemindHandler' ) );
		}


		/**
		 * Creates the transients for triggering the notices when the plugin is activated
		 *
		 * @return	void
		 * @since	2.6
		 **/
		public function justActivated() {
			delete_transient( __CLASS__ . '-activated' );

			if ( defined( 'GAMBIT_DISABLE_RATING_NOTICE' ) ) {
				return;
			}

			set_transient( __CLASS__ . '-activated', time(), MINUTE_IN_SECONDS * 3 );

			delete_transient( __CLASS__ . '-ask-rate' );
			set_transient( __CLASS__ . '-ask-rate', time(), DAY_IN_SECONDS * 4 );

			update_option( __CLASS__ . '-ask-rate-placeholder', 1 );
		}


		/**
		 * Removes the transients & triggers when the plugin is deactivated
		 *
		 * @return	void
		 * @since	2.6
		 **/
		public function justDeactivated() {
			delete_transient( __CLASS__ . '-activated' );
			delete_transient( __CLASS__ . '-ask-rate' );
			delete_option( __CLASS__ . '-ask-rate-placeholder' );
		}


		/**
		 * Ajax handler for when a button is clicked in the 'ask rating' notice
		 *
		 * @return	void
		 * @since	2.6
		 **/
		public function ajaxRemindHandler() {
			check_ajax_referer( __CLASS__, '_nonce' );

			if ( $_POST['type'] == 'remove' ) {
				delete_option( __CLASS__ . '-ask-rate-placeholder' );
			} else { // remind
				set_transient( __CLASS__ . '-ask-rate', time(), DAY_IN_SECONDS );
			}

			die();
		}


		/**
		 * Displays the notice for reminding the user to rate our plugin
		 *
		 * @return	void
		 * @since	2.6
		 **/
		public function remindRating() {
			if ( defined( 'GAMBIT_DISABLE_RATING_NOTICE' ) ) {
				return;
			}
			if ( get_option( __CLASS__ . '-ask-rate-placeholder' ) === false ) {
				return;
			}
			if ( get_transient( __CLASS__ . '-ask-rate' ) ) {
				return;
			}

			$pluginData = get_plugin_data( __FILE__ );
			$nonce = wp_create_nonce( __CLASS__ );

			echo '<div class="updated gambit-ask-rating" style="border-left-color: #3498db">
					<p>
						<img src="' . plugins_url( 'gambit-logo.png', __FILE__ ) . '" style="display: block; margin-bottom: 10px"/>
						<strong>' . sprintf( __( 'Enjoying %s?', GAMBIT_VC_PARALLAX_BG ), $pluginData['Name'] ) . '</strong><br>' .
						__( 'Help us out by rating our plugin 5 stars in CodeCanyon! This will allow us to create more awesome products and provide top notch customer support.', GAMBIT_VC_PARALLAX_BG ) . '<br>' .
						'<button data-href="http://codecanyon.net/downloads?utm_source=' . urlencode( $pluginData['Name'] ) . '&utm_medium=rate_notice#item-7049478" class="button button-primary" style="margin: 10px 10px 10px 0;">' . __( 'Rate us 5 stars in CodeCanyon :)', GAMBIT_VC_PARALLAX_BG ) . '</button>' .
						'<button class="button button-secondary remind" style="margin: 10px 10px 10px 0;">' . __( 'Remind me tomorrow', GAMBIT_VC_PARALLAX_BG ) . '</button>' .
						'<button class="button button-secondary nothanks" style="margin: 10px 0;">' . __( 'I&apos;ve already rated!', GAMBIT_VC_PARALLAX_BG ) . '</button>' .
						'<script>
						jQuery(document).ready(function($) {
							"use strict";

							$(".gambit-ask-rating button").click(function() {
								if ( $(this).is(".button-primary") ) {
									var $this = $(this);

									var data = {
										"_nonce": "' . $nonce . '",
										"action": "' . __CLASS__ . '-ask-rate",
										"type": "remove"
									};

									$.post(ajaxurl, data, function(response) {
										$this.parents(".updated:eq(0)").fadeOut();
										window.open($this.attr("data-href"), "_blank");
									});

								} else if ( $(this).is(".remind") ) {
									var $this = $(this);

									var data = {
										"_nonce": "' . $nonce . '",
										"action": "' . __CLASS__ . '-ask-rate",
										"type": "remind"
									};

									$.post(ajaxurl, data, function(response) {
										$this.parents(".updated:eq(0)").fadeOut();
									});

								} else if ( $(this).is(".nothanks") ) {
									var $this = $(this);

									var data = {
										"_nonce": "' . $nonce . '",
										"action": "' . __CLASS__ . '-ask-rate",
										"type": "remove"
									};

									$.post(ajaxurl, data, function(response) {
										$this.parents(".updated:eq(0)").fadeOut();
									});
								}
								return false;
							});
						});
						</script>
					</p>
				</div>';
		}


		/**
		 * Displays the notice that we have a support site and additional instructions
		 *
		 * @return	void
		 * @since	2.6
		 **/
		public function remindSettingsAndSupport() {
			if ( defined( 'GAMBIT_DISABLE_RATING_NOTICE' ) ) {
				return;
			}
			if ( ! get_transient( __CLASS__ . '-activated' ) ) {
				return;
			}

			$pluginData = get_plugin_data( __FILE__ );

			echo '<div class="updated" style="border-left-color: #3498db">
					<p>
						<img src="' . plugins_url( 'gambit-logo.png', __FILE__ ) . '" style="display: block; margin-bottom: 10px"/>
						<strong>' . sprintf( __( 'Thank you for activating %s!', GAMBIT_VC_PARALLAX_BG ), $pluginData['Name'] ) . '</strong><br>' .

						__( 'Now just edit your <strong>row settings</strong> in Visual Composer, add a background picture in the <strong>Design Options</strong> tab, then head on to the <strong>Image Parallax / Video</strong> tab to adjust your parallax.', GAMBIT_VC_PARALLAX_BG ) . '<br>' .

						__( 'If you need any support, you can leave us a ticket in our support site. The link to our support site is listed in the plugin details for future reference.', GAMBIT_VC_PARALLAX_BG ) . '<br>' .
						'<a href="http://support.gambit.ph?utm_source=' . urlencode( $pluginData['Name'] ) . '&utm_medium=activation_notice" class="gambit_ask_rate button button-default" style="margin: 10px 0;" target="_blank">' . __( 'Visit our support site', GAMBIT_VC_PARALLAX_BG ) . '</a>' .
						'<br>' .
						'<em style="color: #999">' . __( 'This notice will go away in a moment', GAMBIT_VC_PARALLAX_BG ) . '</em><br>
					</p>
				</div>';
		}


		/************************************************************************
		 * Activation instructions & CodeCanyon rating notices END
		 ************************************************************************/
	}


	new GambitVCParallaxBackgrounds();
}



if ( ! function_exists( 'vc_theme_before_vc_row' ) ) {


	/**
	 * Adds the placeholder div right before the vc_row is printed
	 *
	 * @param	array $atts The attributes of the vc_row shortcode
	 * @param	string $content The contents of vc_row
	 * @return	string The placeholder div
	 * @since	1.0
	 */
	function vc_theme_before_vc_row($atts, $content = null) {
		return apply_filters( 'gambit_add_parallax_div', '', $atts, $content );
	}
}
