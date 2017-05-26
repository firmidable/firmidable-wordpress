<?php
function firm_callrail_funct() {
	$tmc_callrail_url = esc_attr( get_option( 'callrail_url' ) );
	wp_enqueue_script( 'callrail_src', $tmc_callrail_url, array(), null, true);
}
add_action( 'wp_enqueue_scripts','firm_callrail_funct');	
?>