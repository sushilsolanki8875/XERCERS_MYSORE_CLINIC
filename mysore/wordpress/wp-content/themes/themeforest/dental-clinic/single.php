<?php
/**
 * @package 	WordPress
 * @subpackage 	Dental Clinic
 * @version		1.0.0
 * 
 * Single Post Template
 * Created by CMSMasters
 * 
 */


get_header();


$cmsms_option = cmsms_get_global_options();


list($cmsms_layout) = cmsms_theme_page_layout_scheme();


$cmsms_post_sharing_box = get_post_meta(get_the_ID(), 'cmsms_post_sharing_box', true);

$cmsms_post_author_box = get_post_meta(get_the_ID(), 'cmsms_post_author_box', true);

$cmsms_post_more_posts = get_post_meta(get_the_ID(), 'cmsms_post_more_posts', true);


echo '<!--_________________________ Start Content _________________________ -->' . "\n";


if ($cmsms_layout == 'r_sidebar') {
	echo '<div class="content entry" role="main">' . "\n\t";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo '<div class="content entry fr" role="main">' . "\n\t";
} else {
	echo '<div class="middle_content entry" role="main">' . "\n\t";
}


if (have_posts()) : the_post();
	echo '<div class="blog opened-article">' . "\n";
	
	
	if ($cmsms_layout == 'fullwidth') {
		if (get_post_format() != '') {
			get_template_part('framework/postType/blog/post/fullwidth/' . get_post_format());
		} else {
			get_template_part('framework/postType/blog/post/fullwidth/standard');
		}
	} else {
		if (get_post_format() != '') {
			get_template_part('framework/postType/blog/post/sidebar/' . get_post_format());
		} else {
			get_template_part('framework/postType/blog/post/sidebar/standard');   
		}
	}
	
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_blog_post_nav_box']) {
		cmsms_prev_next_posts();
	}
	
	
	if ($cmsms_post_sharing_box == 'true') {
		cmsms_sharing_box(esc_html__('Share this post?', 'dental-clinic'), 'h3');
	}
	
	
	if ($cmsms_post_author_box == 'true') {
		cmsms_author_box(esc_html__('About author', 'dental-clinic'), 'h3');
	}
	
	
	if (get_the_tags()) {
		$tgsarray = array();
		
		foreach (get_the_tags() as $tagone) {
			$tgsarray[] = $tagone->term_id;
		}  
	} else {
		$tgsarray = '';
	}
	
	
	if ($cmsms_post_more_posts != 'hide') {
		cmsms_related( 
			'h3', 
			$cmsms_post_more_posts, 
			$tgsarray, 
			$cmsms_option[CMSMS_SHORTNAME . '_blog_more_posts_count'], 
			$cmsms_option[CMSMS_SHORTNAME . '_blog_more_posts_pause'], 
			'post' 
		);
	}
	
	
	comments_template(); 
	
	
	echo '</div>';
endif;


echo '</div>' . "\n" . 
'<!-- _________________________ Finish Content _________________________ -->' . "\n\n";


if ($cmsms_layout == 'r_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<div class="sidebar" role="complementary">' . "\n";
	
	
	get_sidebar();
	
	
	echo "\n" . '</div>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<div class="sidebar fl" role="complementary">' . "\n";
	
	
	get_sidebar();
	
	
	echo "\n" . '</div>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
}


get_footer();

