<?php
/**
  HighGrade Framework Config File
  DO NOT MODIFY THIS FILE
**/

if (!class_exists('HighGrade_Framework_config')) {

    class HighGrade_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();
			
			// Generate dinamic style sheet
			//$this->hgr_generate_dcc($outputCSS);
            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
				
				add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'hgr_generate_dcc' ), 10, 3);
				
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
		
        function hgr_generate_dcc($options, $css, $changed_values) {
            //echo '<h1>The compiler hook has run!</h1>';
            //echo "<pre>";
            //print_r($changed_values); // Values that have changed since the last save
            //echo "</pre>";
			global $wp_filesystem;
 
				$filename = dirname(__FILE__) . '/theme-style.css';
			 
				if( empty( $wp_filesystem ) ) {
					require_once( ABSPATH .'/wp-admin/includes/file.php' );
					WP_Filesystem();
				}
			 
				if( $wp_filesystem ) {
					$wp_filesystem->put_contents(
						$filename,
						$css,
						FS_CHMOD_FILE // predefined mode settings for WP files
					);
				}
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'hgr_lang'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'hgr_lang'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**
          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;
            return $args;
        }

        /**
          Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'hgr_lang'), $this->theme->display('Name'));
            
            ?>
            

            <?php
				$item_info = ob_get_contents();
				ob_end_clean();
				$sampleHTML = '';
				
            	// ACTUAL DECLARATION OF SECTIONS ****************************************** //
				// BRANDING SECTION
				$this->sections[] = array(
					'icon'		=>	'hgr-branding',
					'title'		=>	__('Branding', 'hgr_lang'),
					'heading'	=>	__('Branding Settings', 'hgr_lang'),
					'fields'	=>	array(
							array(
								'id'			=>	'logo',
								'type'			=>	'media',
								'title'			=>	__('Regular logo', 'redux-framework-demo'),
								'subtitle'		=>	__('Upload your logo. <br>Recomended: 174px x 60px transparent .png', 'hgr_lang'),
								'url'			=>	true,
								'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
								'default'		=>	array( 'url'=>get_template_directory_uri().'/highgrade/images/logo.png', 'width'=>'174', 'height'=>'60' ),
								'hint'			=>	array(
									'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
								)
							),
							array(
								'id'			=>	'retina_logo',
								'type'			=>	'media',
								'title'			=>	__('Retina Logo @2x', 'redux-framework-demo'),
								'subtitle'		=>	__('Upload your retina logo. <br>Recomended: 348px x 120px transparent .png', 'hgr_lang'),
								'url'			=>	true,
								'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
								'default'		=>	array( 'url'=>get_template_directory_uri().'/highgrade/images/logo@2x.png','width'=>'174', 'height'=>'60' ),
								'hint'			=>	array(
									'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
								)
							),
							array(
								'id'			=>	'favicon',
								'type'			=>	'media',
								'title'			=>	__('Regular Favicon', 'redux-framework-demo'),
								'subtitle'		=>	__('Upload your favicon. <br>Recomended: 16px x 16px transparent .png file', 'hgr_lang'),
								'url'			=>	true,
								'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
								'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/favicon.png'),
								'hint'			=>	array(
									'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
								)
							),
							array(
								'id'			=>	'retina_favicon',
								'type'			=>	'media',
								'title'			=>	__('Retina Favicon @2x', 'redux-framework-demo'),
								'subtitle'		=>	__('Upload your retina favicon. <br>Recomended: 32px x 32px transparent .png file', 'hgr_lang'),
								'url'			=>	true,
								'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
								'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/favicon@2x.png'),
								'hint'			=>	array(
									'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
								)
							),
							array(
								'id'			=>	'iphone_icon',
								'type'			=>	'media',
								'title'			=>	__('Apple iPhone Icon', 'hgr_lang'),
								'subtitle'		=>	__('Upload your Apple iPhone icon. <br>Recomended: 60px x 60px transparent .png file', 'hgr_lang'),
								'url'			=>	true,
								'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
								'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/iphone-favicon.png'),
								'hint'			=>	array(
									'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
								)
							),
							array(
								'id'			=>	'retina_iphone_icon',
								'type'			=>	'media',
								'title'			=>	__('Apple iPhone Retina Icon @2x', 'hgr_lang'),
								'subtitle'		=>	__('Upload your Apple iPhone Retina icon. <br>Recomended: 120px x 120px transparent .png file', 'hgr_lang'),
								'url'			=>	true,
								'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
								'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/iphone-favicon@2x.png'),
								'hint'			=>	array(
									'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
								)
							),
							array(
								'id'			=>	'ipad_icon',
								'type'			=>	'media',
								'title'			=>	__('Apple iPad Icon', 'hgr_lang'),
								'subtitle'		=>	__('Upload your Apple iPad icon. <br>Recomended: 76px x 76px transparent .png file', 'hgr_lang'),
								'url'			=>	true,
								'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
								'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/ipad-favicon.png'),
								'hint'			=>	array(
									'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
								)
							),
							array(
								'id'			=>	'ipad_retina_icon',
								'type'			=>	'media',
								'title'			=>	__('Apple iPad Retina Icon @2x', 'hgr_lang'),
								'subtitle'		=>	__('Upload your Apple iPad Retina icon. <br>Recomended: 152px x 152px transparent .png file', 'hgr_lang'),
								'url'			=>	true,
								'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
								'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/ipad-favicon@2x.png'),
								'hint'			=>	array(
									'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
								)
							),
					)
				);			
				
				// COLORS SECTION
				$this->sections[] = array(
					'icon'		=>	'hgr-colors',
					'title'		=>	__('Colors', 'hgr_lang'),
					'heading'	=>	__('Color Settings', 'hgr_lang'),
					'desc'		=>	__('You can setup two color schemes: dark and light', 'hgr_lang'),
					'compiler'	=>	true,
					'fields'    => array(
							array(
								'id'			=>	'bg_color',
								'type'			=>	'color',
								'validate'		=>	'color',
								'compiler'		=>	array('body, #pagesContent'),
								'output'		=>	array('body, #pagesContent'),
								'title'			=>	__('Body Background Color', 'hgr_lang'), 
								'subtitle'		=>	__('Pick a background color for the theme.', 'hgr_lang'),
								'default'		=>	'#666666',
							),
							array(
								'id'			=>	'theme_dominant_color',
								'type'			=>	'color',
								'validate'		=>	'color',
								'compiler'		=>	array('.theme_dominant_color'),
								'output'		=>	array('.theme_dominant_color'),
								'title'			=>	__('Theme dominant color', 'hgr_lang'), 
								'subtitle'		=>	__('Pick a dominant color for the theme.', 'hgr_lang'),
								'hint'			=>	array(
									'content'	=>	'Theme dominant color its used on certain elements, for witch you do not have a specific option to define a color.',
								),
								'default'		=>	'#49e2d6',
							),
					)
				);
				
				// COLORS SECTION - Dark Color Scheme
				$this->sections[] = array(
					'icon'			=>	'hgr-colors',
					'title'			=>	__('Dark Color Scheme', 'hgr_lang'),
					'heading'		=>	__('Color Settings - Dark Color Scheme', 'hgr_lang'),
					'desc'			=>	__('You can setup two color schemes: dark and light', 'hgr_lang'),
					'subsection'	=>	true,
					'compiler'		=>	true,
					'fields'    	=>	array(
							array(
								'id'			=>	'dark-scheme-info',
								'type'			=>	'info',
								'desc'			=>	__('Color options settings for "dark" color scheme (website sections that feature a dark image or background color; a light text color is recommended for these sections).', 'hgr_lang'),
							),
							array(
								'id'			=>	'ds_text_color',
								'type'			=>	'color',
								'validate'		=>	'color',
								'compiler'		=>	array('.dark_scheme'),
								'output'		=>	array('.dark_scheme'),
								'title'			=>	__('Text color', 'hgr_lang'), 
								'subtitle'		=>	__('Pick a color for text.', 'hgr_lang'),
								'default'		=>	'#e0e0e0',
							),
							array(
								'id'			=>	'h1_color',
								'type'			=>	'color',
								'validate'		=>	'color',
								'compiler'		=>	array('.dark_scheme h1'),
								'output'		=>	array('.dark_scheme h1'),
								'title'			=>	__('H1 Color', 'hgr_lang'), 
								'subtitle'		=>	__('Pick a color for H1 tags.', 'hgr_lang'),
								'default'		=>	'#ffffff',
							),
							array(
								'id'			=>	'h2_color',
								'type'			=>	'color',
								'validate'		=>	'color',
								'compiler'		=>	array('.dark_scheme h2'),
								'output'		=>	array('.dark_scheme h2'),
								'title'			=>	__('H2 Color', 'hgr_lang'), 
								'subtitle'		=>	__('Pick a color for H2 tags.', 'hgr_lang'),
								'default'		=>	'#ffffff',
							),
							array(
								'id'			=>	'h3_color',
								'type'			=>	'color',
								'validate'		=>	'color',
								'compiler'		=>	array('.dark_scheme h3'),
								'output'		=>	array('.dark_scheme h3'),
								'title'			=>	__('H3 Color', 'hgr_lang'), 
								'subtitle'		=>	__('Pick a color for H3 tags.', 'hgr_lang'),
								'default'		=>	'#e0e0e0',
							),
							array(
								'id'			=>	'h4_color',
								'type'			=>	'color',
								'validate'		=>	'color',
								'compiler'		=>	array('.dark_scheme h4'),
								'output'		=>	array('.dark_scheme h4'),
								'title'			=>	__('H4 Color', 'hgr_lang'), 
								'subtitle'		=>	__('Pick a color for H4 tags.', 'hgr_lang'),
								'default'		=>	'#ffffff',
							),
							array(
								'id'			=>	'h5_color',
								'type'			=>	'color',
								'validate'		=>	'color',
								'compiler'		=>	array('.dark_scheme h5'),
								'output'		=>	array('.dark_scheme h5'),
								'title'			=>	__('H5 Color', 'hgr_lang'), 
								'subtitle'		=>	__('Pick a color for H5 tags.', 'hgr_lang'),
								'default'		=>	'#ffffff',
							),
							array(
								'id'			=>	'h6_color',
								'type'			=>	'color',
								'validate'		=>	'color',
								'compiler'		=>	array('.dark_scheme h6'),
								'output'		=>	array('.dark_scheme h6'),
								'title'			=>	__('H6 Color', 'hgr_lang'), 
								'subtitle'		=>	__('Pick a color for H6 tags.', 'hgr_lang'),
								'default'		=>	'#ffffff',
							),
							array(
								'id'        	=>	'ahref_color',
								'type'      	=>	'link_color',
								'compiler'		=>	array('.dark_scheme a'),
								'output'		=>	array('.dark_scheme a'),
								'title'			=>	__('Links Color', 'hgr_lang'), 
								'subtitle'		=>	__('Pick a color for links.', 'hgr_lang'),
								'desc'      	=>	__('Setup links color on regular and hovered state.', 'redux-framework-demo'),
								'regular'   	=>	true,	// Enable / Disable Regular Color
								'hover'     	=>	true,	// Enable / Disable Hover Color
								'active'    	=>	false,	// Enable / Disable Active Color
								'visited'   	=>	false,	// Enable / Disable Visited Color
								'default'   	=>	array(
									'regular'	=>	'#ffffff',
									'hover'		=>	'#49e2d6',
								)
							),
						)
				);
					
				// COLORS SECTION - Light Color Scheme
				$this->sections[] = array(
					'icon'			=>	'hgr-colors',
					'title'			=>	__('Light Color Scheme', 'hgr_lang'),
					'heading'		=>	__('Color Settings - Light Color Scheme', 'hgr_lang'),
					'desc'			=>	__('You can setup two color schemes: dark and light', 'hgr_lang'),
					'subsection'	=>	true,
					'compiler'		=>	true,
					'fields'    	=>	array(
						array(
							'id'			=>	'light-scheme-info',
							'type'			=>	'info',
							'desc'			=>	__('Color options settings for "light" color scheme (website sections that feature a light image or background color; a dark text color is recommended for these sections).', 'hgr_lang'),
						),
						array(
							'id'			=>	'ls_text_color',
							'type'			=>	'color',
							'validate'		=>	'color',
							'compiler'		=>	array('.light_scheme'),
							'output'		=>	array('.light_scheme'),
							'title'			=>	__('Text color', 'hgr_lang'), 
							'subtitle'		=>	__('Pick a color for text.', 'hgr_lang'),
							'default'		=>	'#666666',
						),
						array(
							'id'			=>	'light_h1_color',
							'type'			=>	'color',
							'validate'		=>	'color',
							'compiler'		=>	array('.light_scheme h1'),
							'output'		=>	array('.light_scheme h1'),
							'title'			=>	__('H1 Color', 'hgr_lang'), 
							'subtitle'		=>	__('Pick a color for H1 tags.', 'hgr_lang'),
							'default'		=>	'#222222',
						),
						array(
							'id'			=>	'light_h2_color',
							'type'			=>	'color',
							'validate'		=>	'color',
							'compiler'		=>	array('.light_scheme h2'),
							'output'		=>	array('.light_scheme h2'),
							'title'			=>	__('H2 Color', 'hgr_lang'), 
							'subtitle'		=>	__('Pick a color for H2 tags.', 'hgr_lang'),
							'default'		=>	'#222222',
						),
						array(
							'id'			=>	'light_h3_color',
							'type'			=>	'color',
							'validate'		=>	'color',
							'compiler'		=>	array('.light_scheme h3'),
							'output'		=>	array('.light_scheme h3'),
							'title'			=>	__('H3 Color', 'hgr_lang'), 
							'subtitle'		=>	__('Pick a color for H3 tags.', 'hgr_lang'),
							'default'		=>	'#666666',
						),
						array(
							'id'			=>	'light_h4_color',
							'type'			=>	'color',
							'validate'		=>	'color',
							'compiler'		=>	array('.light_scheme h4'),
							'output'		=>	array('.light_scheme h4'),
							'title'			=>	__('H4 Color', 'hgr_lang'), 
							'subtitle'		=>	__('Pick a color for H4 tags.', 'hgr_lang'),
							'default'		=>	'#222222',
						),
						array(
							'id'			=>	'light_h5_color',
							'type'			=>	'color',
							'validate'		=>	'color',
							'compiler'		=>	array('.light_scheme h5'),
							'output'		=>	array('.light_scheme h5'),
							'title'			=>	__('H5 Color', 'hgr_lang'), 
							'subtitle'		=>	__('Pick a color for H5 tags.', 'hgr_lang'),
							'default'		=>	'#222222',
						),
						array(
							'id'			=>	'light_h6_color',
							'type'			=>	'color',
							'validate'		=>	'color',
							'compiler'		=>	array('.light_scheme h6'),
							'output'		=>	array('.light_scheme h6'),
							'title'			=>	__('H6 Color', 'hgr_lang'), 
							'subtitle'		=>	__('Pick a color for H6 tags.', 'hgr_lang'),
							'default'		=>	'#222222',
						),
						array(
							'id'        	=>	'light_ahref_color',
							'type'      	=>	'link_color',
							'compiler'		=>	array('.light_scheme a'),
							'output'		=>	array('.light_scheme a'),
							'title'			=>	__('Links Color', 'hgr_lang'), 
							'subtitle'		=>	__('Pick a color for links.', 'hgr_lang'),
							'desc'      	=>	__('Setup links color on regular and hovered state.', 'redux-framework-demo'),
							'regular'   	=>	true,	// Enable / Disable Regular Color
							'hover'     	=>	true,	// Enable / Disable Hover Color
							'active'    	=>	false,	// Enable / Disable Active Color
							'visited'   	=>	false,	// Enable / Disable Visited Color
							'default'   	=>	array(
								'regular'	=>	'#000000',
								'hover'		=>	'#49e2d6',
							)
						),
					)
			);
				
				// TYPOGRAPHY SECTION
				$this->sections[] = array(
					'icon'		=>	'hgr-typography',
					'title'		=>	__('Typography', 'hgr_lang'),
					'heading'	=>	__('Typography Settings', 'hgr_lang'),
					'desc'		=>	__('Setup the fonts that will be used in your theme. You can choose from Standard Fonts and Google Web Fonts.', 'hgr_lang'),
					'compiler'	=>	true,
					'fields'   =>	array(
							array(
								'id'			=> 'body-font',
								'type'			=> 'typography',
								'title'			=> __('Body Font', 'redux-framework-demo'),
								'subtitle' 	=> __('Specify the body font properties.', 'redux-framework-demo'),
								'compiler'		=> array('body'),
								'output'		=> array('body'),
								'google'		=> true,
								'color'        	=> false,
								'default'		=> array(
									'font-size'			=>	'12px',
									'line-height'		=>	'22px',
									'font-family'		=>	'Open Sans',
									'font-weight'		=>	'400',
								),
							),
							array(
								'id'			=> 'h1-font',
								'type'			=> 'typography',
								'title'			=> __('H1 Font', 'hgr_lang'),
								'subtitle'		=> __('Specify the H1 font properties.', 'hgr_lang'),
								'compiler'		=> array('h1'),
								'output'		=> array('h1'),
								'google'		=> true,
								'color'       	=> false,
								'default'		=> array(
									'font-size'			=>	'48px',
									'line-height'		=>	'48px',
									'font-family'		=>	'Roboto Condensed',
									'font-weight'		=>	'300',
								),
							),
							array(
								'id'			=> 'h2-font',
								'type'			=> 'typography',
								'title'			=> __('H2 Font', 'hgr_lang'),
								'subtitle'		=> __('Specify the H2 font properties.', 'hgr_lang'),
								'compiler'		=> array('h2'),
								'output'		=> array('h2'),
								'google'		=> true,
								'color'        	=> false,
								'default'		=> array(
									'font-size'			=>	'14px',
									'line-height'		=>	'48px',
									'font-family'		=>	'Roboto Condensed',
									'font-weight'		=>	'400',
								),
							),
							array(
								'id'			=> 'h3-font',
								'type'			=> 'typography',
								'title'			=> __('H3 Font', 'hgr_lang'),
								'subtitle'		=> __('Specify the H3 font properties.', 'hgr_lang'),
								'compiler'		=> array('h3'),
								'output'		=> array('h3'),
								'google'		=> true,
								'color'			=> false,
								'default'		=> array(
									'font-size'			=>	'14px',
									'line-height'		=>	'24px',
									'font-family'		=>	'Georgia, serif',
									'font-weight'		=>	'400+italic',
								),
							),
							array(
								'id'			=> 'h4-font',
								'type'			=> 'typography',
								'title'			=> __('H4 Font', 'hgr_lang'),
								'subtitle'		=> __('Specify the H4 font properties.', 'hgr_lang'),
								'compiler'		=> array('h4'),
								'output'		=> array('h4'),
								'google'		=> true,
								'color'			=> false,
								'default'		=> array(
									'font-size'			=>	'14px',
									'line-height'		=>	'48px',
									'font-family'		=>	'Roboto Condensed',
									'font-weight'		=>	'400',
								),
							),
							array(
								'id'			=> 'h5-font',
								'type'			=> 'typography',
								'title'			=> __('H5 Font', 'hgr_lang'),
								'subtitle'		=> __('Specify the H5 font properties.', 'hgr_lang'),
								'compiler'		=> array('h5'),
								'output'		=> array('h5'),
								'google'		=> true,
								'color'			=> false,
								'default'		=> array(
									'font-size'			=>	'18px',
									'line-height'		=>	'24px',
									'font-family'		=>	'Roboto Condensed',
									'font-weight'		=>	'700',
									'text-transform'	=>	'uppercase',
								),
							),
							array(
								'id'			=> 'h6-font',
								'type'			=> 'typography',
								'title'			=> __('H6 Font', 'hgr_lang'),
								'subtitle'		=> __('Specify the H6 font properties.', 'hgr_lang'),
								'compiler'		=> array('h6'),
								'output'		=> array('h6'),
								'google'		=> true,
								'color'			=> false,
								'default'		=> array(
									'font-size'			=>	'12px',
									'line-height'		=>	'18px',
									'font-family'		=>	'Source Sans Pro',
									'font-weight'		=>	'300',
								),
							),
							
							
					)
				);
				
				// MENU SECTION
				$this->sections[] = array(
					'icon'		=>	'hgr-menu',
					'title'		=>	__('Menu', 'hgr_lang'),
					'heading'	=>	__('Menu Settings', 'hgr_lang'),
					'compiler'	=>	true,
					'fields'   =>	array(
						array(
							'id'			=>	'menu-font',
							'type'			=>	'typography',
							'title'			=>	__('Menu Font', 'hgr_lang'),
							'subtitle'		=>	__('Specify the menu font properties.', 'hgr_lang'),
							'compiler'		=>	array('.bka_menu, .bka_menu .navbar-default .navbar-nav>li>a, .dropdown-menu > li > a'),
							'output'		=>	array('.bka_menu, .bka_menu .navbar-default .navbar-nav>li>a, .dropdown-menu > li > a'),
							'google'		=>	true,
							'letter-spacing'=>	true,
							'color'			=>	false,
							'default'		=>	array(
								'font-size'			=>	'11px',
								'line-height'		=>	'24px',
								'font-family'		=>	'Roboto Condensed',
								'font-weight'		=>	'400',
								'letter-spacing'	=>	'4px',
							),
						),
						array(
							'id'        	=>	'menu-font-hover-color',
							'type'      	=>	'link_color',
							'compiler'		=>	array('.bka_menu .navbar-default .navbar-nav>li>a','.dropdown-menu>li>a'),
							'output'		=>	array('.bka_menu .navbar-default .navbar-nav>li>a','.dropdown-menu>li>a'),
							'title'			=>	__('Menu Font Color', 'hgr_lang'),
							'subtitle'		=>	__('Specify the menu font color.', 'hgr_lang'),
							'regular'   	=>	true,	// Enable / Disable Regular Color
							'hover'     	=>	true,	// Enable / Disable Hover Color
							'active'    	=>	false,	// Enable / Disable Active Color
							'visited'   	=>	false,	// Enable / Disable Visited Color
							'default'   	=>	array(
								'regular'	=>	'#000000',
								'hover'		=>	'#49e2d6',
							)
						),
						array(
							'id'			=>	'menu-style',
							'type'			=>	'switch',
							'title'			=>	__('Floating menu bar?', 'hgr_lang'),
							'subtitle'		=>	__('If "Floating", the menu is hidden and it shows only after page scrolling.', 'hgr_lang'),
							'default'		=>	'1',
							'on'			=>	'Floating',
							'off'			=>	'Static',
						),
						array(
							'id'				=>	'menu-background',
							'type'				=>	'background',
							'compiler'			=>	array('.bka_menu'),
							'output'			=>	array('.bka_menu'),
							'title'				=>	__('Menu Background', 'redux-framework-demo'),
							'subtitle'			=>	__('Menu background image (optional).', 'redux-framework-demo'),
							'preview_height'	=>	'60px',
							'background-color'	=>	false,
						),
						array(
							'id'				=> 'menu-bgcolor',
							'type'				=> 'color',
							'title'				=>	__('Top menu background color', 'hgr_lang'), 
							'subtitle'			=>	__('Set the background color for top menu', 'hgr_lang'),
							'default'			=> '#ffffff',
							'validate'			=> 'color',
                    	),
						array(
							'id'        => 'menu-border',
							'type'      => 'border',
							'title'     => __('Menu Border Option', 'redux-framework-demo'),
							'compiler'    => array('.bka_menu'),
							'output'    => array('.bka_menu'),
							'desc'      => __('Setup menu container border, in pixels (top, right, bottom, left).', 'redux-framework-demo'),
							'all'       => false,
							'default'   => array(
								'border-color'  => '#cecece', 
								'border-style'  => 'solid', 
								'border-top'    => '0px', 
								'border-right'  => '0px', 
								'border-bottom' => '0px', 
								'border-left'   => '0px',
							)
						),	
					)
				);
				
				// FOOTER SECTION
				$this->sections[] = array(
					'icon'		=>	'hgr-footer',
					'title'		=>	__('Footer', 'hgr_lang'),
					'heading'	=>	__('Footer Settings', 'hgr_lang'),
					'fields'   =>	array(
						array(
							'id'				=> 'footer-bgcolor',
							'type'				=> 'color',
							//'output'			=>	array('.bka_footer'),
							'title'				=>	__('Footer background color', 'hgr_lang'), 
							'subtitle'			=>	__('Set the background color for footer', 'hgr_lang'),
							'default'			=> '#222222',
							'validate'			=> 'color',
                    	),
						array(
							'id'				=>	'footer_color_scheme',
							'type'				=>	'select',
							'title'				=>	__('Color scheme to use on footer', 'hgr_lang'), 
							'options'			=>	array('dark_scheme' => 'Dark scheme','light_scheme' => 'Light scheme'),
							'default'			=>	'dark_scheme'
						),
						array(
							'id'				=>	'footer-copyright',
							'type'				=>	'textarea',
							'validate'			=>	'html',
							'title'				=>	__('Footer copyright text', 'hgr_lang'), 
							'subtitle'			=>	__('If empty, this section will be hidden.', 'hgr_lang'),
							'desc'				=>	__('HTML is permited', 'hgr_lang'),
							'default'			=>	'Copyright 2014 <a href="http://www.highgradelab.com">HighGrade</a>. All rights reserved.'
						),
					)
				);
				
				// PORTFOLIO SECTION
				$this->sections[] = array(
					'icon'		=>	'hgr-portfolio',
					'title'		=>	__('Portfolio', 'hgr_lang'),
					'heading'	=>	__('Portfolio Settings', 'hgr_lang'),
					'fields'   =>	array(
						array(
							'id'		=>	'portfolio-items-select',
							'type'		=>	'select',
							'title'		=>	__('Portfolio items to show', 'hgr_lang'), 
							'options'	=>	array('2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','8' => '8', '9' => '9', '10'=>'10', '12'=>'12', '16'=>'16', '18'=>'18', '20'=>'20', '24'=>'24', 'All'=>'99999', ),
							'default' 	=>	'8'
						),
						array(
							'id'		=>	'portfolio-order-by',
							'type'		=>	'select',
							'title'		=>	__('Order by', 'hgr_lang'), 
							'subtitle'	=>	__('Order portfolio items by...', 'hgr_lang'),
							'options'	=>	array('title' => 'Title', 'date' => 'Date','id' => 'ID','rand' => 'Random'),
							'default'	=>	'date'
						),
						array(
							'id'		=>	'portfolio-order',
							'type'		=>	'select',
							'title'		=>	__('Order', 'hgr_lang'), 
							'options'	=>	array('ASC' => 'Ascending','DESC' => 'Descending'),
							'default'	=>	'DESC'
						),
					)
				);
				
				// SHOP SECTION
				$this->sections[] = array(
					'icon'		=>	'hgr-layouts',
					'title'		=>	__('Shop', 'hgr_lang'),
					'heading'	=>	__('Shop Typography & Colors Settings', 'hgr_lang'),
					'compiler'	=>	true,
					'fields'   	=>	array(
						array(
							'id'			=>	'woo_support',
							'type'			=>	'switch',
							'title'			=>	__('Enable WooCommerce Support?', 'hgr_lang'),
							'subtitle'		=>	__('If "Yes", the theme offers support for WooCommerce', 'hgr_lang'),
							'default'		=>	'0',
							'on'			=>	'Yes',
							'off'			=>	'No',
						),
						array(
							'id'			=> 'shop_body_font',
							'required' 		=>	array('woo_support', "=", 1),
							'type'			=> 'typography',
							'compiler'		=>	array('body.woocommerce'),
							'output'		=>	array('body.woocommerce'),
							'title'			=>	__('Body Font for shop content', 'hgr_lang'),
							'subtitle'		=>	__('Specify the body font properties.', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#666666',
								'font-size'		=>	'12px',
								'line-height'	=>	'22px',
								'font-family'	=>	'Open Sans',
								'font-weight'	=>	'400',
							),
						),
						array(
							'id'			=> 'shop_h3_font',
							'required' 		=>	array('woo_support', "=", 1),
							'type'			=> 'typography',
							'compiler'		=>	array('.woocommerce h3'),
							'output'		=>	array('.woocommerce h3'),
							'title'			=>	__('Listing Product Title', 'hgr_lang'),
							'subtitle'		=>	__('Specify font properties for product title on the listing page.', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#000000',
								'font-size'		=>	'14px',
								'line-height'	=>	'24px',
								'font-family'	=>	'Roboto Condensed',
								'font-weight'	=>	'400',
								'letter-spacing'=>	'1px',
							),
						),
						array(
							'id'			=> 'shop_price_font',
							'required' 		=>	array('woo_support', "=", 1),
							'type'			=> 'typography',
							'compiler'		=>	array('.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .woocommerce .related ul.products li.product .price, .woocommerce #content div.product span.price, .woocommerce div.product span.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product span.price'),
							'output'		=>	array('.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .woocommerce .related ul.products li.product .price, .woocommerce #content div.product span.price, .woocommerce div.product span.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product span.price'),
							'title'			=>	__('Listing Price', 'hgr_lang'),
							'subtitle'		=>	__('Specify font properties for product price on the listing page.', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#000000',
								'font-size'		=>	'14px',
								'line-height'	=>	'24px',
								'font-family'	=>	'Roboto Condensed',
								'font-weight'	=>	'400',
							),
						),
						array(
							'id'			=> 'shop_h1_font',
							'required' 		=>	array('woo_support', "=", 1),
							'type'			=> 'typography',
							'compiler'		=>	array('.woocommerce #content div.product .product_title, .woocommerce div.product .product_title, .woocommerce-page #content div.product .product_title, .woocommerce-page div.product .product_title'),
							'output'		=>	array('.woocommerce #content div.product .product_title, .woocommerce div.product .product_title, .woocommerce-page #content div.product .product_title, .woocommerce-page div.product .product_title'),
							'title'			=>	__('Single Product Title', 'hgr_lang'),
							'subtitle'		=>	__('Specify font properties for product title on the single product page.', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#000000',
								'font-size'		=>	'48px',
								'line-height'	=>	'60px',
								'font-family'	=>	'Roboto Condensed',
								'font-weight'	=>	'300',
							),
						),
						array(
							'id'			=> 'shop_single_price_font',
							'required' 		=>	array('woo_support', "=", 1),
							'type'			=> 'typography',
							'compiler'		=>	array('.woocommerce div.product .summary span.price, .woocommerce div.product .summary p.price, .woocommerce #content div.product .summary span.price, .woocommerce #content div.product .summary p.price, .woocommerce-page div.product .summary span.price, .woocommerce-page div.product .summary p.price, .woocommerce-page #content div.product .summary span.price, .woocommerce-page #content div.product .summary p.price'),
							'output'		=>	array('.woocommerce div.product .summary span.price, .woocommerce div.product .summary p.price, .woocommerce #content div.product .summary span.price, .woocommerce #content div.product .summary p.price, .woocommerce-page div.product .summary span.price, .woocommerce-page div.product .summary p.price, .woocommerce-page #content div.product .summary span.price, .woocommerce-page #content div.product .summary p.price'),
							'title'			=>	__('Single Product Price', 'hgr_lang'),
							'subtitle'		=>	__('Specify font properties for product price on the single product page.', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#000000',
								'font-size'		=>	'30px',
								'line-height'	=>	'36px',
								'font-family'	=>	'Roboto Condensed',
								'font-weight'	=>	'400',
							),
						),
						array(
							'id'			=> 'shop_h4_font',
							'required' 		=>	array('woo_support', "=", 1),
							'type'			=> 'typography',
							'compiler'		=>	array('.woocommerce h4'),
							'output'		=>	array('.woocommerce h4'),
							'title'			=>	__('Form titles', 'hgr_lang'),
							'subtitle'		=>	__('Specify font properties for form titles (Ex: Billing address on Checkout Page).', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#000000',
								'font-size'		=>	'24px',
								'line-height'	=>	'30px',
								'font-family'	=>	'Roboto Condensed',
								'font-weight'	=>	'400',
							),
						),
						array(
							'id'        	=>	'shop_ahref_color',
							'required' 		=>	array('woo_support', "=", 1),
							'type'      	=>	'link_color',
							'compiler'		=>	array('.woocommerce a'),
							'output'		=>	array('.woocommerce a'),
							'title'			=>	__('Links Color', 'hgr_lang'), 
							'subtitle'		=>	__('Pick a color for links.', 'hgr_lang'),
							'desc'      	=>	__('Setup links color on regular and hovered state.', 'redux-framework-demo'),
							'regular'   	=>	true,	// Enable / Disable Regular Color
							'hover'     	=>	true,	// Enable / Disable Hover Color
							'active'    	=>	false,	// Enable / Disable Active Color
							'visited'   	=>	false,	// Enable / Disable Visited Color
							'default'   	=>	array(
								'regular'	=>	'#000000',
								'hover'		=>	'#49e2d6',
							)
						),
						array(
							'id'				=> 'shop_bg_color',
							'required' 			=>	array('woo_support', "=", 1),
							'type'				=> 'color',
							//'output'			=>	array('.bka_footer'),
							'title'				=>	__('Body Background Color', 'hgr_lang'), 
							'subtitle'			=>	__('Pick a background color for blog.', 'hgr_lang'),
							'default'			=> '#ffffff',
							'validate'			=> 'color',
                    	),
					)
				);
				
				// BLOG SECTION
				$this->sections[] = array(
					'icon'		=>	'hgr-blog',
					'title'		=>	__('Blog', 'hgr_lang'),
					'heading'	=>	__('Blog Settings', 'hgr_lang'),
					'compiler'	=>	true,
					'fields'   =>	array(
						array(
							'id'			=> 'blog_body_font',
							'type'			=> 'typography',
							'compiler'		=>	array('body.blog, body.single-post'),
							'output'		=>	array('body.blog, body.single-post'),
							'title'			=>	__('Body Font for blog', 'hgr_lang'),
							'subtitle'		=>	__('Specify the body font properties.', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#666666',
								'font-size'		=>	'12px',
								'line-height'	=>	'30px',
								'font-family'	=>	'Open Sans',
								'font-weight'	=>	'400',
							),
						),
						array(
							'id'			=> 'blog_h1_font',
							'type'			=> 'typography',
							'compiler'		=>	array('.blog h1, body.single-post h1'),
							'output'		=>	array('.blog h1, body.single-post h1'),
							'title'			=>	__('H1 Font', 'hgr_lang'),
							'subtitle'		=>	__('Specify the H1 font properties.', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#000000',
								'font-size'		=>	'24px',
								'line-height'	=>	'30px',
								'font-family'	=>	'Roboto Condensed',
								'font-weight'	=>	'400',
							),
						),
						array(
							'id'			=> 'blog_h2_font',
							'type'			=> 'typography',
							'compiler'		=>	array('.blog h2, body.single-post h2'),
							'output'		=>	array('.blog h2, body.single-post h2'),
							'title'			=>	__('H2 Font', 'hgr_lang'),
							'subtitle'		=>	__('Specify the H2 font properties.', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#000000',
								'font-size'		=>	'14px',
								'line-height'	=>	'24px',
								'font-family'	=>	'Roboto Condensed',
								'font-weight'	=>	'400',
							),
						),
						array(
							'id'			=> 'blog_h3_font',
							'type'			=> 'typography',
							'compiler'		=>	array('.blog h3, body.single-post h3'),
							'output'		=>	array('.blog h3, body.single-post h3'),
							'title'			=>	__('H3 Font', 'hgr_lang'),
							'subtitle'		=>	__('Specify the H3 font properties.', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#646464',
								'font-size'		=>	'22px',
								'line-height'	=>	'38px',
								'font-family'	=>	'Georgia, serif',
								'font-weight'	=>	'400+italic',
							),
						),
						array(
							'id'			=> 'blog_h4_font',
							'type'			=> 'typography',
							'compiler'		=>	array('.blog h4, body.single-post h4'),
							'output'		=>	array('.blog h4, body.single-post h4'),
							'title'			=>	__('H4 Font', 'hgr_lang'),
							'subtitle'		=>	__('Specify the H4 font properties.', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#000000',
								'font-size'		=>	'14px',
								'line-height'	=>	'24px',
								'font-family'	=>	'Roboto Condensed',
								'font-weight'	=>	'400',
							),
						),
						array(
							'id'			=> 'blog_h5_font',
							'type'			=> 'typography',
							'compiler'		=>	array('.blog h5, body.single-post h5'),
							'output'		=>	array('.blog h5, body.single-post h5'),
							'title'			=>	__('H5 Font', 'hgr_lang'),
							'subtitle'		=>	__('Specify the H5 font properties.', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#646464',
								'font-size'		=>	'46px',
								'line-height'	=>	'50px',
								'font-family'	=>	'Open Sans',
								'font-weight'	=>	'600',
							),
						),
						array(
							'id'			=> 'blog_h6_font',
							'type'			=> 'typography',
							'compiler'		=>	array('.blog h6, body.single-post h6'),
							'output'		=>	array('.blog h6, body.single-post h6'),
							'title'			=>	__('H6 Font', 'hgr_lang'),
							'subtitle'		=>	__('Specify the H6 font properties.', 'hgr_lang'),
							'google'		=>	true,
							'color'			=>	true,
							'default'		=>	array(
								'color'			=>	'#646464',
								'font-size'		=>	'16px',
								'line-height'	=>	'24px',
								'font-family'	=>	'Source Sans Pro',
								'font-weight'	=>	'300',
							),
						),
						array(
							'id'        	=>	'blog_ahref_color',
							'type'      	=>	'link_color',
							'compiler'		=>	array('.blog  a'),
							'output'		=>	array('.blog  a'),
							'title'			=>	__('Links Color', 'hgr_lang'), 
							'subtitle'		=>	__('Pick a color for links.', 'hgr_lang'),
							'desc'      	=>	__('Setup links color on regular and hovered state.', 'redux-framework-demo'),
							'regular'   	=>	true,	// Enable / Disable Regular Color
							'hover'     	=>	true,	// Enable / Disable Hover Color
							'active'    	=>	false,	// Enable / Disable Active Color
							'visited'   	=>	false,	// Enable / Disable Visited Color
							'default'   	=>	array(
								'regular'	=>	'#000000',
								'hover'		=>	'#49e2d6',
							)
						),
						array(
							'id'				=> 'blog_bg_color',
							'type'				=> 'color',
							//'output'			=>	array('.bka_footer'),
							'title'				=>	__('Body Background Color', 'hgr_lang'), 
							'subtitle'			=>	__('Pick a background color for blog.', 'hgr_lang'),
							'default'			=> '#ffffff',
							'validate'			=> 'color',
                    	),
					)
				);
				
				// CUSTOM CODE SECTION
				$this->sections[] = array(
					'icon'		=>	'hgr-custom-code',
					'title'		=>	__('Custom Code', 'hgr_lang'),
					'heading'	=>	__('Custom Code Settings', 'hgr_lang'),
					'fields'   =>	array(
						array(
							'id'        => 'tracking-code',
							'type'      => 'textarea',
							'title'     => __('Tracking Code', 'redux-framework-demo'),
							'subtitle'  => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'redux-framework-demo'),
							'validate'  => 'js',
							'desc'      => 'Validate that it\'s javascript!',
						),
						array(
							'id'        => 'css-code',
							'type'      => 'ace_editor',
							'title'     => __('CSS Code', 'redux-framework-demo'),
							'subtitle'  => __('Paste your CSS code here.', 'redux-framework-demo'),
							'mode'      => 'css',
							'theme'     => 'monokai',
							'default'   => ""
						),
						array(
							'id'        => 'js-code',
							'type'      => 'ace_editor',
							'title'     => __('JS Code', 'redux-framework-demo'),
							'subtitle'  => __('Paste your JS code here.', 'redux-framework-demo'),
							'mode'      => 'javascript',
							'theme'     => 'chrome',
							'default'   => "jQuery(document).ready(function(){\n\n});"
						),
					)
				);

				// IMPORT - EXPORT SECTION
				$this->sections[] = array(
                'title'     => __('Import / Export', 'hgr_lang'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'hgr_lang'),
                'icon'      => 'hgr-import-export',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => true,
                    ),
                ),
            );                     

        }

        public function setHelpTabs() {}

        /**
          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
					// TYPICAL -> Change these values as you need/desire
					'opt_name'          => 'redux_options',            // This is where your data is stored in the database and also becomes your global variable name.
					'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
					'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
					'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
					'menu_title'        => __('Theme Options', 'hgr_lang'),
					'page_title'        => __('Theme Options', 'hgr_lang'),
					'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
					'admin_bar'         => false,                    // Show the panel pages on the admin bar
					'dev_mode'          => false,                    // Show the time the page took to load, etc
					'customizer'        => false,                    // Enable basic customizer support
					'global_variable'   => 'hgr_options',
					// OPTIONAL -> Give you extra features
					'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
					'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
					'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
					'menu_icon'         => '',                      // Specify a custom URL to an icon
					'last_tab'          => '0',                      // Force your panel to always open to a specific tab (by id)
					'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
					'save_defaults'     => false,                    // On load save the defaults to DB before user clicks save or not
					'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
					
					// CAREFUL -> These options are for advanced use only
					'transient_time'    => 60 * MINUTE_IN_SECONDS,
					'compiler'			=> true,	
					'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
					'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
					// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
					'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
					'system_info'           => false, // REMOVE
					// HINTS
                	'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );
            	// Add content after the form.
				$this->args['footer_text']		= __('<p>Note: * near setting name means that the field has the default value.</p>', 'hgr_lang');
				$this->args['theme_logo']		= ReduxFramework::$_url . 'assets/img/theme_logo.png';
        }
    }
    global $highgradeConfig;
    $highgradeConfig = new HighGrade_Framework_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('get_hgr_options')):
    function get_hgr_options($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;
function remove_demo() {}
/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('hgr_validate_callback_function')):
    function hgr_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;