<?php
function firm_jquery_enqueue() {
	wp_deregister_script('jquery');
	function add_jquery_sri_attributes($tag, $handle) {
		if ( 'jquery' !== $handle )
			return $tag;
		return str_replace( ' src', ' integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous" src', $tag );
	}
	wp_enqueue_script('jquery','https://code.jquery.com/jquery-3.1.1.min.js',false,null);
	add_filter('script_loader_tag', 'add_jquery_sri_attributes', 10, 2);
}
add_action( 'wp_enqueue_scripts','firm_jquery_enqueue');
?>