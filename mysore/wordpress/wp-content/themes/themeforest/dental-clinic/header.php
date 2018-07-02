<?php
/**
 * @package 	WordPress
 * @subpackage 	Dental Clinic
 * @version 	1.0.0
 * 
 * Website Header Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


?><!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8)]><!-->
<html <?php language_attributes(); ?> class="cmsms_html">
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php 
if (!function_exists('has_site_icon') || !has_site_icon()) { 
	cmsms_favicon(); 
}
?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php 
// echo '<link rel="stylesheet/less" href="' . get_template_directory_uri() . '/css/less/style.less" type="text/css" media="screen" />' . "\n" . 
// '<link rel="stylesheet/less" href="' . get_template_directory_uri() . '/css/less/adaptive.less" type="text/css" media="screen" />' . "\n";
?>

<?php 
$ua = $_SERVER['HTTP_USER_AGENT'];

$checker = array( 
	'ios' => 			preg_match('/iPhone|iPod|iPad/', $ua), 
	'blackberry' => 	preg_match('/BlackBerry/', $ua), 
	'android' => 		preg_match('/Android/', $ua), 
	'mac' => 			preg_match('/Macintosh/', $ua), 
	'chrome' => 		preg_match('/Chrome/', $ua), 
	'safari' => 		preg_match('/Safari/', $ua), 
	'ie' => 			preg_match('/MSIE/', $ua), 
	'ie11' => 			preg_match('/Trident/', $ua) 
);


if (is_singular() && get_option('thread_comments')) {
	wp_enqueue_script('comment-reply');
}


$nav_args = array( 
	'theme_location' => 	'primary', 
	'menu_id' => 			'navigation', 
	'menu_class' => 		'navigation', 
	'link_before' => 		'<span>', 
	'link_after' => 		'</span>', 
	'fallback_cb' => 		'cmsms_fallback_menu' 
);


if (class_exists('Walker_Cmsms_Nav_Mega_Menu')) {
	$nav_args['link_before'] = '';
	$nav_args['link_after'] = '';
	$nav_args['walker'] = new Walker_Cmsms_Nav_Mega_Menu();
}


wp_head();

?>
</head>
<body <?php body_class(); ?>>
	
<!-- _________________________ Start Page _________________________ -->
<div id="page" class="<?php 
if ( 
	!$checker['ios'] && 
	!$checker['blackberry'] && 
	!$checker['android'] && 
	!$checker['mac'] 
) { 
	echo 'csstransition '; 
}

if ($checker['chrome']) { 
	echo 'chrome_only '; 
}

if ($checker['safari'] && !$checker['chrome']) { 
	echo 'safari_only '; 
}

if ($checker['ie'] || $checker['ie11']) { 
	echo 'ie_only '; 
}

echo 'cmsms_' . $cmsms_option[CMSMS_SHORTNAME . '_theme_layout'] . ' ';

if ($cmsms_option[CMSMS_SHORTNAME . '_fixed_header']) {
	echo 'fixed_header ';
}

if ($cmsms_option[CMSMS_SHORTNAME . '_fixed_footer'] && $cmsms_option[CMSMS_SHORTNAME . '_footer_type'] == 'default') {
	echo 'fixed_footer ';
}

if ($cmsms_option[CMSMS_SHORTNAME . '_header_top_line']) {
	echo 'enable_header_top ';
}

if ($cmsms_option[CMSMS_SHORTNAME . '_header_styles'] != 'default') {
	echo 'enable_header_bottom ';
}

if ($cmsms_option[CMSMS_SHORTNAME . '_header_styles'] == 'r_nav') {
	echo 'enable_header_right ';
}

if ($cmsms_option[CMSMS_SHORTNAME . '_header_styles'] == 'c_nav') {
	echo 'enable_header_centered ';
}


if (is_singular()) {
	$cmsms_page_id = get_the_ID();
} 

$cmsms_header_overlaps = '';

if (
	is_singular() 
) {
	$cmsms_header_overlaps = get_post_meta($cmsms_page_id, 'cmsms_header_overlaps', true);
}

if ($cmsms_header_overlaps == '') {
	$cmsms_header_overlaps = $cmsms_option[CMSMS_SHORTNAME . '_header_overlaps'];
}

if ($cmsms_header_overlaps != 'false') {
	echo 'cmsms_heading_under_header ';
} else {
	echo 'cmsms_heading_after_header ';
}
?>hfeed site">

<!-- _________________________ Start Main _________________________ -->
<div id="main">
	
<!-- _________________________ Start Header _________________________ -->
<header id="header">
	<?php if ($cmsms_option[CMSMS_SHORTNAME . '_header_top_line']) { ?>
		<div class="header_top" data-height="<?php echo $cmsms_option[CMSMS_SHORTNAME . '_header_top_height']; ?>">
			<div class="header_top_outer">
				<div class="header_top_inner">
				<?php 
					if (
						$cmsms_option[CMSMS_SHORTNAME . '_header_top_line_add_cont'] !== 'none' 
					) {
						echo '<div class="header_top_right">' . 
							'<div class="header_top_aligner"></div>';
						
						
						if ($cmsms_option[CMSMS_SHORTNAME . '_header_top_line_add_cont'] == 'social' && isset($cmsms_option[CMSMS_SHORTNAME . '_social_icons'])) {
							cmsms_social_icons();
						} elseif ($cmsms_option[CMSMS_SHORTNAME . '_header_top_line_add_cont'] == 'nav' && has_nav_menu('top_line')) {
							echo '<div class="nav_wrap">' . 
								'<a class="responsive_top_nav cmsms_theme_icon_resp_nav" href="javascript:void(0);"></a>' . 
								'<nav>';
							
							
							wp_nav_menu(array( 
								'theme_location' => 	'top_line', 
								'menu_id' => 			'top_line_nav', 
								'menu_class' => 		'top_line_nav' 
							));
							
							
							echo '</nav>' . 
							'</div>';
						}
						
						
						echo '</div>';
					}
					
					
					if ($cmsms_option[CMSMS_SHORTNAME . '_header_top_line_short_info'] !== '') {
						echo '<div class="header_top_left">' . 
							'<div class="header_top_aligner"></div>' . 
							'<div class="meta_wrap">' . 
								stripslashes($cmsms_option[CMSMS_SHORTNAME . '_header_top_line_short_info']) . 
							'</div>' . 
						'</div>';
					} 
				?>
					<div class="cl"></div>
				</div>
			</div>
			<div class="header_top_but closed">
				<span class="cmsms_bot_arrow_pixel">
					<span></span>
				</span>
			</div>
		</div>
	<?php } ?>
	<div class="header_mid" data-height="<?php echo $cmsms_option[CMSMS_SHORTNAME . '_header_mid_height']; ?>">
		<div class="header_mid_outer">
			<div class="header_mid_inner">
			<?php 
			if (
				$cmsms_option[CMSMS_SHORTNAME . '_header_search'] && 
				$cmsms_option[CMSMS_SHORTNAME . '_header_styles'] != 'c_nav'
			) {
			?>
				<div class="search_wrap">
					<div class="search_wrap_inner">
						<div class="search_wrap_inner_left">
							<?php get_search_form(); ?>
						</div>
					</div>
				</div>
			<?php 
			}
			
			
			if (
				$cmsms_option[CMSMS_SHORTNAME . '_header_styles'] != 'default' && 
				$cmsms_option[CMSMS_SHORTNAME . '_header_styles'] != 'c_nav'
			) { 
				if (
					$cmsms_option[CMSMS_SHORTNAME . '_header_add_cont'] == 'cust_html' && 
					$cmsms_option[CMSMS_SHORTNAME . '_header_add_cont_cust_html'] !== ''
				) {
			?>
				<div class="slogan_wrap">
					<div class="slogan_wrap_inner">
						<div class="slogan_wrap_text">
							<?php echo stripslashes($cmsms_option[CMSMS_SHORTNAME . '_header_add_cont_cust_html']) ?>
						</div>
					</div>
				</div>
			<?php 
				} elseif (
					$cmsms_option[CMSMS_SHORTNAME . '_header_add_cont'] == 'social' && 
					isset($cmsms_option[CMSMS_SHORTNAME . '_social_icons'])
				) {
					cmsms_social_icons();
				}
			}
			?>
			
			<div class="logo_wrap"><?php cmsms_logo(); ?></div>
			
			<?php if ($cmsms_option[CMSMS_SHORTNAME . '_header_styles'] == 'default') { ?>
				<div class="resp_nav_wrap">
					<div class="resp_nav_wrap_inner">
						<div class="resp_nav_content">
							<a class="responsive_nav cmsms_theme_icon_resp_nav" href="javascript:void(0);"></a>
						</div>
					</div>
				</div>
				
				<!-- _________________________ Start Navigation _________________________ -->
				<nav role="navigation">
				<?php
					echo "\t";
					
					
					wp_nav_menu($nav_args);
					
					
					echo "\r";
				?>
					<div class="cl"></div>
				</nav>
				<!-- _________________________ Finish Navigation _________________________ -->
			<?php } ?>
			</div>
		</div>
	</div>
<?php if ($cmsms_option[CMSMS_SHORTNAME . '_header_styles'] != 'default') { ?>
	<div class="header_bot" data-height="<?php echo $cmsms_option[CMSMS_SHORTNAME . '_header_bot_height']; ?>">
		<div class="header_bot_outer">
			<div class="header_bot_inner">
				<div class="resp_nav_wrap">
					<div class="resp_nav_wrap_inner">
						<div class="resp_nav_content">
							<a class="responsive_nav cmsms_theme_icon_resp_nav" href="javascript:void(0);"></a>
						</div>
					</div>
				</div>
				
				<!-- _________________________ Start Navigation _________________________ -->
				<nav role="navigation">
				<?php
					echo "\t";
					
					
					wp_nav_menu($nav_args);
					
					
					echo "\r";
				?>
					<div class="cl"></div>
				</nav>
				<!-- _________________________ Finish Navigation _________________________ -->
				
			</div>
		</div>
	</div>
<?php } ?>
</header>
<!-- _________________________ Finish Header _________________________ -->

	
<!-- _________________________ Start Middle _________________________ -->
<div id="middle"<?php echo (is_404()) ? ' class="error_page"' : ''; ?>>
<?php 
if (!is_404() && !is_home()) {
	cmsms_page_heading();
} else {
	echo "<div class=\"headline\">
		<div class=\"headline_outer cmsms_headline_disabled\"></div>
	</div>";
}


list($cmsms_layout, $cmsms_page_scheme) = cmsms_theme_page_layout_scheme();


echo '<div class="middle_inner' . (($cmsms_page_scheme != 'default') ? ' cmsms_color_scheme_' . $cmsms_page_scheme : '') . '">' . "\n" . 
	'<div class="content_wrap ' . $cmsms_layout . 
	((is_singular('project')) ? ' project_page' : '') . 
	((is_singular('profile')) ? ' profile_page' : '') . 
	'">' . "\n\n" . 
	'<div class="sidebar_sep">' . "\n\n";

