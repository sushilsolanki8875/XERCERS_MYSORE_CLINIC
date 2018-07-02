<?php
/**
 * @package 	WordPress
 * @subpackage 	Dental Clinic
 * @version 	1.0.0
 * 
 * Theme Functions
 * Created by CMSMasters
 * 
 */


/* Register CSS Styles */
function register_css_styles() {
	if (!is_admin()) {
		global $post, 
			$wp_styles;
		
		
		$cmsms_option = cmsms_get_global_options();
		
		
		wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), '1.0.0', 'screen, print');
		
		wp_enqueue_style('theme-adapt', get_template_directory_uri() . '/css/adaptive.css', array(), '1.0.0', 'screen, print');
		
		wp_enqueue_style('theme-retina', get_template_directory_uri() . '/css/retina.css', array(), '1.0.0', 'screen');
		
		
		if (is_rtl()) {
			wp_enqueue_style('theme-rtl', get_template_directory_uri() . '/css/rtl.css', array(), '1.0.0', 'screen, print');
		}
		
		
		wp_enqueue_style('theme-icons', get_template_directory_uri() . '/css/fontello.css', array(), '1.0.0', 'screen');
		
		wp_enqueue_style('theme-icons-custom', get_template_directory_uri() . '/css/fontello_custom.css', array(), '1.0.0', 'screen');
		
		wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', array(), '1.0.0', 'screen');
		
		wp_register_style('isotope', get_template_directory_uri() . '/css/jquery.isotope.css', array(), '1.5.26', 'screen');
		
		
		if ( 
			is_a($post, 'WP_Post') && 
			strpos($post->post_content, '[cmsms_portfolio ') 
		) {
			wp_enqueue_style('isotope');
		}
		
		
		// iLightBox skins
		$ilightbox_skin = $cmsms_option[CMSMS_SHORTNAME . '_ilightbox_skin'];
		
		wp_enqueue_style('ilightbox', get_template_directory_uri() . '/css/ilightbox.css', array(), '2.2.0', 'screen');
		
		wp_enqueue_style('ilightbox-skin-' . $ilightbox_skin, get_template_directory_uri() . '/css/ilightbox-skins/' . $ilightbox_skin . '-skin.css', array(), '2.2.0', 'screen');
		
		
		// Fonts and Colors styles
		if (get_option('cmsms_style_exists_' . CMSMS_SHORTNAME)) {
			$upload_dir = wp_upload_dir();
			
			
			if (preg_match('/(?i)msie [6-9]\.0/', $_SERVER['HTTP_USER_AGENT'])) {
				wp_enqueue_style('theme-fonts', $upload_dir['baseurl'] . '/cmsms_styles/' . CMSMS_SHORTNAME . '_fonts.css', array(), '1.0.0', 'screen');
				
				wp_enqueue_style('theme-schemes-primary', $upload_dir['baseurl'] . '/cmsms_styles/' . CMSMS_SHORTNAME . '_colors_primary.css', array(), '1.0.0', 'screen');
				
				wp_enqueue_style('theme-schemes-secondary', $upload_dir['baseurl'] . '/cmsms_styles/' . CMSMS_SHORTNAME . '_colors_secondary.css', array(), '1.0.0', 'screen');
			} else {
				wp_enqueue_style('theme-fonts-schemes', $upload_dir['baseurl'] . '/cmsms_styles/' . CMSMS_SHORTNAME . '.css', array(), '1.0.0', 'screen');
			}
		} else {
			$custom_css = '';
			
			$custom_css .= cmsms_theme_fonts();
			
			$custom_css .= cmsms_theme_colors_primary();
			
			$custom_css .= cmsms_theme_colors_secondary();
			
			
			wp_add_inline_style('theme-fonts-schemes', $custom_css);
		}
		
		
		wp_enqueue_style('theme-ie', get_template_directory_uri() . '/css/ie.css', array(), '1.0.0', 'screen');
		
		
		$wp_styles->add_data('theme-ie', 'conditional', 'lt IE 9');
	}
}

add_action('wp_enqueue_scripts', 'register_css_styles');



/* Register JS Scripts */
function register_js_scripts() {
	if (!is_admin()) {
		global $post;
		
		
		$cmsms_option = cmsms_get_global_options();
		
		
		// wp_enqueue_script('less', get_template_directory_uri() . '/js/less.min.js', array(), '2.0.0', false);
		
		wp_enqueue_script('libs', get_template_directory_uri() . '/js/jsLibraries.min.js', array('jquery'), '1.0.0', false);
		
		wp_enqueue_script('jLibs', get_template_directory_uri() . '/js/jqueryLibraries.min.js', array('jquery'), '1.0.0', true);
		
		wp_localize_script('jLibs', 'cmsms_jlibs', array( 
			'button_height' => 	(is_admin_bar_showing() ? 32 : 0) - ($cmsms_option[CMSMS_SHORTNAME . '_button_font_line_height'] / 2)
		));
		
		wp_enqueue_script('iLightBox', get_template_directory_uri() . '/js/jquery.iLightBox.min.js', array('jquery'), '2.2.0', false);
		
		wp_enqueue_script('script', get_template_directory_uri() . '/js/jquery.script.js', array('jquery'), '1.0.0', true);
		
		$primary_color = $cmsms_option[CMSMS_SHORTNAME . '_default_link'];
		
		wp_localize_script('script', 'cmsms_script', array( 
			'theme_url' => 							get_template_directory_uri(), 
			'site_url' => 							get_site_url() . '/', 
			'primary_color' => 						$primary_color, 
			'ilightbox_skin' => 					$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_skin'], 
			'ilightbox_path' => 					$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_path'], 
			'ilightbox_infinite' => 				$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_infinite'], 
			'ilightbox_aspect_ratio' => 			$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_aspect_ratio'], 
			'ilightbox_mobile_optimizer' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_mobile_optimizer'], 
			'ilightbox_max_scale' => 				$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_max_scale'], 
			'ilightbox_min_scale' => 				$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_min_scale'], 
			'ilightbox_inner_toolbar' => 			$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_inner_toolbar'], 
			'ilightbox_smart_recognition' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_smart_recognition'], 
			'ilightbox_fullscreen_one_slide' => 	$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_fullscreen_one_slide'], 
			'ilightbox_fullscreen_viewport' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_fullscreen_viewport'], 
			'ilightbox_controls_toolbar' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_toolbar'], 
			'ilightbox_controls_arrows' => 			$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_arrows'], 
			'ilightbox_controls_fullscreen' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_fullscreen'], 
			'ilightbox_controls_thumbnail' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_thumbnail'], 
			'ilightbox_controls_keyboard' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_keyboard'], 
			'ilightbox_controls_mousewheel' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_mousewheel'], 
			'ilightbox_controls_swipe' => 			$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_swipe'], 
			'ilightbox_controls_slideshow' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_slideshow'], 
			'ilightbox_close_text' => 				__('Close', 'dental-clinic'), 
			'ilightbox_enter_fullscreen_text' => 	__('Enter Fullscreen (Shift+Enter)', 'dental-clinic'), 
			'ilightbox_exit_fullscreen_text' => 	__('Exit Fullscreen (Shift+Enter)', 'dental-clinic'), 
			'ilightbox_slideshow_text' => 			__('Slideshow', 'dental-clinic'), 
			'ilightbox_next_text' => 				__('Next', 'dental-clinic'), 
			'ilightbox_previous_text' => 			__('Previous', 'dental-clinic'), 
			'ilightbox_load_image_error' => 		__('An error occurred when trying to load photo.', 'dental-clinic'), 
			'ilightbox_load_contents_error' => 		__('An error occurred when trying to load contents.', 'dental-clinic'), 
			'ilightbox_missing_plugin_error' => 	__("The content your are attempting to view requires the <a href='{pluginspage}' target='_blank'>{type} plugin<\/a>.", 'dental-clinic') 
		));
		
		
		wp_enqueue_script('twitter', get_template_directory_uri() . '/js/jquery.tweet.min.js', array('jquery'), '1.3.1', true);
		
		
		wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '1.5.19', true);
		
		wp_register_script('isotopeMode', get_template_directory_uri() . '/js/jquery.isotope.mode.js', array('jquery', 'isotope'), '1.0.0', true);
		
		wp_localize_script('isotopeMode', 'cmsms_isotope_mode', array( 
			'ilightbox_skin' => 					$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_skin'], 
			'ilightbox_path' => 					$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_path'], 
			'ilightbox_infinite' => 				$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_infinite'], 
			'ilightbox_aspect_ratio' => 			$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_aspect_ratio'], 
			'ilightbox_mobile_optimizer' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_mobile_optimizer'], 
			'ilightbox_max_scale' => 				$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_max_scale'], 
			'ilightbox_min_scale' => 				$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_min_scale'], 
			'ilightbox_inner_toolbar' => 			$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_inner_toolbar'], 
			'ilightbox_smart_recognition' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_smart_recognition'], 
			'ilightbox_fullscreen_one_slide' => 	$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_fullscreen_one_slide'], 
			'ilightbox_fullscreen_viewport' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_fullscreen_viewport'], 
			'ilightbox_controls_toolbar' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_toolbar'], 
			'ilightbox_controls_arrows' => 			$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_arrows'], 
			'ilightbox_controls_fullscreen' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_fullscreen'], 
			'ilightbox_controls_thumbnail' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_thumbnail'], 
			'ilightbox_controls_keyboard' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_keyboard'], 
			'ilightbox_controls_mousewheel' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_mousewheel'], 
			'ilightbox_controls_swipe' => 			$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_swipe'], 
			'ilightbox_controls_slideshow' => 		$cmsms_option[CMSMS_SHORTNAME . '_ilightbox_controls_slideshow'], 
			'ilightbox_close_text' => 				__('Close', 'dental-clinic'), 
			'ilightbox_enter_fullscreen_text' => 	__('Enter Fullscreen (Shift+Enter)', 'dental-clinic'), 
			'ilightbox_exit_fullscreen_text' => 	__('Exit Fullscreen (Shift+Enter)', 'dental-clinic'), 
			'ilightbox_slideshow_text' => 			__('Slideshow', 'dental-clinic'), 
			'ilightbox_next_text' => 				__('Next', 'dental-clinic'), 
			'ilightbox_previous_text' => 			__('Previous', 'dental-clinic'), 
			'ilightbox_load_image_error' => 		__('An error occurred when trying to load photo.', 'dental-clinic'), 
			'ilightbox_load_contents_error' => 		__('An error occurred when trying to load contents.', 'dental-clinic'), 
			'ilightbox_missing_plugin_error' => 	__("The content your are attempting to view requires the <a href='{pluginspage}' target='_blank'>{type} plugin<\/a>.", 'dental-clinic') 
		));
		
		
		if ( 
			is_a($post, 'WP_Post') && 
			strpos($post->post_content, '[cmsms_portfolio ') 
		) {
			wp_enqueue_script('isotope');
			
			wp_enqueue_script('isotopeMode');
		}
		
		
		if ( 
			is_a($post, 'WP_Post') && 
			strpos($post->post_content, '[/cmsms_google_map_markers]') 
		) {
			wp_enqueue_script('gMapAPI', '//maps.google.com/maps/api/js?sensor=false', array('jquery'), '1.0.0', true);
			
			wp_enqueue_script('gMap', get_template_directory_uri() . '/js/jquery.gMap.min.js', array('jquery', 'gMapAPI'), '3.2.0', true);
		}
	}
}

add_action('wp_enqueue_scripts', 'register_js_scripts');



/* Google Fonts Generate Function */
if (!function_exists('cmsms_theme_google_fonts_generate')) {

function cmsms_theme_google_fonts_generate() {
	$cmsms_option = cmsms_get_global_options();
	
	global $cmsms_google_font_keys;
	
	
	$cmsms_google_font_keys = array();
	
	$keys = array();
	
	$fonts = '';
	
	
	foreach (cmsms_google_fonts_list() as $key => $value) {
		if ( 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_content_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_content_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_link_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_link_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_h1_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_h1_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_h2_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_h2_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_h3_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_h3_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_h4_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_h4_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_h6_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_h6_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_button_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_button_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_small_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_small_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_input_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_input_font_google_font'] && $key != '') || 
			(isset($cmsms_option[CMSMS_SHORTNAME . '_quote_font_google_font']) && $key == $cmsms_option[CMSMS_SHORTNAME . '_quote_font_google_font'] && $key != '') 
		) {
			$keys[] = $key;
		}
	}
	
	
	foreach ($keys as $key) {
		$fonts .= $key . '|';
		
		
		$font_array = explode(':', $key);
		
		
		$cmsms_google_font_keys[] = str_replace('+', ' ', $font_array[0]);
	}
	
	
	$fonts = substr($fonts, 0, -1);
	
	
	cmsms_theme_google_font($fonts);
}

}

add_action('wp_enqueue_scripts', 'cmsms_theme_google_fonts_generate');



/* Google Fonts Enqueue Function */
if (!function_exists('cmsms_theme_google_font')) {

function cmsms_theme_google_font($fonts, $font_name = '') {
	global $cmsms_google_font_keys;
	
	
	if ( 
		$font_name == '' || 
		($font_name != '' && !in_array($font_name, $cmsms_google_font_keys)) 
	) {
		$font_id = ($font_name != '') ? '-' . str_replace(' ', '-', strtolower($font_name)) : '';
		
		$font_url = add_query_arg('family', urlencode($fonts), '//fonts.googleapis.com/css');
		
		
		wp_enqueue_style("cmsms-google-fonts{$font_id}", $font_url);
	}
}

}



/* Google Fonts Font Family Substing Generate Function */
function cmsms_get_google_font($font) {
	if ($font != '') {
		if (strpos($font, ':')) {
			$google_font_array = explode(':', $font);
			
			
			$google_font = "'" . str_replace('+', ' ', $google_font_array[0]) . "', ";
		} elseif (strpos($font, '&')) {
			$google_font_array = explode('&', $font);
			
			
			$google_font = "'" . str_replace('+', ' ', $google_font_array[0]) . "', ";
		} else {
			$google_font = "'" . str_replace('+', ' ', $font) . "', ";
		}
	} else {
		$google_font = '';
	}
	
	
	return $google_font;
}



/* Register Admin Panel Favicon */
if (!function_exists('has_site_icon') || !has_site_icon()) { 
	add_action('admin_head', 'cmsms_favicon');
}



/* Register Default Theme Sidebars */
function the_widgets_init() {
    if (!function_exists('register_sidebars')) {
        return;
    }
    
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'dental-clinic'), 
            'id' => 'sidebar_default', 
            'description' => esc_html__('Widgets in this area will be shown in all left and right sidebars till you don\'t use custom sidebar.', 'dental-clinic'), 
            'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h3 class="widgettitle">', 
            'after_title' => '</h3>'
        )
    );
    
    register_sidebar(
        array(
           'name' => esc_html__('Bottom Sidebar', 'dental-clinic'), 
            'id' => 'sidebar_bottom', 
            'description' => esc_html__('Widgets in this area will be shown at the bottom of middle block below the content and middle sidebar, but above footer.', 'dental-clinic'), 
            'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h3 class="widgettitle">', 
            'after_title' => '</h3>'
        )
    );
    
    register_sidebar(
        array(
           'name' => esc_html__('Archive Sidebar', 'dental-clinic'), 
            'id' => 'sidebar_archive', 
            'description' => esc_html__('Widgets in this area will be shown in all left and right sidebars on archives pages.', 'dental-clinic'), 
            'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h3 class="widgettitle">', 
            'after_title' => '</h3>'
        )
    );
    
    register_sidebar(
        array(
            'name' => esc_html__('Search Sidebar', 'dental-clinic'), 
            'id' => 'sidebar_search', 
            'description' => esc_html__('Widgets in this area will be shown in left or right sidebar on search page.', 'dental-clinic'), 
            'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
            'after_widget' => '</aside>', 
            'before_title' => '<h3 class="widgettitle">', 
            'after_title' => '</h3>'
        )
    );
	
	
	$cmsms_option = cmsms_get_global_options();
	
	
	if (isset($cmsms_option[CMSMS_SHORTNAME . '_sidebar']) && sizeof($cmsms_option[CMSMS_SHORTNAME . '_sidebar']) > 0) {
		foreach ($cmsms_option[CMSMS_SHORTNAME . '_sidebar'] as $sidebar) {
			register_sidebar(array( 
				'name' => $sidebar, 
				'id' => generateSlug($sidebar, 45), 
				'description' => esc_html__('Custom sidebar created with cmsmasters admin panel.', 'dental-clinic'), 
				'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
				'after_widget' => '</aside>', 
				'before_title' => '<h3 class="widgettitle">', 
				'after_title' => '</h3>' 
			) );
		}
	}
}

add_action('widgets_init', 'the_widgets_init');



/* Register Theme Navigations */
register_nav_menus(array( 
    'primary' => 	esc_html__('Primary Navigation', 'dental-clinic'), 
    'footer' => 	esc_html__('Footer Navigation', 'dental-clinic'), 
	'top_line' => 	esc_html__('Top Line Navigation', 'dental-clinic') 
));



/* Register Showing Home Page on Default Wordpress Pages Menu */
function cmsmasters_page_menu_args($args) {
    $args['show_home'] = true;
    
	
    return $args;
}

add_filter('wp_page_menu_args', 'cmsmasters_page_menu_args');



/* Register Showing Home Page on Default Wordpress Pages Menu */
function cmsms_custom_mega_menu_item_output($args) {
	$shcd_args = $args['args'];
	
	$shcd_attrs = $args['attrs'];
	
	$shcd_depth = $args['depth'];
	
	$shcd_item = $args['item'];
	
	$shcd_cols_count = $args['cols_count'];
	
	
	$item_output = '';
	
	
	if (!empty($shcd_item->color)) {
		$item_output .= '<style type="text/css"> ' . 
			'#header #navigation > .menu-item-' . $shcd_item->ID . ':hover > a, ' . 
			'#header #navigation .menu-item-' . $shcd_item->ID . ' > a:hover, ' . 
			'#header #navigation .menu-item-' . $shcd_item->ID . '.current-menu-parent > a, ' . 
			'#header #navigation .menu-item-' . $shcd_item->ID . '.current-menu-item > a, ' . 
			'#header #navigation .menu-item-' . $shcd_item->ID . '.menu-item-highlight > a { ' . 
				(($shcd_depth > 1 || ($shcd_depth == 1 && $shcd_cols_count == NULL)) ? 'background-' : '') . 'color:' . $shcd_item->color . ';' . 
			' } ';
		
		
		if ( 
			$shcd_depth == 0 || 
			($shcd_depth == 1 && $shcd_cols_count != NULL) 
		) {
			$item_output .= '#navigation > .menu-item-' . $shcd_item->ID . ':hover > a[data-tag]:before, ' . 
			'#header #navigation .menu-item-' . $shcd_item->ID . ' > a[data-tag]:hover:before, ' . 
			'#header #navigation .menu-item-' . $shcd_item->ID . '.current-menu-parent > a[data-tag]:before, ' . 
			'#header #navigation .menu-item-' . $shcd_item->ID . '.current-menu-item > a[data-tag]:before, ' . 
			'#header #navigation .menu-item-' . $shcd_item->ID . '.menu-item-highlight > a[data-tag]:before { ' . 
				'background-color:' . $shcd_item->color . ';' . 
			' } ';
		}
		
		
		$item_output .= '</style>';
	}
	
	
	$item_output .= $shcd_args->before . 
		'<a' . $shcd_attrs;
	
	
	if (!empty($shcd_item->tag)) {
		$item_output .= ' data-tag="' . esc_attr($shcd_item->tag) . '"';
	}
	
	
	$item_output .= '>';
	
	
	if ($shcd_depth == 0) {
		$item_output .= '<span class="nav_bg_clr"';
		
		
		if (!empty($shcd_item->color)) {
			$item_output .= ' style="background-color:' . $shcd_item->color . ';"';
		}
		
		$item_output .= '></span>';
	}
	
	
	$item_output .= $shcd_args->link_before;
	
	
	if ( 
		($shcd_depth <= 1 && empty($shcd_item->hide_text)) || 
		($shcd_depth == 0 && !empty($shcd_item->hide_text) && !empty($shcd_item->icon)) || 
		($shcd_depth == 1 && $shcd_cols_count == NULL && !empty($shcd_item->hide_text)) || 
		($shcd_depth == 1 && $shcd_cols_count != NULL && !empty($shcd_item->hide_text) && !empty($shcd_item->icon)) || 
		($shcd_depth > 1) 
	) {
		$item_output .= '<span';
		
		
		if (!empty($shcd_item->icon)) {
			$item_output .= ' class="' . $shcd_item->icon . '"';
		}
		
		
		$item_output .= '>' . 
			apply_filters('the_title', $shcd_item->title, $shcd_item->ID);
		
		
		if ( 
			($shcd_depth == 0 && !empty($shcd_item->subtitle)) || 
			($shcd_depth == 1 && $shcd_cols_count != NULL && !empty($shcd_item->subtitle)) 
		) {
			$item_output .= '<span class="nav_subtitle">' . 
				$shcd_item->subtitle . 
			'</span>';
		}
		
		
		$item_output .= '</span>';
	}
	
	
	$item_output .= $shcd_args->link_after . 
		'</a>' . 
	$shcd_args->after;
	
	
	return $item_output;
}

add_filter('cmsms_mega_item_output', 'cmsms_custom_mega_menu_item_output');



/* Register wp_nav_menu() Fallback Function */
function cmsms_fallback_menu($args) {
	echo '<div class="navigation_wrap">' . "\n" . 
		'<ul id="navigation">' . "\n";
	
	
	wp_list_pages(array( 
		'title_li' => '', 
		'link_before' => '<span class="nav_bg_clr"></span><span>', 
		'link_after' => '</span>' 
	));
	
	
	echo '</ul>' . "\r" . 
	'</div>' . "\n";
}



/* Register Post Formats, Feed Links, Post Thumbnails and Set Image Sizes*/
if (function_exists('add_theme_support')) {
	add_theme_support('post-formats', array( 
		'aside', 
		'quote', 
		'link', 
		'image', 
		'gallery', 
		'video', 
		'audio', 
		'status', 
		'chat' 
	));
	
	
	function add_post_type_support_project($post) {
		$screen = get_current_screen();
		
		$post_type = $screen->post_type;
		
		
		if ($post_type == 'project') {
			add_theme_support('post-formats', array( 
				'gallery', 
				'video' 
			));
		}
	}
	
	add_action('load-post.php', 'add_post_type_support_project');
	
	add_action('load-post-new.php', 'add_post_type_support_project');
	
	
	add_theme_support('post-thumbnails');
	
	
	add_theme_support('title-tag');
	
	
	add_theme_support('automatic-feed-links');
	
	
	add_theme_support('html5', array( 
		'comment-list', 
		'comment-form', 
		'search-form', 
		'gallery', 
		'caption' 
	));
	
	
	$thumbnail_list = cmsms_image_thumbnail_list();
	
	
	if (!isset($content_width)) {
		$content_width = $thumbnail_list['full-thumb']['width'];
	}
	
	
	set_post_thumbnail_size($thumbnail_list['post-thumbnail']['width'], $thumbnail_list['post-thumbnail']['height'], $thumbnail_list['post-thumbnail']['crop']);
	
	
	if (function_exists('add_image_size')) {
		foreach ($thumbnail_list as $key => $image_size) {
			if ($key != 'post-thumbnail') {
				add_image_size($key, $image_size['width'], $image_size['height'], (isset($image_size['crop']) ? isset($image_size['crop']) : false));
			}
		}
	}
	
	
	add_filter('image_size_names_choose', 'cmsms_select_image_size');
}



/* Add Image Thumbnails Size to the List */
function cmsms_select_image_size($sizes) {
	$thumbnail_list = cmsms_image_thumbnail_list();
	
	
	$new_sizes = array();
	
	
	foreach ($thumbnail_list as $key => $image_size) {
		if (isset($image_size['title'])) {
			$new_sizes[$key] = $image_size['title'];
		}
	}
	
	
	$sizes = array_merge($sizes, $new_sizes);
	
	
	return $sizes;
}



/* Register Visual Content Editor CSS Stylesheet */
function cmsms_add_editor_styles() {
	add_editor_style('framework/admin/inc/css/custom-editor-style.css');
	
	
	add_editor_style('//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext');
}

add_action('init', 'cmsms_add_editor_styles');



/* Register Shortcodes for Excerpts and Widgets */
add_filter('the_excerpt', 'do_shortcode');

add_filter('widget_text', 'do_shortcode');



/* Register Removing 'More Text' From Excerpt */
function new_excerpt_more($more) {
	return '...';
}

add_filter('excerpt_more', 'new_excerpt_more');



/* Register Custom Excerpt Length Function */
class Excerpt {
	var $length = 55;
	
	function __construct($length) {
		$this->length = $length;
		
		add_filter('excerpt_length', array($this, 'new_length'), 999);
	}
	
	public function new_length() {
		return $this->length;
	}
	
	function output() {
		the_excerpt();
	}
	
	function return_out() {
		return get_the_excerpt();
	}
}

function theme_excerpt($length = 55, $show = true) {
	if ($show) {
		$result = new Excerpt($length);
		
		$result->output();
	} else {
		$result = new Excerpt($length);
		
		return $result->return_out();
	}
}



/* Register Post Types in Author & Date Archive */
function cmsms_post_author_archive($query) {
	if (isset($query) && !is_admin() && ($query->is_author || $query->is_date)) {
		$query->set('post_type', array( 
			'post', 
			'project', 
			'profile' 
		));
	}
	
	
	return $query;
}

add_action('pre_get_posts', 'cmsms_post_author_archive');



/* Register Removing 'p' Tags that Wrap Rows */
function cmsms_rowpdel($content) {
    $content = str_replace('[/cmsms_row]</p>', '[/cmsms_row]', $content);
    $content = str_replace('<p>[cmsms_row', '[cmsms_row', $content);
	
	
    return $content;
}

add_filter('the_content', 'cmsms_rowpdel');



/* Register Removing 'p' Tags that Wrap Divs */
function cmsms_divpdel($content) {
	$block = '(address|article|aside|audio|blockquote|canvas|dd|div|dl|fieldset|figcaption|figure|footer|form|h1|h2|h3|h4|h5|h6|header|hgroup|hr|noscript|ol|output|pre|section|table|tfoot|ul|video|style|iframe)';
	
	
	$content = preg_replace('/^<\/p>/', '', $content);
	$content = preg_replace('/<p>$/', '', $content);
	$content = preg_replace('/<\/' . $block . '>(\s*)<\/p>/', '</\1>', $content);
	$content = preg_replace('/<' . $block . '([^>]+)>(\s+)<\/p>/', '<\1\2>', $content);
	$content = preg_replace('/<p>\s+<' . $block . '([^>]+)>/', '<\1\2>', $content);
	$content = preg_replace('/<p>\s+<\/' . $block . '>/', '</\1>', $content);
	$content = preg_replace('/<p><' . $block . '/', '<\1', $content);
	$content = preg_replace('/(<a\shref="[^"]*"\sid="[^"]*"\sclass="button[^"]*"[^>]*>[^<]+<\/a>\s*)<\/p>/', '\1', $content);
	
	
    return $content;
}



/* Unregister PayPal Donations Widget */
if (CMSMS_PAYPALDONATIONS) {
	
	function unregister_paypaldonations_widget() {
		unregister_widget('PayPalDonations_Widget');
	}

	add_action('widgets_init', 'unregister_paypaldonations_widget');
}



/* Generate Slug Function */
function generateSlug($phrase, $maxLength) {
	$result = strtolower($phrase);
	
	
	$result = preg_replace("/[^a-z0-9\s-]/", "", $result);
	$result = trim(preg_replace("/[\s-]+/", " ", $result));
	$result = trim(substr($result, 0, $maxLength));
	$result = preg_replace("/\s/", "-", $result);
	
	
	return $result;
}



/* Add Icons List to Database */
function cmsms_add_global_icons() {
	$file = 'file_';
	
	$file_gc = $file . 'get_contents';
	
	
	$icons = $file_gc(CMSMS_ADMIN . '/inc/fonts/config.json');
	
	$icons_custom = $file_gc(CMSMS_ADMIN . '/inc/fonts/config_custom.json');
	
	
	$arr = json_decode($icons, true);
	
	$arr_custom = json_decode($icons_custom, true);
	
	
	if (get_option('cmsms_' . CMSMS_SHORTNAME . '_icons')) {
		update_option('cmsms_' . CMSMS_SHORTNAME . '_icons', serialize($arr));
	} else {
		add_option('cmsms_' . CMSMS_SHORTNAME . '_icons', serialize($arr), '', 'yes');
	}
	
	
	if (get_option('cmsms_' . CMSMS_SHORTNAME . '_icons_custom')) {
		update_option('cmsms_' . CMSMS_SHORTNAME . '_icons_custom', serialize($arr_custom));
	} else {
		add_option('cmsms_' . CMSMS_SHORTNAME . '_icons_custom', serialize($arr_custom), '', 'yes');
	}
}



/* Generate Icons List */
function cmsms_composer_icons() {
	$icons = get_option('cmsms_' . CMSMS_SHORTNAME . '_icons');
	
	$icons_custom = get_option('cmsms_' . CMSMS_SHORTNAME . '_icons_custom');
	
	
	$arr = unserialize($icons);
	
	$arr_custom = unserialize($icons_custom);
	
	
	$new_icons = '';
	
	
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsms_composer_icons() { ' . "\n\t\t" . 
			'return { ' . "\n\t\t\t";
	
	
	foreach ($arr_custom['glyphs'] as $item) {
		if ($new_icons != $item['src']) {
			if ($new_icons != '') {
				$out = substr($out, 0, -4);
				
				$out .= ' ' . "\n\t\t\t" . '}, ' . "\n\t\t\t";
			}
			
			
			$out .= "'" . $item['src'] . "' : { \n\t";
			
			
			$new_icons = $item['src'];
		}
		
		
		$out .= "\t\t\t'" . $item['css'] . "' : '" . $arr_custom['css_prefix_text'] . $item['css'] . "', \n\t";
	}
	
	
	foreach ($arr['glyphs'] as $item) {
		if ($new_icons != $item['src']) {
			if ($new_icons != '') {
				$out = substr($out, 0, -4);
				
				$out .= ' ' . "\n\t\t\t" . '}, ' . "\n\t\t\t";
			}
			
			
			$out .= "'" . $item['src'] . "' : { \n\t";
			
			
			$new_icons = $item['src'];
		}
		
		
		$out .= "\t\t\t'" . $item['css'] . "' : '" . $arr['css_prefix_text'] . $item['css'] . "', \n\t";
	}
	
	
	$out = substr($out, 0, -4);
	
	$out .= ' ' . "\n\t\t\t" . '} ' . "\n\t\t" . 
			'}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}



/* Generate CSS Rules */
function cmsms_color_css($rule, $color) {
	return $rule . ':' . $color . ';';
}



/* Generate RGB from HEX/RGBA Color */
function color2rgb($color) {
	return (preg_match('/^#[a-f0-9]{3}$/i', $color) || preg_match('/^#[a-f0-9]{6}$/i', $color)) ? hex2rgb($color) : rgba2rgb($color);
}



/* Generate RGB Color from HEX */
function hex2rgb($color) {
	$new_color = substr($color, 1);
	
	$color_len = strlen($new_color);
	
	
	$result = '';
	
	
	if ($color_len == 6) {
		$rgb = str_split($new_color, 2);
	} elseif ($color_len == 3) {
		$rgb = str_split($new_color, 1);
	}
	
	
	foreach ($rgb as $number) {
		$result .= hexdec((strlen($number) == 2) ? $number : $number . $number) . ', ';
	}
	
	
	$rgb_color = substr($result, 0, -2);
	
	
	return $rgb_color;
}



/* Generate HEX Color from RGB */
function rgb2hex($rgb) {
	$newRGBs = explode(',', $rgb);
	
	
	$r = trim($newRGBs[0]);
	$g = trim($newRGBs[1]);
	$b = trim($newRGBs[2]);
	
	
	$hex_color = '#' . dechex($r) . dechex($g) . dechex($b);
	
	
	return $hex_color;
}



/* Generate RGB Color from RGBA */
function rgba2rgb($rgba) {
	$newRGBAs = explode(',', $rgba);
	
	$r = trim(substr($newRGBAs[0], 5));
	$g = trim($newRGBAs[1]);
	$b = trim($newRGBAs[2]);
	
	
	$rgb_color = "rgb({$r}, {$g}, {$b})";
	
	
	return $rgb_color;
}



/* Generate HSL Color from RGB */
function rgb2hsl($rgb) {
	$newRGBs = explode(',', $rgb);
	
	
	$r = trim($newRGBs[0]);
	$g = trim($newRGBs[1]);
	$b = trim($newRGBs[2]);
	
	
	$oldR = $r;
	$oldG = $g;
	$oldB = $b;
	
	
	$r /= 255;
	$g /= 255;
	$b /= 255;
	
	
	$max = max($r, $g, $b);
	$min = min($r, $g, $b);
	
	
	$h;
	$s;
	
	
	$l = ($max + $min) / 2;
	$d = $max - $min;
	
	
	if ($d == 0) {
		$h = $s = 0;
	} else {
		$s = $d / (1 - abs(2 * $l - 1));
		
		
		switch ($max) {
		case $r:
			$h = 60 * fmod((($g - $b) / $d), 6);
			
			
			if ($b > $g) {
				$h += 360;
			}
			
			
			break;
		case $g:
			$h = 60 * (($b - $r) / $d + 2);
			
			
			break;
		case $b:
			$h = 60 * (($r - $g) / $d + 4);
			
			
			break;
		}
	}
	
	
	return array(round($h, 2), round($s, 2), round($l, 2));
}



/* Generate RGB Color from HSL */
function hsl2rgb($h, $s, $l) {
	$r;
	$g;
	$b;
	
	
	$c = (1 - abs(2 * $l - 1)) * $s;
	$x = $c * (1 - abs(fmod(($h / 60), 2) - 1));
	$m = $l - ($c / 2);
	
	
	if ($h < 60) {
		$r = $c;
		$g = $x;
		$b = 0;
	} else if ($h < 120) {
		$r = $x;
		$g = $c;
		$b = 0;	
	} else if ($h < 180) {
		$r = 0;
		$g = $c;
		$b = $x;	
	} else if ($h < 240) {
		$r = 0;
		$g = $x;
		$b = $c;
	} else if ($h < 300) {
		$r = $x;
		$g = 0;
		$b = $c;
	} else {
		$r = $c;
		$g = 0;
		$b = $x;
	}
	
	
	$r = ($r + $m) * 255;
	$g = ($g + $m) * 255;
	$b = ($b + $m) * 255;
	
	
	return floor($r) . ', ' . floor($g) . ', ' . floor($b);
}



/* Convert Embedded Video URL Function */
function embedConvert($url) {
	if (str_replace('youtube', '', $url) !== $url) {
		parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
		
		$result = 'http://www.youtube.com/embed/' . $my_array_of_vars['v'] . '?autoplay=1&autohide=1&border=0&egm=0&showinfo=0';
	} elseif (str_replace('vimeo', '', $url) !== $url) {
		$video_id = substr(parse_url($url, PHP_URL_PATH), 1);
		
		$result = 'http://player.vimeo.com/video/' . $video_id . '?autoplay=1';
	} else {
		$result = '';
	}
	
	
	return $result;
}



/* Return of get_template_part() */
function load_template_part($template_name, $part_name = null) {
    ob_start();
	
	
    get_template_part($template_name, $part_name);
	
	
    $out = ob_get_contents();
	
	
    ob_end_clean();
	
	
    return $out;
}



/* Return of get_template_part() File Function */
function return_template_part($post_format = 'standard', $post_layout = 'default', $post_page = 'page', $post_type = 'blog') {
    get_template_part('framework/postType/' . $post_type . '/' . (($post_page) ? $post_page . '/' : '') . (($post_layout) ? $post_layout . '/' : '') . $post_format);
	
	
	$out = $post_type . '_' . (($post_page) ? $post_page . '_' : '') . (($post_layout) ? $post_layout . '_' : '') . $post_format;
	
	
	return $out();
}



/* Regenerate Custom Styles Function */
function cmsms_regenerate_styles() {
	$custom_css_fonts = cmsms_theme_fonts();
	
	$custom_css_colors_primary = cmsms_theme_colors_primary();
	
	$custom_css_colors_secondary = cmsms_theme_colors_secondary();
	
	
	$custom_css = $custom_css_fonts . $custom_css_colors_primary . $custom_css_colors_secondary;
	
	
	cmsms_write_styles($custom_css_fonts, CMSMS_SHORTNAME . '_fonts');
	
	cmsms_write_styles($custom_css_colors_primary, CMSMS_SHORTNAME . '_colors_primary');
	
	cmsms_write_styles($custom_css_colors_secondary, CMSMS_SHORTNAME . '_colors_secondary');
	
	
	cmsms_write_styles($custom_css);
}



/* Write Custom Styles to File Function */
function cmsms_write_styles($styles, $filename = '') {
	$upload_dir = wp_upload_dir();
	
	
	$style_dir = str_replace('\\', '/', $upload_dir['basedir'] . '/cmsms_styles');
	
	
	$is_dir = cmsms_create_folder($style_dir);
	
	
	if ($is_dir === false) {
		update_option('cmsms_style_dir_writable_' . CMSMS_SHORTNAME, 'false');
		
		update_option('cmsms_style_exists_' . CMSMS_SHORTNAME, 'false');
		
		
		return;
	}
	
	
	$file = trailingslashit($style_dir) . (($filename != '') ? $filename : CMSMS_SHORTNAME) . '.css';
	
	
	$created = cmsms_create_file($file, $styles);
	
	
	if ($created === true) {
		update_option('cmsms_style_dir_writable_' . CMSMS_SHORTNAME, 'true');
		
		update_option('cmsms_style_exists_' . CMSMS_SHORTNAME, 'true');
	}
}



/* Create Folder Function */
function cmsms_create_folder(&$folder, $addindex = true) {
	$f = 'f';
	
	$f_o = $f . 'open';
	
	$f_w = $f . 'write';
	
	$f_c = $f . 'close';
	
	
	if (is_dir($folder) && $addindex == false) {
		return true;
	}
	
	
	$created = wp_mkdir_p(trailingslashit($folder));
	
	
	@chmod($folder, 0755);
	
	
	if ($addindex == false) {
		return $created;
	}
	
	
	$index_file = trailingslashit($folder) . 'index.php';
	
	
	if (file_exists($index_file)) {
		return $created;
	}
	
	
	$handle = @$f_o($index_file, 'w');
	
	
	if ($handle) {
		$f_w($handle, "<?php\n// Silence is golden.\n");
		
		
		$f_c($handle);
	}
	
	
	return $created;
}



/* Create File Function */
function cmsms_create_file($file, $content = '', $verifycontent = true) {

	$f = 'f';
	
	$f_o = $f . 'open';
	
	$f_r = $f . 'read';
	
	$f_w = $f . 'write';
	
	$f_c = $f . 'close';
	
	
	$handle = @$f_o($file, 'w');
	
	
	if ($handle) {
		$created = $f_w($handle, $content);
		
		
		$f_c($handle);
		
		
		if ($verifycontent === true) {
			$handle = $f_o($file, 'r');
			
			
			$filecontent = $f_r($handle, filesize($file));
			
			
			$created = ($filecontent == $content) ? true : false;
			
			
			$f_c($handle);
		}
	} else {
		$created = false;
	}
	
	
	if ($created !== false) {
		$created = true;
	}
	
	
	return $created;
}



/* Post Format Chat Converter WP 3.6 beta */
if (!function_exists('add_chat_detection_format')) {
	function add_chat_detection_format( $name, $newline_regex, $delimiter_regex ) {
		global $_wp_chat_parsers;

		if ( empty( $_wp_chat_parsers ) )
			$_wp_chat_parsers = array();

		$_wp_chat_parsers = array( $name => array( $newline_regex, $delimiter_regex ) ) + $_wp_chat_parsers;
	}
	add_chat_detection_format( 'IM', '#^([^:]+):#', '#[:]#' );
	add_chat_detection_format( 'Skype', '#^\[(.+?)\]\s([^:]+):#', '#[:]#' );
}

if (!function_exists('get_content_chat')) {
	function get_content_chat( &$content, $remove = false ) {
		global $_wp_chat_parsers;

		$trimmed = trim( $content );
		if ( empty( $trimmed ) )
			return array();

		$matched_parser = false;
		foreach ( $_wp_chat_parsers as $parser ) {
			@list( $newline_regex, $delimiter_regex ) = $parser;
			if ( preg_match( $newline_regex, $trimmed ) ) {
				$matched_parser = $parser;
				break;
			}
		}

		if ( false === $matched_parser )
			return array();

		$last_index = 0;
		$stanzas = $data = $stanza = array();
		$author = $time = '';
		$lines = explode( "\n", make_clickable( $trimmed ) );


		foreach ( $lines as $index => $line ) {
			$line = trim( $line );

			if ( empty( $line ) ) {
				if ( ! empty( $author ) ) {
					$stanza[] = array(
						'time'    => $time,
						'author'  => $author,
						'message' => join( ' ', $data )
					);
				}

				$stanzas[] = $stanza;
				$last_index = $index;
				$stanza = $data = array();
				$author = $time = '';
				if ( ! empty( $lines[$index + 1] ) && ! preg_match( $delimiter_regex, $lines[$index + 1] ) )
					break;
				else
					continue;
			}

			$matches = array();
			$matched = preg_match( $newline_regex, $line, $matches );
			$author_match = empty( $matches[2] ) ? $matches[1] : $matches[2];
			$no_ws = $matched && ! preg_match( '#\s#', $author_match );
			$has_ws = $matched && preg_match( '#\s#', $author_match ) && empty( $lines[$index + 1] ) && empty( $lines[$index - 1] );
			if ( $matched && ( ! empty( $matches[2] ) || ( $no_ws || $has_ws ) ) ) {
				if ( ! empty( $author ) ) {
					$stanza[] = array(
						'time'    => $time,
						'author'  => $author,
						'message' => join( ' ', $data )
					);
					$data = array();
				}

				$time = empty( $matches[2] ) ? '' : $matches[1];
				$author = $author_match;
				$data[] = trim( str_replace( $matches[0], '', $line ) );
			} elseif ( preg_match( '#\S#', $line ) ) {
				$data[] = $line;
			}
		}

		if ( ! empty( $author ) ) {
			$stanza[] = array(
				'time'    => $time,
				'author'  => $author,
				'message' => trim( join( ' ', $data ) )
			);
		}

		if ( ! empty( $stanza ) )
			$stanzas[] = $stanza;

		if ( $remove )
			$content = trim( join( "\n", array_slice( $lines, $last_index ) ) );

		return $stanzas;
	}
}

if (!function_exists('get_the_post_format_chat')) {
	function get_the_post_format_chat( $id = 0 ) {
		$post = empty( $id ) ? get_post() : get_post( $id );
		
		if ( empty( $post ) )
			return array();
		
		$custom_chat = get_post_meta($post->ID, 'cmsms_post_chat_text', true);
		
		if ($custom_chat != '') {
			$data = get_content_chat( $custom_chat );
		} else {
			$data = get_content_chat( $post->post_content );
		}
		
		if ( empty( $data ) )
			return array();

		return $data;
	}
}



/* Twitter Shortcode Function */
function cmsms_get_tweets($username, $count) {
	$cmsms_option = cmsms_get_global_options();
	
	
	load_template(CMSMS_CLASS . '/OAuth.php', true);
	
	
	$excludeReplies = 1;
	$name = $username;
	$numTweets = $count;
	$cacheTime = 1;
	$backupName = 'cmsms_' . CMSMS_SHORTNAME . '_tweets_list_backup';
	
	
	$connection = new TwitterOAuth( 
		(($cmsms_option[CMSMS_SHORTNAME . '_api_key'] != '') ? $cmsms_option[CMSMS_SHORTNAME . '_api_key'] : ''), 
		(($cmsms_option[CMSMS_SHORTNAME . '_api_secret'] != '') ? $cmsms_option[CMSMS_SHORTNAME . '_api_secret'] : ''), 
		(($cmsms_option[CMSMS_SHORTNAME . '_access_token'] != '') ? $cmsms_option[CMSMS_SHORTNAME . '_access_token'] : ''), 
		(($cmsms_option[CMSMS_SHORTNAME . '_access_token_secret'] != '') ? $cmsms_option[CMSMS_SHORTNAME . '_access_token_secret'] : '')
	);
	
	
	$totalToFetch = ($excludeReplies) ? max(50, $numTweets * 3) : $numTweets;
	
	
	$fetchedTweets = $connection->get( 
		'https://api.twitter.com/1.1/statuses/user_timeline.json', 
		array( 
			'screen_name' => $name, 
			'count' => $totalToFetch,
			'exclude_replies' => true 
		) 
	);
	
	
	if ($connection->http_code != 200) {
		$tweets = get_option($backupName);
	} else {
		$limitToDisplay = min($numTweets, count($fetchedTweets));
		
		
		for ($i = 0; $i < $limitToDisplay; $i++) {
			$tweet = $fetchedTweets[$i];
			
			$name = $tweet->user->name;
			
			$permalink = 'http://twitter.com/' . $name . '/status/' . $tweet->id_str;
			
			$image = $tweet->user->profile_image_url;
			
			$pattern = '/(http|https):(\S)+/';
			
			$replace = '<a href="${0}" target="_blank" rel="nofollow">${0}</a>';
			
			$text = preg_replace($pattern, $replace, $tweet->text);
			
			$time = $tweet->created_at;
			$time = date_parse($time);
			
			$uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);
			
			
			$tweets[] = array( 
				'text' => $text, 
				'name' => $name, 
				'permalink' => $permalink, 
				'image' => $image, 
				'time' => $uTime 
			);
		}
		
		
		update_option($backupName, $tweets);
	}
	
	
	return $tweets;
}



/* Default Sidebar Content Function */
function sidebarDefaultText() {
	echo '<aside class="widget widget_search">' . "\n";
	
	
	get_search_form();

	
	echo '</aside>' . "\n" . 
	'<aside id="archives" class="widget widget_archive">' . "\n" . 
		'<h3 class="widgettitle">' . esc_html__('Archives', 'dental-clinic') . '</h3>' . "\n" . 
		'<ul>' . "\n";
	
	
	wp_get_archives(array( 
		'type' => 'monthly' 
	));
	
	
	echo '</ul>' . "\n" . 
	'</aside>' . "\n" . 
	'<aside id="meta" class="widget widget_meta">' . "\n" . 
		'<h3 class="widgettitle">' . esc_html__('Meta', 'dental-clinic') . '</h3>' . "\n" . 
		'<ul>' . "\n\t";
	
	
	wp_register();
	
	
	echo "\n\t" . '<li>';
	
	
	wp_loginout();
	
	
	echo '</li>' . "\n\t";
	
	
	wp_meta();
	
	
	echo '<li>' . 
		'<a href="';
	
	
	bloginfo('rss2_url');
	
	
	echo '" title="' . esc_attr__('Syndicate this site using RSS 2.0', 'dental-clinic') . '">' . esc_html__('Entries', 'dental-clinic') . ' ' . 
			'<abbr title="' . esc_attr__('Really Simple Syndication', 'dental-clinic') . '">' . esc_html__('RSS', 'dental-clinic') . '</abbr>' . 
		'</a>' . 
	'</li>' . "\n\t" . 
	'<li>' . 
		'<a href="';
	
	
	bloginfo('comments_rss2_url');
	
	
	echo '" title="' . esc_attr__('The latest comments to all posts in RSS', 'dental-clinic') . '">' . esc_html__('Comments', 'dental-clinic') . ' ' . 
					'<abbr title="' . esc_attr__('Really Simple Syndication', 'dental-clinic') . '">' . esc_html__('RSS', 'dental-clinic') . '</abbr>' . 
				'</a>' . 
			'</li>' . "\n\t" . 
			'<li>' . 
				'<a href="http://wordpress.org/" title="' . esc_attr__('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'dental-clinic') . '">WordPress.org</a>' . 
			'</li>' . "\r" . 
		'</ul>' . "\n" . 
	'</aside>' . "\n";
}



/* Theme Header Styles & Custom CSS Function */
function cmsms_theme_header_styles() {
	$cmsms_option = cmsms_get_global_options();
	
	
	$header_top_height = (($cmsms_option[CMSMS_SHORTNAME . '_header_top_height'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_header_top_height'] : '35');
	
	$header_mid_height = (($cmsms_option[CMSMS_SHORTNAME . '_header_mid_height'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_header_mid_height'] : '95');
	
	$header_bot_height = (($cmsms_option[CMSMS_SHORTNAME . '_header_bot_height'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_header_bot_height'] : '45');
	
	
	$out = "
	.header_top,
	.header_top_outer,
	.header_top_inner, 
	.header_top_aligner {
		height : {$header_top_height}px;
	}
	
	.header_mid,
	.header_mid_outer,
	.header_mid .header_mid_inner .search_wrap_inner,
	.header_mid .header_mid_inner .slogan_wrap_inner,
	.header_mid .header_mid_inner .social_wrap_inner,
	.header_mid .header_mid_inner nav > div > ul,
	.header_mid .header_mid_inner nav > div > ul > li,
	.header_mid .header_mid_inner .logo,
	.header_mid .header_mid_inner .resp_nav_wrap_inner {
		height : {$header_mid_height}px;
	}
	
	.header_bot,
	.header_bot_outer,
	.header_bot .header_bot_inner nav > div > ul,
	.header_bot .header_bot_inner nav > div > ul > li,
	.header_bot .header_bot_inner nav > div > ul > li > a {
		height : {$header_bot_height}px;
	}
	
	#page.cmsms_heading_after_header #middle, 
	#page.cmsms_heading_under_header #middle .headline .headline_outer {
		padding-top : {$header_mid_height}px;
	}
	
	#page.cmsms_heading_after_header.enable_header_top #middle, 
	#page.cmsms_heading_under_header.enable_header_top #middle .headline .headline_outer {
		padding-top : " . ($header_mid_height + $header_top_height) . "px;
	}
	
	#page.cmsms_heading_after_header.enable_header_bottom #middle, 
	#page.cmsms_heading_under_header.enable_header_bottom #middle .headline .headline_outer {
		padding-top : " . ($header_mid_height + $header_bot_height) . "px;
	}
	
	#page.cmsms_heading_after_header.enable_header_top.enable_header_bottom #middle, 
	#page.cmsms_heading_under_header.enable_header_top.enable_header_bottom #middle .headline .headline_outer {
		padding-top : " . ($header_mid_height + $header_top_height + $header_bot_height) . "px;
	}
	
	@media only screen and (max-width: 1024px) {
		.header_top,
		.header_top_outer,
		.header_top_inner,
		.header_top_aligner,
		.header_mid,
		.header_mid_outer,
		.header_mid .header_mid_inner nav > div > ul,
		.header_mid .header_mid_inner nav > div > ul > li,
		.header_bot,
		.header_bot_outer,
		.header_bot .header_bot_inner nav > div > ul,
		.header_bot .header_bot_inner nav > div > ul > li,
		.header_bot .header_bot_inner nav > div > ul > li > a {
			height : auto;
		}
		
		#page.cmsms_heading_after_header #middle, 
		#page.cmsms_heading_under_header #middle .headline .headline_outer, 
		#page.cmsms_heading_after_header.enable_header_top #middle, 
		#page.cmsms_heading_under_header.enable_header_top #middle .headline .headline_outer, 
		#page.cmsms_heading_after_header.enable_header_bottom #middle, 
		#page.cmsms_heading_under_header.enable_header_bottom #middle .headline .headline_outer, 
		#page.cmsms_heading_after_header.enable_header_top.enable_header_bottom #middle, 
		#page.cmsms_heading_under_header.enable_header_top.enable_header_bottom #middle .headline .headline_outer {
			padding-top : 0 !important;
		}
	}
";
	
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_logo_type'] == 'text' && $cmsms_option[CMSMS_SHORTNAME . '_logo_custom_color']) {
		$out .= "
	#header a.logo span.title {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_logo_title_color']) . "
	}
	
	#header a.logo span.title_text {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_logo_subtitle_color']) . "
	}
";
	}
	
	
	if (is_404()) {
		if (
			$cmsms_option[CMSMS_SHORTNAME . '_error_bg_img_enable'] && 
			$cmsms_option[CMSMS_SHORTNAME . '_error_bg_image'] != ''
		) {
			$error_bg_image = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_error_bg_image']);
			
			
			if (is_numeric($error_bg_image[0])) {
				$error_bg_image_url = wp_get_attachment_image_src((int) $error_bg_image[0], 'full');
			}
			
			
			$out .= "
	.error .error_bg {
		background-image : " . (!empty($cmsms_option[CMSMS_SHORTNAME . '_error_bg_image']) ? 'url(' . ((is_numeric($error_bg_image[0])) ? $error_bg_image_url[0] : $error_bg_image[1]) . ')' : 'none') . ";
		background-position : " . (!empty($cmsms_option[CMSMS_SHORTNAME . '_error_bg_pos']) ? $cmsms_option[CMSMS_SHORTNAME . '_error_bg_pos'] : 'top center') . ";
		background-repeat : " . (!empty($cmsms_option[CMSMS_SHORTNAME . '_error_bg_rep']) ? $cmsms_option[CMSMS_SHORTNAME . '_error_bg_rep'] : 'repeat') . ";
		background-attachment : " . (!empty($cmsms_option[CMSMS_SHORTNAME . '_error_bg_att']) ? $cmsms_option[CMSMS_SHORTNAME . '_error_bg_att'] : 'scroll') . ";
		background-size : " . (!empty($cmsms_option[CMSMS_SHORTNAME . '_error_bg_size']) ? $cmsms_option[CMSMS_SHORTNAME . '_error_bg_size'] : 'auto') . ";
	}
";
		}
		
		
		$out .= "
	.error .error_bg {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_error_bg_color']) . "
	}
	
	.error .error_title {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_error_color']) . "
	}
";
	}
	
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_custom_css'] != '') {
		$out .= stripslashes($cmsms_option[CMSMS_SHORTNAME . '_custom_css']);
	}
	
	
	return $out;
}



/* Theme Background Styles Function */
function cmsms_theme_bg_styles() {
	global $post;
	
	
	$cmsms_option = cmsms_get_global_options();
	
	
	if (is_singular()) {
		$cmsms_page_id = $post->ID;
	} 
	
	
	$out = "";
	
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_theme_layout'] == 'boxed') {
		$cmsms_bg_default = 'true';
		
		
		if (
			is_singular()
		) {
			$cmsms_bg_default = get_post_meta($cmsms_page_id, 'cmsms_bg_default', true);
		}
		
		
		if ($cmsms_bg_default == 'false') {
			$cmsms_bg_col = get_post_meta($cmsms_page_id, 'cmsms_bg_col', true);
			$cmsms_bg_img_enable = get_post_meta($cmsms_page_id, 'cmsms_bg_img_enable', true);
			$cmsms_bg_img_str = get_post_meta($cmsms_page_id, 'cmsms_bg_img', true);
			$cmsms_bg_pos = get_post_meta($cmsms_page_id, 'cmsms_bg_pos', true);
			$cmsms_bg_rep = get_post_meta($cmsms_page_id, 'cmsms_bg_rep', true);
			$cmsms_bg_att = get_post_meta($cmsms_page_id, 'cmsms_bg_att', true);
			$cmsms_bg_size = get_post_meta($cmsms_page_id, 'cmsms_bg_size', true);
		} else {
			$cmsms_bg_col = $cmsms_option[CMSMS_SHORTNAME . '_bg_col'];
			$cmsms_bg_img_enable = $cmsms_option[CMSMS_SHORTNAME . '_bg_img_enable'];
			$cmsms_bg_img_str = $cmsms_option[CMSMS_SHORTNAME . '_bg_img'];
			$cmsms_bg_pos = $cmsms_option[CMSMS_SHORTNAME . '_bg_pos'];
			$cmsms_bg_rep = $cmsms_option[CMSMS_SHORTNAME . '_bg_rep'];
			$cmsms_bg_att = $cmsms_option[CMSMS_SHORTNAME . '_bg_att'];
			$cmsms_bg_size = $cmsms_option[CMSMS_SHORTNAME . '_bg_size'];
		}
		
		
		$cmsms_bg_img = (!empty($cmsms_bg_img_str) ? explode('|', $cmsms_bg_img_str) : $cmsms_bg_img_str);
		$cmsms_bg_img_url = (isset($cmsms_bg_img[0]) && is_numeric($cmsms_bg_img[0]) ? wp_get_attachment_image_src((int) $cmsms_bg_img[0], 'full') : '');
		$cmsms_bg_img_src = (is_array($cmsms_bg_img) ? 'url(' . ((is_numeric($cmsms_bg_img[0])) ? $cmsms_bg_img_url[0] : $cmsms_bg_img[1]) . ')' : 'none');
		
		
		$out .= "
	body {
		background-color : {$cmsms_bg_col};";
		
		if ($cmsms_bg_img_enable) {
			$out .= "
		background-image : {$cmsms_bg_img_src};
		background-position : {$cmsms_bg_pos};
		background-repeat : {$cmsms_bg_rep};
		background-attachment : {$cmsms_bg_att};
		background-size : {$cmsms_bg_size};
		";
		}
		
		$out .= "
	}";
	}
	
	
	return $out;
}



/* Theme Footer Styles */
function cmsms_theme_footer_styles() {
	$cmsms_option = cmsms_get_global_options();
	
	
	$footer_height = (($cmsms_option[CMSMS_SHORTNAME . '_footer_height'] !== '') ? $cmsms_option[CMSMS_SHORTNAME . '_footer_height'] : '450');
	
	
	$out = "
	#footer.cmsms_footer_default .footer_inner {
		min-height:{$footer_height}px;
	}
	
	.fixed_footer #main {
		margin-bottom:{$footer_height}px;
	}
";


	return $out;
}



/* Theme Header Body Footer Styles */
function cmsms_header_body_footer_styles() {
	$out = '<style type="text/css">' . 
		cmsms_theme_header_styles() . 
		cmsms_theme_bg_styles() . 
		cmsms_theme_footer_styles() . 
	'</style>';
	
	
	echo $out;
}

add_action('wp_head', 'cmsms_header_body_footer_styles');



/* Theme Footer Scripts Function */
function cmsms_theme_footer_scripts() {
	$cmsms_option = cmsms_get_global_options();
	
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_custom_js'] != '') {
		echo "
<script type=\"text/javascript\">
	" . stripslashes($cmsms_option[CMSMS_SHORTNAME . '_custom_js']) . "
</script>
";
	}
}

add_action('wp_print_footer_scripts', 'cmsms_theme_footer_scripts');



/* Theme Page Layout and Scheme Function */
function cmsms_theme_page_layout_scheme() {
	$cmsms_option = cmsms_get_global_options();
	
	
	if (is_singular()) {
		$cmsms_page_id = get_the_ID();
	} 
	
	
	if (
		is_404() || 
		is_attachment() || 
		is_singular('project') || 
		is_singular('profile') 
	) {
		$cmsms_layout = 'fullwidth';
	} elseif (
		is_singular() 
	) {
		$cmsms_layout = get_post_meta($cmsms_page_id, 'cmsms_layout', true);
		
		$cmsms_page_scheme = get_post_meta($cmsms_page_id, 'cmsms_page_scheme', true);
	} elseif (is_archive() || is_home()) {
		$cmsms_layout = $cmsms_option[CMSMS_SHORTNAME . '_archives_layout'];
	} elseif (is_search()) {
		$cmsms_layout = $cmsms_option[CMSMS_SHORTNAME . '_search_layout'];
	} else {
		$cmsms_layout = $cmsms_option[CMSMS_SHORTNAME . '_other_layout'];
	}
	
	
	if ($cmsms_layout == '') {
		$cmsms_layout = $cmsms_option[CMSMS_SHORTNAME . '_layout'];
	}
	
	
	if (!isset($cmsms_page_scheme) || $cmsms_page_scheme == '') {
		$cmsms_page_scheme = 'default';
	}
	
	
	return array($cmsms_layout, $cmsms_page_scheme);
}



/* Register Moving 'style' Tags from Shortcodes to Content Start */
function cmsms_global_shortcodes_styles_move($content) {
	preg_match_all("/<style.*?>([^`]*?)<\/style>/", $content, $new_content);
	
	$nostyle_content = preg_replace("/<style.*?>([^`]*?)<\/style>/", '', $content);
	
	
	$style_content = '<style type="text/css">';
	
	
	foreach ($new_content[1] as $new_content_part) {
		$style_content .= $new_content_part;
	}
	
	
	$style_content .= '</style>';
	
	
    $content = $style_content . $nostyle_content;
	
	
    return $content;
}

add_filter('the_content', 'cmsms_global_shortcodes_styles_move', 11, 2);



// Add Input Date script for Contact Form 7
if (function_exists('wpcf7')) {
	add_filter( 'wpcf7_support_html5_fallback', '__return_true' );
}

