<?php
function firm_seo_setup() {
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'firm_seo_setup' );

function firm_separator_funct() {
	$firm_sep_field = esc_attr( get_option( 'firm_meta_sep' ) );
	if (isset($firm_sep_field)) { return $firm_sep_field; }
	else {return '|';}
}
add_filter( 'document_title_separator', 'firm_separator_funct', 10, 1 );

function firm_rewrite_title() {
	global $post;
	if (is_home()) {  $firm_post_id = get_option('page_for_posts'); }
	else { $firm_post_id = $post->ID; }
	$seo_full_title = get_post_meta( $firm_post_id, 'seo_full_title', true);
	return $seo_full_title;
}
if (isset($seo_full_title) && $seo_full_title!='') {
	add_filter('pre_get_document_title', 'firm_rewrite_title', 10);
}
function firm_keyword_title() {
	global $post;
	if (is_home()) {  $firm_post_id = get_option('page_for_posts'); }
	else { $firm_post_id = $post->ID; }
	$seo_keyword = get_post_meta( $firm_post_id, 'focus_kw', true);
	if (isset($seo_keyword) && $seo_keyword!='') {
		$title['title'] = $seo_keyword;
		$title['site'] = get_bloginfo('name');
	}
	else {
		if ( is_front_page() ){ 
			$title['site'] = get_bloginfo('name');
			$title['tagline'] = get_bloginfo('description');
		}
		else {
			$title['title'] =  get_the_title($firm_post_id);
		}
	}
	if ( !is_front_page() ) { $title['site'] = get_bloginfo('name'); }
	return $title;
}
add_filter( 'document_title_parts', 'firm_keyword_title', 1, 1 );

function firm_meta_desc() {
	global $post;
	if (is_home()) {  $firm_post_id = get_option('page_for_posts'); }
	else { $firm_post_id = $post->ID; }
	$meta_description = get_post_meta( $firm_post_id, 'meta_desc', true);
	if (is_single()) { $firm_excerpt = get_the_excerpt($firm_post_id); }
	elseif (is_page()) { 
		$page_object = get_page( $firm_post_id );
		$firm_page_content = $page_object->post_content;
		$firm_excerpt = rtrim(str_replace(array("\r", "\n"), ' ',substr(strip_tags($firm_page_content),0,155)))."...";
	}
	if (isset($meta_description) && $meta_description!='') {
		echo '<meta name="description" content="'.$meta_description.'" />';
		echo "\r\n";
	}
	elseif (isset($firm_excerpt) && $firm_excerpt!='') { 
		echo '<meta name="description" content="'.$firm_excerpt.'" />';
		echo "\r\n";
	}
}
	
add_action( 'wp_head', 'firm_meta_desc',1 );
?>