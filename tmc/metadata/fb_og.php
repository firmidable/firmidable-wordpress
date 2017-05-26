<?php
function firm_fb_og_app_id(){
	$og_app_id= esc_attr( get_option( 'fb_og_app_id' ) );
	echo '<meta property="fb:app_id" content="'.$og_app_id.'" />'."\r\n";
}
function firm_fb_og_type($post_id){
	if (is_single()) {
		$og_author = get_the_author($post->post_author);
		echo '<meta property="og:type" content="article" />';
		echo "\r\n";
		echo '<meta property="article:author" content="'.$og_author.'" />';
		echo "\r\n";
	}
	else {
		echo '<meta property="og:type" content="website" />'; 
		echo "\r\n";
	}
}
function firm_fb_og_url($post_id) {
	$og_url = get_permalink($post_id);
	echo '<meta property="og:url" content="'.$og_url.'" />';
	echo "\r\n";
}
function firm_fb_og_title($post_id) {
	$og_meta_title = get_post_meta( $post_id, 'og_title', true);
	$seo_full_title = get_post_meta( $post_id, 'seo_full_title', true);
	$keyword_title = get_post_meta( $post_id, 'focus_kw', true);
	if (isset($og_meta_title) && $og_meta_title!='') {
		$og_title = $og_meta_title;
	}
	else if (isset($seo_full_title) && $seo_full_title!='')  {
		$og_title = $seo_full_title;
	}
	else if (isset($keyword_title) && $keyword_title!='')  {
		$og_title = $keyword_title;
	}
	else {
		if ( is_front_page() ){ 
			$og_title = get_bloginfo('name').' '.get_bloginfo('description');
		}
		else {
			$og_title =  get_the_title($post_id);
		}
	}
	echo '<meta property="og:title" content="'.$og_title.'" />';
	echo "\r\n";
}
function firm_fb_og_desc($post_id) {
	$og_meta_desc = get_post_meta( $post_id, 'og_desc', true);
	$meta_desc = get_post_meta( $post_id, 'meta_desc', true);
	if (isset($og_meta_desc) && $og_meta_desc!='') {
		$og_desc = $og_meta_desc;
	}
	else if (is_single()) { $og_desc = get_the_excerpt($post_id); }
	else if (is_page()) { 
		$page_object = get_page( $post_id );
		$firm_page_content = $page_object->post_content;
		$firm_excerpt = rtrim(str_replace(array("\r", "\n"), ' ',substr(strip_tags($firm_page_content),0,270)))."...";
	}
	if (isset($meta_desc) && $meta_desc!='') {
		$og_desc = $meta_desc;
	}
	else if (isset($firm_excerpt) && $firm_excerpt!='') { 
		$og_desc = $firm_excerpt;
	}
	echo '<meta property="og:description" content="'.$og_desc.'" />'."\r\n";
}
function firm_fb_og_image($post_id) {
	$og_meta_image = get_post_meta( $post_id, 'og_image', true);
	$og_default_image = esc_attr( get_option( 'fb_og_image_default' ) );
	if (isset($og_meta_image) && $og_meta_image!='') {
		$og_image = $og_meta_image;
		echo '<meta property="og:image" content="'.$og_image.'" />'."\r\n"; 
	}
	else if (isset($og_default_image) && $og_default_image!='') {
		$og_image = $og_default_image;
		echo '<meta property="og:image" content="'.$og_image.'" />'."\r\n"; 
	}
}
function firm_fb_og_locale($post_id) {
	$og_meta_locale = get_post_meta( $post_id, 'og_locale', true);
	if (isset($og_meta_locale) && $og_meta_locale!='') {
		$og_locale = $og_meta_locale;
	}
	else { $og_locale = 'en_US';}
	echo '<meta property="og:locale" content="'.$og_locale.'" />';
	echo "\r\n";
}
function firm_fb_og() {
	global $post;
	if (is_home()) {  $firm_post_id = get_option('page_for_posts'); }
	else { $firm_post_id = $post->ID; }
	$og_site_name = get_bloginfo('name');
	firm_fb_og_app_id();
	firm_fb_og_type($firm_post_id);
	echo '<meta property="og:site_name" content="'.$og_site_name.'" />'."\r\n";
	firm_fb_og_url($firm_post_id );
	firm_fb_og_title($firm_post_id);
	firm_fb_og_desc($firm_post_id);
	firm_fb_og_image($firm_post_id);
	firm_fb_og_locale($firm_post_id);
}
add_action('wp_head','firm_fb_og',2)
?>