<?php
/**
 * @package 	WordPress
 * @subpackage 	Dental Clinic
 * @version		1.0.0
 * 
 * Blog Page Default Status Post Format Template
 * Created by CMSMasters
 * 
 */
 
 
global $cmsms_metadata;


$cmsms_post_metadata = explode(',', $cmsms_metadata);


$date = (in_array('date', $cmsms_post_metadata) || is_home() || is_archive() || is_search()) ? true : false;
$categories = (get_the_category() && (in_array('categories', $cmsms_post_metadata) || is_home() || is_archive() || is_search())) ? true : false;
$author = (in_array('author', $cmsms_post_metadata) || is_home() || is_archive() || is_search()) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsms_post_metadata) || is_home() || is_archive() || is_search())) ? true : false;
$likes = (in_array('likes', $cmsms_post_metadata) || is_home() || is_archive() || is_search()) ? true : false;
$tags = (get_the_tags() && (in_array('tags', $cmsms_post_metadata) || is_home() || is_archive() || is_search())) ? true : false;


$cmsms_post_status_text = get_post_meta(get_the_ID(), 'cmsms_post_status_text', true);

?>

<!--_________________________ Start Status Article _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class('cmsms_default_type'); ?>>
	<div class="cmsms_post_cont">
	<?php 
		echo '<span class="cmsms_post_format_img ' . (is_sticky() ? 'cmsms_theme_icon_stick' : 'cmsms_theme_icon_person') . '"></span>';
		
		
		if (!post_password_required()) {
			if ($cmsms_post_status_text != '') {
				echo '<div class="cmsms_post_content">' . 
					'<div class="cmsms_post_content_aligner"></div>' . 
					'<div class="entry-title entry-content">' . str_replace("\n", '<br />', $cmsms_post_status_text) . '</div>' . 
				'</div>';
			} else {
				echo '<div class="cmsms_post_content">' . 
					'<div class="cmsms_post_content_aligner"></div>' . 
					'<div class="entry-title entry-content">' . theme_excerpt(55, false) . '</div>' . 
				'</div>';
			}
		} else {
			echo '<p class="cmsms_post_content">' . esc_html__('There is no excerpt because this is a protected post.', 'dental-clinic') . '</p>';
		}
		
		
		if ($date || $author || $categories || $tags || $likes || $comments) {
			echo '<div class="cmsms_post_cont_info entry-meta">';
				
				if ($comments || $likes) {
					echo '<div class="cmsms_post_meta_info">';
						
						$comments ? cmsms_post_comments('page') : '';
						
						$likes ? cmsms_post_like('page') : '';
						
					echo '</div>';
				}
				
				
				$date ? cmsms_post_date('page', 'default') : '';
				
				$author ? cmsms_post_author('page') : '';
				
				$categories ? cmsms_post_category('page') : '';
				
				$tags ? cmsms_post_tags('page') : '';
				
			echo '</div>';
		}
	?>
	</div>
</article>
<!--_________________________ Finish Status Article _________________________ -->

