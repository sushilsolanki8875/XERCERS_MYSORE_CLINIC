<?php
/**
 * @package 	WordPress
 * @subpackage 	Dental Clinic
 * @version		1.0.0
 * 
 * Posts Slider Link Post Format Template
 * Created by CMSMasters
 * 
 */


global $cmsms_post_metadata;


$cmsms_metadata = explode(',', $cmsms_post_metadata);

$excerpt = in_array('excerpt', $cmsms_metadata) ? true : false;
$date = in_array('date', $cmsms_metadata) ? true : false;
$categories = (get_the_category() && (in_array('categories', $cmsms_metadata))) ? true : false;
$author = in_array('author', $cmsms_metadata) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsms_metadata))) ? true : false;
$likes = in_array('likes', $cmsms_metadata) ? true : false;
$more = in_array('more', $cmsms_metadata) ? true : false;


$cmsms_post_link_text = get_post_meta(get_the_ID(), 'cmsms_post_link_text', true);

$cmsms_post_link_address = get_post_meta(get_the_ID(), 'cmsms_post_link_address', true);

if ($cmsms_post_link_text == '') {
	$cmsms_post_link_text = esc_html__('Enter link text', 'dental-clinic');
}

if ($cmsms_post_link_address == '') {
	$cmsms_post_link_address = '#';
}

?>

<!--_________________________ Start Link Article _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cmsms_slider_post_cont">
	<?php 
		echo '<header class="cmsms_slider_post_header entry-header">';
			
			if (!post_password_required()) {
				echo '<h4 class="cmsms_slider_post_title entry-title">' . 
					'<a href="' . esc_url($cmsms_post_link_address) . '" target="_blank">' . esc_html($cmsms_post_link_text) . '</a>' . 
				'</h4>' . 
				'<h6 class="cmsms_slider_post_subtitle">- ' . $cmsms_post_link_address . ' -</h6>';
			} else {
				echo '<h4 class="cmsms_slider_post_title entry-title">' . esc_html($cmsms_post_link_text) . '</h4>';
			}
			
		echo '</header>';
		
		
		if ($date || $author || $categories) {
			echo '<div class="cmsms_post_cont_info entry-meta">';
				
				$date ? cmsms_slider_post_date('post') : '';
				
				$author ? cmsms_slider_post_author('post') : '';
				
				$categories ? cmsms_slider_post_category('post') : '';
				
			echo '</div>';
		}
		
		
		$excerpt ? cmsms_slider_post_exc_cont('post') : '';
		
		
		if ($more || $likes || $comments) {
			echo '<footer class="cmsms_slider_post_footer entry-meta">';
				
				if ($likes || $comments) {
					echo '<div class="cmsms_slider_post_meta_info">';
						
						$comments ? cmsms_slider_post_comments('post') : '';
						
						$likes ? cmsms_slider_post_like('post') : '';
						
					echo '</div>';
				}
				
				
				$more ? cmsms_slider_post_more(get_the_ID()) : '';
				
			echo '</footer>';
		}
	?>
	</div>
</article>
<!--_________________________ Finish Link Article _________________________ -->

