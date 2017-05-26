<?php
function firm_twitter_type($post_id){
	$twitter_meta_type = get_post_meta( $post_id, 'twitter_type', true);
	if (isset($twitter_meta_type) && $twitter_meta_type!='') {
		$twitter_type = $twitter_card_meta_type;
	}
	else { $twitter_type = 'summary'; }
	echo '<meta name="twitter:card" content="'.$twitter_type.'" />'."\r\n";
}
function firm_twitter_site(){
	$twitter_site= esc_attr( get_option( 'twitter_card_site' ) );
	echo '<meta name="twitter:site" content="@'.$twitter_site.'" />'."\r\n";
}
function firm_twitter_title($post_id) {
	$twitter_meta_title = get_post_meta( $post_id, 'twitter_title', true);
	$og_meta_title = get_post_meta( $post_id, 'og_title', true);
	$seo_full_title = get_post_meta( $post_id, 'seo_full_title', true);
	$keyword_title = get_post_meta( $post_id, 'focus_kw', true);
	if (isset($twitter_meta_title) && $twitter_meta_title!='') {
		$twitter_title = $twitter_meta_title;
	}
	else if (isset($og_meta_title) && $og_meta_title!='') {
		$twitter_title = $og_meta_title;
	}
	else if (isset($seo_full_title) && $seo_full_title!='')  {
		$twitter_title = $seo_full_title;
	}
	else if (isset($keyword_title) && $keyword_title!='')  {
		$twitter_title = $keyword_title;
	}
	else {
		if ( is_front_page() ){ 
			$twitter_title = get_bloginfo('name').' '.get_bloginfo('description');
		}
		else {
			$twitter_title =  get_the_title($post_id);
		}
	}
	echo '<meta name="twitter:title" content="'.$twitter_title.'" />';
	echo "\r\n";
}
function firm_twitter_desc($post_id){
	$twitter_meta_desc = get_post_meta( $post_id, 'twitter_desc', true);
	$og_meta_desc = get_post_meta( $post_id, 'og_desc', true);
	$meta_desc = get_post_meta( $post_id, 'meta_desc', true);
	if (isset($twitter_meta_desc) && $twitter_meta_desc!='') {
		$twitter_desc = $twitter_meta_desc;
	}
	else if (isset($og_meta_desc) && $og_meta_desc!='') {
		$twitter_desc = $og_meta_desc;
	}
	else if (is_single()) { $twitter_desc = get_the_excerpt($post_id); }
	else if (is_page()) { 
		$page_object = get_page( $post_id );
		$firm_page_content = $page_object->post_content;
		$firm_excerpt = rtrim(str_replace(array("\r", "\n"), ' ',substr(strip_tags($firm_page_content),0,130)))."...";
	}
	if (isset($meta_desc) && $meta_desc!='') {
		$twitter_desc = $meta_desc;
	}
	else if (isset($firm_excerpt) && $firm_excerpt!='') { 
		$twitter_desc = $firm_excerpt;
	}
	echo '<meta name="twitter:description" content="'.$twitter_desc.'" />'."\r\n";
}
function firm_twitter_image($post_id){
	$twitter_meta_image = get_post_meta( $post_id, 'twitter_image', true);
	$og_meta_image = get_post_meta( $post_id, 'og_image', true);
	$twitter_default_image = esc_attr( get_option( 'twitter_card_image_default' ) );
	if (isset($twitter_meta_image) && $twitter_meta_image!='') {
		$twitter_image = $twitter_meta_image;
		echo '<meta property="og:image" content="'.$twitter_image.'" />'."\r\n"; 
	}
	else if (isset($og_meta_image) && $og_meta_image!='') {
		$twitter_image = $og_meta_image;
		echo '<meta property="og:image" content="'.$twitter_image.'" />'."\r\n"; 
	}
	else if (isset($twitter_default_image) && $twitter_default_image!='') {
		$twitter_image = $twitter_default_image;
		echo '<meta property="twitter:image" content="'.$twitter_image.'" />'."\r\n"; 
	}
	
}

function firm_twitter_card() {
	global $post;
	if (is_home()) {  $firm_post_id = get_option('page_for_posts'); }
	else { $firm_post_id = $post->ID; }
	//$og_site_name = get_bloginfo('name');
	firm_twitter_type($firm_post_id);
	firm_twitter_site();
	firm_twitter_title($firm_post_id);
	firm_twitter_desc($firm_post_id);
	firm_twitter_image($firm_post_id);
}
add_action('wp_head','firm_twitter_card',2)
?>