<?php
function firm_ngage_funct() {
	$tmc_ngage_website_id = esc_attr( get_option( 'ngage_url' ) );
	$tmc_ngage_url = "https://messenger.ngageics.com/ilnksrvr.aspx?websiteid=".$tmc_ngage_website_id;
	function add_async_attribute_2($tag, $handle) {
		if ( 'ngage_src' !== $handle )
			return $tag;
		return str_replace( ' src', ' async="async" src', $tag );
	}
	wp_enqueue_script( 'ngage_src', $tmc_ngage_url, array(), null, true);
	add_filter('script_loader_tag', 'add_async_attribute_2', 10, 2);
}
function firm_ngage_div() {
	echo '<div id="nGageLH" style="visibility:hidden; display: block; padding: 0; position: fixed; right: 0px; bottom: 0px; z-index: 5000;"></div>';
}
add_action('wp_footer','firm_ngage_div');
add_action( 'wp_enqueue_scripts','firm_ngage_funct');	
?>