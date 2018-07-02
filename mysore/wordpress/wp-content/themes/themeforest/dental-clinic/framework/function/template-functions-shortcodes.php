<?php 
/**
 * @package 	WordPress
 * @subpackage 	Dental Clinic
 * @version		1.0.0
 * 
 * Template Functions for Shortcodes
 * Created by CMSMasters
 * 
 */


/**
 * Posts Slider Functions
 */

/* Get Posts Slider Heading Function */
function cmsms_slider_post_heading($cmsms_id, $type = 'post', $tag = 'h1', $show = true, $link_redirect = false, $link_url = false) { 
	if ($type == 'post') {
		$out = '<header class="cmsms_slider_post_header entry-header">' . 
			'<' . esc_html($tag) . ' class="cmsms_slider_post_title entry-title">' . 
				'<a href="' . esc_url(get_permalink()) . '">' . cmsms_title($cmsms_id, false) . '</a>' . 
			'</' . esc_html($tag) . '>' . 
		'</header>';
	} elseif ($type == 'project') {
		$out = '<header class="cmsms_slider_project_header entry-header">' . 
			'<' . esc_html($tag) . ' class="cmsms_slider_project_title entry-title">' . 
				'<a href="' . (($link_redirect == 'true' && $link_url != '') ? esc_url($link_url) : esc_url(get_permalink())) . '">' . cmsms_title($cmsms_id, false) . '</a>' . 
			'</' . esc_html($tag) . '>' . 
		'</header>';
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Slider Content/Excerpt Function */
function cmsms_slider_post_exc_cont($type = 'post', $show = true) {
	$out = '';
	
	$post_excerpt = wpautop(theme_excerpt(15, false));
	
	if ($post_excerpt != '') {
		if ($type == 'post') {
			$out = cmsms_divpdel('<div class="cmsms_slider_post_content entry-content">' . "\n" . 
				wpautop(theme_excerpt(55, false)) . 
			'</div>' . "\n");
		} elseif ($type == 'project') {
			$out = cmsms_divpdel('<div class="cmsms_slider_project_content entry-content">' . "\n" . 
				wpautop(theme_excerpt(55, false)) . 
			'</div>' . "\n");
		}
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Check Posts Slider Content/Excerpt Not Empty Function */
function cmsms_slider_post_check_exc_cont($type = 'post') {
	$exc = cmsms_slider_post_exc_cont($type, false);
	
	$no_tags_exc = strip_tags($exc);
	
	$trim_exc = trim($no_tags_exc);
	
	
	if ($trim_exc != '') {
		return true;
	} else {
		return false;
	}
}



/* Get Posts Slider Date Function */
function cmsms_slider_post_date($type = 'post', $show = true) {
	if ($type == 'post') {
		$out = '<span class="cmsms_post_date">' . 
			esc_html__('On', 'dental-clinic') . ' ' . 
			'<abbr class="published" title="' . esc_attr(get_the_date()) . '">' . 
				esc_html(get_the_date()) . 
			'</abbr>' . 
			'<abbr class="dn date updated" title="' . esc_attr(get_the_modified_date()) . '">' . 
				esc_html(get_the_modified_date()) . 
			'</abbr>' . 
		'</span>';
	} elseif ($type == 'project') {
		$out = '<abbr class="published cmsms_slider_project_date" title="' . esc_attr(get_the_date()) . '">' . 
			esc_html(get_the_date()) . 
		'</abbr>' . 
		'<abbr class="dn date updated" title="' . esc_attr(get_the_modified_date()) . '">' . 
			esc_html(get_the_modified_date()) . 
		'</abbr>';
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Slider Author Function */
function cmsms_slider_post_author($type = 'post', $show = true) {
	if ($type == 'post') {
		$out = '<span class="cmsms_slider_post_user_name">' . 
			esc_html__('By', 'dental-clinic') . ' ' . 
			'<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" title="' . esc_attr__('Posts by', 'dental-clinic') . ' ' . esc_attr(get_the_author_meta('display_name')) . '" class="vcard author"><span class="fn" rel="author">' . esc_html(get_the_author_meta('display_name')) . '</span></a>' . 
		'</span>';
	} elseif ($type == 'project') {
		$out = '<span class="cmsms_slider_project_user_name">' . 
			esc_html__('By', 'dental-clinic') . ' ' . 
			'<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" title="' . esc_attr__('Posts by', 'dental-clinic') . ' ' . esc_attr(get_the_author_meta('display_name')) . '" class="vcard author"><span class="fn" rel="author">' . esc_html(get_the_author_meta('display_name')) . '</span></a>' . 
		'</span>';
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Slider Category Function */
function cmsms_slider_post_category($type = 'post', $cmsms_id = false, $taxonomy = false, $show = true) {
	if (get_the_category() || get_the_terms($cmsms_id, $taxonomy)) {
		if ($type == 'post') {
			$out = '<span class="cmsms_slider_post_category">' . 
				esc_html__('In ', 'dental-clinic') . 
				get_the_category_list(', ') . 
			'</span>';
		} elseif ($type == 'project') {
			$out = '<span class="cmsms_slider_project_category">' . 
				get_the_term_list($cmsms_id, $taxonomy, '', ', ', '') . 
			'</span>';
		}
		
		
		if ($show) {
			echo $out;
		} else {
			return $out;
		}
	}
}



/* Get Posts Slider Like Function */
function cmsms_slider_post_like($type = 'post', $show = true) {
	if ($type == 'post') {
		$out = cmsmsLike(false);
	} elseif ($type == 'project') {
		$out = cmsmsLike(false);
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Slider Comments Function */
function cmsms_slider_post_comments($type = 'post', $show = true) {
	if (comments_open()) {
		if ($type == 'post') {
			$out = '<a class="cmsms_post_comments cmsms_theme_icon_comment" href="' . esc_url(get_comments_link()) . '" title="' . esc_attr__('Comment on', 'dental-clinic') . ' ' . esc_attr(get_the_title()) . '">' . 
				'<span>' . esc_html(get_comments_number()) . '</span>' . 
			'</a>';
		} elseif ($type == 'project') {
			$out = '<a class="cmsms_post_comments cmsms_theme_icon_comment" href="' . esc_url(get_comments_link()) . '" title="' . esc_attr__('Comment on', 'dental-clinic') . ' ' . esc_attr(get_the_title()) . '">' . 
				'<span>' . esc_html(get_comments_number()) . '</span>' . 
			'</a>';
		}
		
		
		if ($show) {
			echo $out;
		} else {
			return $out;
		}
	}
}



/* Get Posts Slider More Button/Link Function */
function cmsms_slider_post_more($cmsms_id, $show = true) {
	$cmsms_post_read_more = get_post_meta($cmsms_id, 'cmsms_post_read_more', true);
	
	
	if ($cmsms_post_read_more == '') {
		$cmsms_post_read_more = esc_attr__('Continue reading', 'dental-clinic');
	}
	
	
	$out = '<a class="cmsms_post_read_more" href="' . esc_url(get_permalink($cmsms_id)) . '">' . esc_html($cmsms_post_read_more) . '</a>';
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Slider Chat Post Function */
function cmsms_slider_post_format_chat($show = true) {
	$out  = '<dl class="cmsms_chat chat">';
	
	$stanzas = get_the_post_format_chat();
	

	foreach ($stanzas as $stanza) {
		foreach ($stanza as $row) {
			$time = '';
			
			if (!empty($row['time'])) {
				$time = sprintf('<time class="cmsms_chat_time chat-timestamp">%s</time>', esc_html($row['time']));
			}
			
			$out .= sprintf(
				'<div class="cmsms_chat_item">
					<dt class="cmsms_chat_author_time chat-author chat-author-%1$s vcard">%2$s <cite class="cmsms_chat_author fn">%3$s</cite></dt>
					<dd class="cmsms_chat_text chat-text">%4$s</dd>
				</div>',
				esc_attr(sanitize_title_with_dashes($row['author'])), 
				$time,
				esc_html($row['author']),
				$row['message']
			);
		}
	}
	

	$out .= '</dl>';
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}

