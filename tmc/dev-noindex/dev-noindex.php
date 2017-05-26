<?php
	$tmc_dev_subdomain = esc_attr( get_option( 'dev_subdomain' ) );
	$tmc_match = "/^$tmc_dev_subdomain/";
	$tmc_current_domain = $_SERVER['SERVER_NAME'];
	function dev_noindex() {
		echo '<meta name="robots" content="noindex" />';
	}
	if (preg_match($tmc_match, $tmc_current_domain) != 0) {
		add_action( 'wp_head', 'dev_noindex' );
	}
?>