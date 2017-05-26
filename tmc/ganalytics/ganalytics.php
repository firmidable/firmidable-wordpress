<?php

function firm_UA($uanumber, $domain) {
		$tmc_use_ab_tester = esc_attr( get_option( 'use_ab_tester' ) );
		if ($tmc_use_ab_tester != '1') { $async_analytics_code = "window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;ga('create', 'UA-$uanumber', '$domain');ga('require', 'displayfeatures');ga('require', 'linkid', 'linkid.js');ga('send', 'pageview');"; }
		else {$async_analytics_code = ''; }
		function add_async_attribute($tag, $handle) {
			if ( 'ganalytics_src' !== $handle )
				return $tag;
			return str_replace( ' src', ' async="async" src', $tag );
		}
		wp_enqueue_script( 'ganalytics_src', 'https://www.google-analytics.com/analytics.js', array(), null, false);
		wp_add_inline_script( 'ganalytics_src', $async_analytics_code, 'before' );
		add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
}
function firm_UA_funct() {
	$ua_domain = $_SERVER['SERVER_NAME'];
	$tmc_ua_code = esc_attr( get_option( 'ua_code' ) );
	firm_UA($tmc_ua_code, $ua_domain);
}
add_action( 'wp_enqueue_scripts','firm_UA_funct');
?>