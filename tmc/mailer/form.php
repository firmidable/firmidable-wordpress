<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
function form_output() {
	global $form_output;
	global $str_form_output;
	$form_output = array();
	$i=0; 
	foreach ($_POST as $key => $value) {
		global $$key;
		$$key = addslashes($value);
		$form_output[$i] = $key.': '.$value."\r\n";
		++$i;
	}
	$str_form_output = implode(' ',$form_output);
}
function form_database() {
	// post post to fields
	global $wpdb;
	global $form_output_db;
	$table_name = $wpdb->prefix . 'firm_forms_storage';
	
	$timestamp_value = current_time( 'mysql' );
	$form_output_db = $_POST;
	$form_output_db['timestamp'] = $timestamp_value;
	$wpdb->insert( 
		$table_name, 
		$form_output_db
	);
	/*$wpdb->insert( 
		$table_name, 
		array( 
			'timestamp' => current_time( 'mysql' ), 
			'name' => 'test name', 
			'email' => 'test@email.com',
			'how_can_i_help' => 'test you can\'t lol',
			'source' => 'test source',
			'medium' => 'test large',
			'keyword' => 'test wordkey',
			'page' => 'dat page u on',
			'url' => 'test u betta be blank brah',
		) 
	);*/
}
form_output();
if ($tmc_use_mailer_database === '1') {
	form_database();
}
function firmidable_mailer($to,$subject,$message,$headers,$form_output_db){
	$thank_you = "/".get_option( 'mailer_thankyoupage' )."/";
	$sorry_error = "/".get_option( 'mailer_errorpage' )."/";
	if(wp_mail($to,$subject,$message,$headers)) { 
		//print_r($form_output_db);
		header("Location: ".site_url($thank_you));
	}
	else { header("Location: ".site_url($sorry_error)); };
}
$recipients = esc_attr(get_option( 'mailer_recipients' ));
$domain = $_SERVER['SERVER_NAME'];
$subj = $domain.' Website Form Leads';
$body = $str_form_output;
$header = '';
form_output();
firmidable_mailer($recipients,$subj,$body,$header,$form_output_db);

?>