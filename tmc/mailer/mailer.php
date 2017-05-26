<?php
global $wpdb;
global $firm_sql;
function firm_ga($uanumber, $domain) {
		$ga_analytics_code = "var _gaq = _gaq || [];_gaq.push(['_setAccount', 'UA-$uanumber']);_gaq.push(['_trackPageview']);(function() { var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);})();";
		wp_add_inline_script( 'ganalytics_src', $ga_analytics_code, 'after' );
}
function firm_mailer_funct() {
	$ua_domain = $_SERVER['SERVER_NAME'];
	$tmc_ua_code = esc_attr( get_option( 'mailer_ua_code' ) );
	$mailer_js_url = plugins_url( 'js/mailer.js', __FILE__ );
	wp_enqueue_script( 'jquery_validate', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js', array('jquery'), null, false);
	wp_enqueue_script( 'firm_mailer', $mailer_js_url, array('jquery_validate'), null, true);
	firm_ga($tmc_ua_code, $ua_domain);
}
add_action( 'wp_enqueue_scripts','firm_mailer_funct');
if ($tmc_use_mailer_smtp === '1') {
	function firm_phpmailer_smtp( $phpmailer ) {
		$smtphost = esc_attr( get_option('mailer_smtphost'));
		$smtpport = intval(esc_attr(get_option('mailer_smtpport')));
		$smtpuser = esc_attr( get_option( 'mailer_smtpuser' ) );
		$smtppass = esc_attr( get_option( 'mailer_smtppass' ) );
		$smtpsecurity = esc_attr( get_option( 'mailer_smtpsecurity' ) );
		$smtpfrom = esc_attr( get_option( 'mailer_smtpfrom' ) );
		$smtpname = esc_attr( get_option( 'mailer_smtpname' ) );
		$phpmailer->isSMTP();     
		$phpmailer->Host = $smtphost;
		$phpmailer->SMTPAuth = true;
		$phpmailer->Port = $smtpport;
		$phpmailer->Username = $smtpuser;
		$phpmailer->Password = $smtppass;
		$phpmailer->SMTPSecure = $smtpsecurity;
		$phpmailer->From = $smtpfrom;
		$phpmailer->FromName = $smtpname;
	}
	add_action( 'phpmailer_init', 'firm_phpmailer_smtp' );
}
$tmc_use_mailer_database = esc_attr( get_option( 'use_mailer_database' ) );
if ($tmc_use_mailer_database === '1') {
	$firm_db_fields = esc_attr( get_option( 'mailer_database_fields' ) );
	$firm_db_field_array = explode(" ", $firm_db_fields);
	$firm_table_name = $wpdb->prefix . 'firm_forms_storage';
	$firm_sql = "CREATE TABLE $firm_table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		timestamp datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,\n\r";
	foreach ($firm_db_field_array as $fields) { 
		$field_string = "$fields text NOT NULL,\n\r";
		$firm_sql .= $field_string;
	}
	$firm_sql .= "source tinytext NOT NULL,
		medium tinytext NOT NULL,
		keyword tinytext NOT NULL,
		page tinytext NOT NULL,
		url tinytext NOT NULL,
		PRIMARY KEY  (id)
	);";
	function firm_update_fields($sql_call) {
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql_call );
	}
	if (isset($firm_db_fields) && $firm_db_fields != '' && $_GET['settings-updated']=='true') {
		// USING $_GET IS $_KLUDGY_AS_FUQ
		firm_update_fields($firm_sql);
	}
}
?>