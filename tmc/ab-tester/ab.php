<?php
function cookie_clicker($num_var) {
	if (isset($_COOKIE["Variant"])) { $variant = $_COOKIE["Variant"];}
	else {
		$variant = mt_rand(0,$num_var);
		setcookie("Variant", $variant, time()+2628000 );
		$_COOKIE["Variant"]=$variant;
	}
}
function cookie_funct() {
	$num_var_live =  esc_attr( get_option( 'ab_tester_num_var' ) );
	cookie_clicker($num_var_live);
}
function UA_AB($uanumber, $domain, $num_var, $dimension, $test) {
	if (isset($_COOKIE["Variant"])) { $variant = $_COOKIE["Variant"];}
	$async_analytics_code = "window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;ga('create', 'UA-$uanumber', '$domain');ga('require', 'displayfeatures');ga('require', 'linkid', 'linkid.js')";
	if($variant == 0){ $async_analytics_code .= "\n\t"."ga('set', 'dimension".$dimension."', 'Control');"; }
	else { $async_analytics_code .= "ga('set', 'dimension".$dimension."', '".$test." - ".$variant."');"; }
	$async_analytics_code .=  "ga('send', 'pageview');";
	wp_add_inline_script( 'ganalytics_src', $async_analytics_code, 'before' );
	add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
}
function UA_AB_funct() {
	$uanumber_live = esc_attr( get_option( 'ua_code' ) );
	$domain_live = $_SERVER['SERVER_NAME'];
	$num_var_live =  esc_attr( get_option( 'ab_tester_num_var' ) );
	$dimension_live =  esc_attr( get_option( 'ab_tester_custom_dim' ) );
	$test_live =  esc_attr( get_option( 'ab_tester_name' ) );
	UA_AB($uanumber_live, $domain_live, $num_var_live, $dimension_live, $test_live);
}
add_action( 'init', 'cookie_funct');
add_action( 'wp_enqueue_scripts', 'UA_AB_funct');


?>