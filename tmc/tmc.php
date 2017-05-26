<?php
/*
Plugin Name: Firmidable
Plugin URI: https://firmidable.com
Description: Alpha build of Firmidable WordPress launcher. Includes common functions and installs.
Version: 0.0.06
Author: dthomas
Author URI: https://ferkungamaboobo.com
License: proprietary
License URI: proprietary
Text Domain: none
Domain Path: /na
*/

// Initializes
add_action('admin_menu', 'firmidable_add_pages');
add_action('admin_init', 'firmidable_register_settings');

// Adds backend pages
function firmidable_add_pages() {
    add_menu_page('Firmidable Settings Page', 'Firmidable', 'manage_options', 'firmidable', 'firmidable_settings_page');
    add_submenu_page('firmidable','Metadata Settings Page', 'Metadata', 'manage_options', 'metadata', 'metadata_settings_page');
    add_submenu_page('firmidable','Mailer Settings Page', 'Mailer', 'manage_options', 'mailer', 'mailer_settings_page');
    add_submenu_page('firmidable','Lead Tracking Setting Page', 'Lead Tracking', 'manage_options', 'lead_tracking', 'lead_tracking_settings_page');
    add_submenu_page('firmidable','Analytics Settings Page', 'Analytics', 'manage_options', 'analytics', 'analytics_settings_page');
    add_submenu_page('firmidable','A/B Tester Settings Page', 'A/B Tester', 'manage_options', 'ab_tester', 'ab_tester_settings_page');
    add_submenu_page('firmidable','Social Plugin Settings Page', 'Social Plugins', 'manage_options', 'social_plugin', 'social_plugin_settings_page');
	if (esc_attr( get_option( 'use_mailer_database' ) ) === '1') {add_menu_page('Form Submissions','Firmidable Form Submissions','manage_options','database','database_settings_page');}
}

// Register settings & add settings sections & fields
function firmidable_register_settings(){
	register_setting( 'firmidable_options', 'use_jquery');
	register_setting( 'firmidable_options', 'use_head_cleaner');
	register_setting( 'firmidable_options', 'use_dev_noindex');
	register_setting( 'firmidable_options', 'dev_subdomain');
	register_setting( 'lead_tracking_options', 'use_callrail');
	register_setting( 'lead_tracking_options', 'callrail_url');
	register_setting( 'lead_tracking_options', 'use_ngage');
	register_setting( 'lead_tracking_options', 'ngage_url');
	register_setting( 'social_plugin_options', 'use_linkedin');
	register_setting( 'analytics_options', 'use_ganalytics');
	register_setting( 'analytics_options', 'ua_code');
	register_setting( 'analytics_options', 'use_facebook');
	register_setting( 'analytics_options', 'facebook_pixel_id');
	register_setting( 'metadata_options', 'use_firm_meta');
	register_setting( 'metadata_options', 'firm_meta_sep');
	register_setting( 'metadata_options', 'use_fb_og');
	register_setting( 'metadata_options', 'fb_og_app_id');
	register_setting( 'metadata_options', 'fb_og_image_default');
	register_setting( 'metadata_options', 'use_twitter_card');
	register_setting( 'metadata_options', 'twitter_card_site');
	register_setting( 'metadata_options', 'twitter_card_image_default');
	register_setting( 'mailer_options', 'use_mailer');
	register_setting( 'mailer_options', 'mailer_ua_code');
	register_setting( 'mailer_options', 'mailer_recipients');
	register_setting( 'mailer_options', 'mailer_thankyoupage');
	register_setting( 'mailer_options', 'mailer_errorpage');
	register_setting( 'mailer_options', 'use_mailer_smtp');
	register_setting( 'mailer_options', 'mailer_smtphost');
	register_setting( 'mailer_options', 'mailer_smtpport');
	register_setting( 'mailer_options', 'mailer_smtpuser');
	register_setting( 'mailer_options', 'mailer_smtppass');
	register_setting( 'mailer_options', 'mailer_smtpsecurity');
	register_setting( 'mailer_options', 'mailer_smtpfrom');
	register_setting( 'mailer_options', 'mailer_smtpname');
	register_setting( 'mailer_options', 'use_mailer_database');
	register_setting( 'mailer_options', 'mailer_database_fields');
	register_setting( 'ab_tester_options', 'use_ab_tester');
	register_setting( 'ab_tester_options', 'ab_tester_num_var');
	register_setting( 'ab_tester_options', 'ab_tester_custom_dim');
	register_setting( 'ab_tester_options', 'ab_tester_name');
    add_settings_section( 'jquery', 'jQuery Settings', 'use_jquery_infotext', 'firmidable' );
    add_settings_field( 'use_jquery_field', 'Load jQuery', 'use_jquery_field_input', 'firmidable', 'jquery' );
    add_settings_section( 'head_cleaner', 'Wordpress Head Cleaner', 'head_cleaner_infotext', 'firmidable' );
    add_settings_field( 'head_cleaner_field', 'Use Head Cleaner', 'head_cleaner_field_input', 'firmidable', 'head_cleaner' );
    add_settings_section( 'dev_noindex', 'Dev Site NoIndex', 'dev_noindex_infotext', 'firmidable' );
    add_settings_field( 'dev_noindex_field', 'Use Dev NoIndex', 'dev_noindex_field_input', 'firmidable', 'dev_noindex' );
	add_settings_field( 'dev_subdomain_field', 'Dev Site Subdomain', 'dev_subdomain_field_input', 'firmidable', 'dev_noindex' );
    add_settings_section( 'callrail', 'CallRail', 'callrail_infotext', 'firmidable_lead_tracking' );
    add_settings_field( 'callrail_use_field', 'Use Callrail', 'callrail_use_input', 'firmidable_lead_tracking', 'callrail' );
    add_settings_field( 'callrail_url_field', 'CallRail JS URL', 'callrail_url_input', 'firmidable_lead_tracking', 'callrail' );
    add_settings_section( 'ngage', 'nGage', 'ngage_infotext', 'firmidable_lead_tracking' );
    add_settings_field( 'ngage_use_field', 'Use nGage', 'ngage_use_input', 'firmidable_lead_tracking', 'ngage' );
    add_settings_field( 'ngage_url_field', 'nGage Website ID', 'ngage_url_input', 'firmidable_lead_tracking', 'ngage' );
    add_settings_section( 'linkedin', 'LinkedIn JS', 'linkedin_infotext', 'firmidable_social_plugin' );
    add_settings_field( 'linkedin_field', 'Use LinkedIn JS', 'linkedin_field_input', 'firmidable_social_plugin', 'linkedin' );
    add_settings_section( 'ganalytics', 'Google Analytics', 'ganalytics_infotext', 'firmidable_analytics' );
    add_settings_field( 'ganalytics_use_field', 'Use Google Analytics', 'ganalytics_use_input', 'firmidable_analytics', 'ganalytics' );
    add_settings_field( 'ganalytics_ua_code_field', 'UA-Code', 'ganalytics_ua_code_input', 'firmidable_analytics', 'ganalytics' );
    add_settings_section( 'fb_pixel', 'Facebook Pixel', 'facebook_pixel_infotext', 'firmidable_analytics' );
    add_settings_field( 'fb_pixel_use_field', 'Use Facebook Pixel', 'fb_pixel_use_input', 'firmidable_analytics', 'fb_pixel' );
    add_settings_field( 'fb_pixel_id_field', 'Facebook Pixel ID', 'fb_pixel_id_input', 'firmidable_analytics', 'fb_pixel' );
    add_settings_section( 'firm_meta', 'SEO Meta Tags', 'firm_meta_infotext', 'firmidable_metadata' );
    add_settings_field( 'firm_meta_use_field', 'Use Firmidable Meta Tags', 'firm_meta_use_input', 'firmidable_metadata', 'firm_meta' );
    add_settings_field( 'firm_meta_sep_field', 'Title Tag Separator', 'firm_meta_sep_input', 'firmidable_metadata', 'firm_meta' );
    add_settings_section( 'fb_og', 'Open Graph Settings', 'fb_og_infotext', 'firmidable_metadata' );
    add_settings_field( 'fb_og_use_field', 'Use Open Graph Tags', 'fb_og_use_input', 'firmidable_metadata', 'fb_og' );
    add_settings_field( 'fb_og_app_id_field', 'Facebook App ID', 'fb_og_app_id_input', 'firmidable_metadata', 'fb_og' );
    add_settings_field( 'fb_og_image_default_field', 'Default OG Image', 'fb_og_image_default_input', 'firmidable_metadata', 'fb_og' );
    add_settings_section( 'twitter_card', 'Twitter Card Settings', 'twitter_card_infotext', 'firmidable_metadata' );
    add_settings_field( 'twitter_card_use_field', 'Use Twitter Card Tags', 'twitter_card_use_input', 'firmidable_metadata', 'twitter_card' );
    add_settings_field( 'twitter_card_site_field', 'Twitter Username', 'twitter_card_site_input', 'firmidable_metadata', 'twitter_card' );
    add_settings_field( 'twitter_card_image_default_field', 'Default Twitter Card Image', 'twitter_card_image_default_input', 'firmidable_metadata', 'twitter_card' );
    add_settings_section( 'mailer', 'Firmidable Mailer', 'mailer_infotext', 'firmidable_mailer' );
    add_settings_field( 'mailer_field', 'Use Firmidable Mailer', 'mailer_field_input', 'firmidable_mailer', 'mailer' );
    add_settings_field( 'mailer_ua_code_field', 'UA-Code', 'mailer_ua_code_input', 'firmidable_mailer', 'mailer' );
    add_settings_field( 'mailer_recipients_field', 'Recipients', 'mailer_recipients_input', 'firmidable_mailer', 'mailer' );
    add_settings_field( 'mailer_thankyoupage_field', 'Thank You Page', 'mailer_thankyoupage_input', 'firmidable_mailer', 'mailer' );
    add_settings_field( 'mailer_errorpage_field', 'Error Page', 'mailer_errorpage_input', 'firmidable_mailer', 'mailer' );
    add_settings_section( 'mailer_smtp', 'Mailer SMTP Settings', 'mailer_smtp_infotext', 'firmidable_mailer' );
    add_settings_field( 'mailer_smtp_field', 'Use SMTP', 'mailer_smtp_input', 'firmidable_mailer', 'mailer_smtp' );
    add_settings_field( 'mailer_smtphost_field', 'SMTP Host', 'mailer_smtphost_input', 'firmidable_mailer', 'mailer_smtp' );
    add_settings_field( 'mailer_smtpport_field', 'SMTP Port', 'mailer_smtpport_input', 'firmidable_mailer', 'mailer_smtp' );
    add_settings_field( 'mailer_smtpuser_field', 'SMTP User', 'mailer_smtpuser_input', 'firmidable_mailer', 'mailer_smtp' );
    add_settings_field( 'mailer_smtppass_field', 'SMTP Password', 'mailer_smtppass_input', 'firmidable_mailer', 'mailer_smtp' );
    add_settings_field( 'mailer_smtpsecurity_field', 'SMTP Security', 'mailer_smtpsecurity_input', 'metadata_options', 'mailer_smtp' );
    add_settings_field( 'mailer_smtpfrom_field', 'SMTP From Email', 'mailer_smtpfrom_input', 'metadata_options', 'mailer_smtp' );
    add_settings_field( 'mailer_smtpname_field', 'SMTP From Name', 'mailer_smtpname_input', 'metadata_options', 'mailer_smtp' );
    add_settings_section( 'mailer_database', 'Mailer Database Settings', 'mailer_database_infotext', 'firmidable_mailer' );
    add_settings_field( 'mailer_database_field', 'Store Form Submissions', 'mailer_database_input', 'firmidable_mailer', 'mailer_database' );
    add_settings_field( 'mailer_database_fields', 'Database Fields', 'mailer_database_fields_input', 'firmidable_mailer', 'mailer_database' );
	add_settings_section( 'ab_tester', 'Firmidable A/B Tester', 'ab_tester_infotext', 'firmidable_ab_tester' );
    add_settings_field( 'ab_tester_use_field', 'Use Firmidable A/B Tester', 'ab_tester_use_field_input', 'firmidable_ab_tester', 'ab_tester' );
    add_settings_field( 'ab_tester_num_var_field', 'Number of Variants in Test', 'ab_tester_num_var_field_input', 'firmidable_ab_tester', 'ab_tester' );
    add_settings_field( 'ab_tester_custom_dim_field', 'Custom Dimension Number', 'ab_tester_custom_dim_field_input', 'firmidable_ab_tester', 'ab_tester' );
    add_settings_field( 'ab_tester_name_field', 'Test Name', 'ab_tester_name_field_input', 'firmidable_ab_tester', 'ab_tester' );

}

// Content for settings sections & 
function use_jquery_infotext() { echo 'This rewrites jQuery to run from a CDN and includes it.'; }
function use_jquery_field_input() {
    $setting = esc_attr( get_option( 'use_jquery' ) );
    echo "<input type='checkbox' name='use_jquery' ".checked( $setting, 1, false )." value='1' />";
}
function head_cleaner_infotext() { echo 'This installs the WordPress head cleaner. See howto.'; }
function head_cleaner_field_input() {
    $setting = esc_attr( get_option( 'use_head_cleaner' ) );
    echo "<input type='checkbox' name='use_head_cleaner' ".checked( $setting, 1, false )." value='1' />";
}
function dev_noindex_infotext() { echo 'This installs the Dev Site NoIndex meta robots. See howto.'; }
function dev_noindex_field_input() {
    $setting = esc_attr( get_option( 'use_dev_noindex' ) );
    echo "<input type='checkbox' name='use_dev_noindex' ".checked( $setting, 1, false )." value='1' />";
}
function dev_subdomain_field_input() {
	$setting = esc_attr( get_option( 'dev_subdomain' ) );
    echo "<input type='text' placeholder='dev' name='dev_subdomain' value='$setting' />";
}
function ganalytics_infotext() { echo 'This installs Google Analytics. See howto.'; }
function ganalytics_use_input() {
    $setting = esc_attr( get_option( 'use_ganalytics' ) );
    echo "<input type='checkbox' name='use_ganalytics' ".checked( $setting, 1, false )." value='1' />";
}

function ganalytics_ua_code_input() {
    $setting = esc_attr( get_option( 'ua_code' ) );
    echo "UA-<input type='text' placeholder='########-##' name='ua_code' value='$setting' />";
}
function firm_meta_infotext() { echo 'This installs SEO Metadata. See howto.'; }
function firm_meta_use_input() {
    $setting = esc_attr( get_option( 'use_firm_meta' ) );
    echo "<input type='checkbox' name='use_firm_meta' ".checked( $setting, 1, false )." value='1' />";
}
function firm_meta_sep_input() {
    $setting = esc_attr( get_option( 'firm_meta_sep' ) );
    echo "<input type='text' placeholder='|' name='firm_meta_sep' value='$setting' />";
}
function fb_og_infotext() { echo 'This installs Facebook Opengraph Tags. See howto.'; }
function fb_og_use_input() {
    $setting = esc_attr( get_option( 'use_fb_og' ) );
    echo "<input type='checkbox' name='use_fb_og' ".checked( $setting, 1, false )." value='1' />";
}
function fb_og_app_id_input() {
    $setting = esc_attr( get_option( 'fb_og_app_id' ) );
    echo "<input type='text' placeholder='###############' name='fb_og_app_id' value='$setting' />";
}
function fb_og_image_default_input() {
    $setting = esc_attr( get_option( 'fb_og_image_default' ) );
    echo "<input type='text' placeholder='http://local-url.com/image.jpg' name='fb_og_image_default' value='$setting' />";
}
function twitter_card_infotext() { echo 'This installs Twitter Card Tags. See howto.'; }
function twitter_card_use_input() {
    $setting = esc_attr( get_option( 'use_twitter_card' ) );
    echo "<input type='checkbox' name='use_twitter_card' ".checked( $setting, 1, false )." value='1' />";
}
function twitter_card_site_input() {
    $setting = esc_attr( get_option( 'twitter_card_site' ) );
    echo "@<input type='text' placeholder='username' name='twitter_card_site' value='$setting' />";
}
function twitter_card_image_default_input() {
    $setting = esc_attr( get_option( 'twitter_card_image_default' ) );
    echo "<input type='text' placeholder='http://local-url.com/image.jpg' name='twitter_card_image_default' value='$setting' />";
}
function callrail_infotext() { echo 'This installs CallRail. See howto.'; }
function callrail_use_input() {
    $setting = esc_attr( get_option( 'use_callrail' ) );
    echo "<input type='checkbox' name='use_callrail' ".checked( $setting, 1, false )." value='1' />";
}
function callrail_url_input() {
    $setting = esc_attr( get_option( 'callrail_url' ) );
    echo "&lt;script type='text/javascript' src='<input type='text' placeholder='//cdn.callrail.com/companies/########/4lph4num3r1c/##/swap.js' name='callrail_url' value='$setting' />'&gt;&lt;/script&gt;";
}
function ngage_infotext() { echo 'This installs nGage. See howto.'; }
function ngage_use_input() {
    $setting = esc_attr( get_option( 'use_ngage' ) );
    echo "<input type='checkbox' name='use_ngage' ".checked( $setting, 1, false )." value='1' />";
}
function ngage_url_input() {
    $setting = esc_attr( get_option( 'ngage_url' ) );
    echo "&lt;script type='text/javascript' src='https://messenger.ngageics.com/ilnksrvr.aspx?websiteid=<input type='text' placeholder='###-###-##-###-##-###-###-###' name='ngage_url' value='$setting' />' async='async'&gt;&lt;/script&gt;";
	}
function linkedin_infotext() { echo 'This installs the LinkedIn JS Code.'; }
function linkedin_field_input() {
    $setting = esc_attr( get_option( 'use_linkedin' ) );
    echo "<input type='checkbox' name='use_linkedin' ".checked( $setting, 1, false )." value='1' />";
}
function facebook_pixel_infotext() { echo 'This installs Facebook Pixel. See howto.'; }
function fb_pixel_use_input() {
    $setting = esc_attr( get_option( 'use_facebook' ) );
    echo "<input type='checkbox' name='use_facebook' ".checked( $setting, 1, false )." value='1' />";
}
function fb_pixel_id_input() {
    $setting = esc_attr( get_option( 'facebook_pixel_id' ) );
    echo "<input type='text' placeholder='################' name='facebook_pixel_id' value='$setting' />";
}
function mailer_infotext() { echo 'This installs the Proprietary Firmidable Mailer Code.'; }
function mailer_field_input() {
    $setting = esc_attr( get_option( 'use_mailer' ) );
    echo "<input type='checkbox' name='use_mailer' ".checked( $setting, 1, false )." value='1' />";
}
function mailer_database_fields_input() {
    $setting = esc_attr( get_option( 'mailer_database_fields' ) );
    echo "<input type='text' placeholder='name zip phone email' name='mailer_database_fields' value='$setting' />";
}
function mailer_ua_code_input() {
    $setting = esc_attr( get_option( 'mailer_ua_code' ) );
    echo "UA-<input type='text' placeholder='########-##' name='mailer_ua_code' value='$setting' />";
}
function mailer_recipients_input() {
    $setting = esc_attr( get_option( 'mailer_recipients' ) );
    echo "<input type='text' placeholder='example@example.com,example2@example2.net' name='mailer_recipients' value='$setting' />";
}
function mailer_thankyoupage_input() {
    $setting = esc_attr( get_option( 'mailer_thankyoupage' ) );
	echo site_url()."/"."<input type='text' placeholder='thank-you-slug' name='mailer_thankyoupage' value='$setting' />"."/";
}
function mailer_errorpage_input() {
    $setting = esc_attr( get_option( 'mailer_errorpage' ) );
    echo site_url()."/"."<input type='text' placeholder='sorry-error-slug' name='mailer_errorpage' value='$setting' />"."/";
}
function mailer_smtp_infotext() { echo 'This provides the information for SMTP.'; }
function mailer_smtp_input() {
    $setting = esc_attr( get_option( 'use_mailer_smtp' ) );
    echo "<input type='checkbox' name='use_mailer_smtp' ".checked( $setting, 1, false )." value='1' />";
}
function mailer_smtphost_input() {
    $setting = esc_attr( get_option( 'mailer_smtphost' ) );
    echo "<input type='text' placeholder='smtp.office365.com' name='mailer_smtphost' value='$setting' />";
}
function mailer_smtpport_input() {
    $setting = esc_attr( get_option( 'mailer_smtpport' ) );
    echo "<input type='text' placeholder='25' name='mailer_smtpport' value='$setting' />";
}
function mailer_smtpuser_input() {
    $setting = esc_attr( get_option( 'mailer_smtpuser' ) );
    echo "<input type='text' placeholder='username' name='mailer_smtpuser' value='$setting' />";
}
function mailer_smtppass_input() {
    $setting = esc_attr( get_option( 'mailer_smtppass' ) );
    echo "<input type='text' placeholder='password' name='mailer_smtppass' value='$setting' />";
}
function mailer_smtpsecurity_input() {
    $setting = esc_attr( get_option( 'mailer_smtpsecurity' ) );
    echo "<select name='mailer_smtpsecurity'><option value='tls' ";
	selected( get_option( 'mailer_smtpsecurity' ),'tls');
	echo ">TLS</option><option value='ssl'";
	selected( get_option( 'mailer_smtpsecurity' ),'ssl');
	echo ">SSL</option></select>";
}
function mailer_smtpfrom_input() {
    $setting = esc_attr( get_option( 'mailer_smtpfrom' ) );
    echo "<input type='text' placeholder='example@example.com' name='mailer_smtpfrom' value='$setting' />";
}
function mailer_smtpname_input() {
    $setting = esc_attr( get_option( 'mailer_smtpname' ) );
    echo "<input type='text' placeholder='Sender Name' name='mailer_smtpname' value='$setting' />";
}
function mailer_database_infotext() { echo 'This adds database storage of form submissions.'; }
function mailer_database_input() {
    $setting = esc_attr( get_option( 'use_mailer_database' ) );
    echo "<input type='checkbox' name='use_mailer_database' ".checked( $setting, 1, false )." value='1' />";
}
function ab_tester_infotext() { echo 'This installs the Firmidable Google Analytics A/B Tester.'; }
function ab_tester_use_field_input() {
    $setting = esc_attr( get_option( 'use_ab_tester' ) );
    echo "<input type='checkbox' name='use_ab_tester' ".checked( $setting, 1, false )." value='1' />";
}
function ab_tester_num_var_field_input() {
    $setting = esc_attr( get_option( 'ab_tester_num_var' ) );
    echo "<input type='number' placeholder='#' name='ab_tester_num_var' value='$setting' />";
}
function ab_tester_custom_dim_field_input() {
    $setting = esc_attr( get_option( 'ab_tester_custom_dim' ) );
    echo "<input type='number' placeholder='#' name='ab_tester_custom_dim' value='$setting' />";
}
function ab_tester_name_field_input() {
    $setting = esc_attr( get_option( 'ab_tester_name' ) );
    echo "<input type='text' placeholder='Test Name' name='ab_tester_name' value='$setting' />";
}
// Displays the page content
function firmidable_options_page_html() {?>
	<div class="wrap">
		<h1>Firmidable Options</h1>
	</div>
<?php }
function firmidable_settings_page() { ?>
	<div class="wrap">
		<h1>Firmidable Settings Page</h1>
		<p>These are settings for various Firmidable WordPress functions.</p>
		<form action="options.php" method="POST">
			<?php settings_fields('firmidable_options'); ?>
			<?php do_settings_sections('firmidable'); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php }
function mailer_settings_page() { ?>
	<div class="wrap">
		<h1>Form System Settings Page</h1>
		<p>These are settings for various Firmidable Form System functions.</p>
		<form action="options.php" method="POST">
			<?php settings_fields('mailer_options'); ?>
			<?php do_settings_sections('firmidable_mailer'); ?>
			<?php do_settings_sections('firmidable_mailer_smpt'); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php }
function metadata_settings_page() { ?>
	<div class="wrap">
		<h1>Metadata Settings Page</h1>
		<p>These are settings for various Firmidable Metadata functions.</p>
		<form action="options.php" method="POST">
			<?php settings_fields('metadata_options'); ?>
			<?php do_settings_sections('firmidable_metadata'); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php }
function social_plugin_settings_page() { ?>
	<div class="wrap">
		<h1>Social Plugins Settings Page</h1>
		<p>These are settings for various social plugin integration functions.</p>
		<form action="options.php" method="POST">
			<?php settings_fields('social_plugin_options'); ?>
			<?php do_settings_sections('firmidable_social_plugin'); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php }
function lead_tracking_settings_page() { ?>
	<div class="wrap">
		<h1>Lead Tracking Settings Page</h1>
		<p>These are settings for various lead tracking integration functions.</p>
		<form action="options.php" method="POST">
			<?php settings_fields('lead_tracking_options'); ?>
			<?php do_settings_sections('firmidable_lead_tracking'); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php }
function analytics_settings_page() { ?>
	<div class="wrap">
		<h1>Analytics Settings Page</h1>
		<p>These are settings for various Firmidable Analytics functions.</p>
		<form action="options.php" method="POST">
			<?php settings_fields('analytics_options'); ?>
			<?php do_settings_sections('firmidable_analytics'); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php }
function ab_tester_settings_page() { ?>
	<div class="wrap">
		<h1>A/B Tester System Settings Page</h1>
		<p>These are settings for the A/B tester</p>
		<form action="options.php" method="POST">
			<?php settings_fields('ab_tester_options'); ?>
			<?php do_settings_sections('firmidable_ab_tester'); ?>
			<?php submit_button(); ?>
		</form>
	</div>
<?php }
function database_settings_page() { ?>
	<div class="wrap">
		<h1>Form Submissions</h1>
		<p>See all form submissions below:</p>
		<?php require 'mailer/database_display.php';?>
	</div>
<?php }
require 'tmc-get-options.php';
// Does stuff?
if($tmc_use_jquery === '1') { require 'jquery/jquery.php'; }
if($tmc_use_dev_noindex === '1') { require 'dev-noindex/dev-noindex.php'; }
if($tmc_use_head_cleaner === '1') { require 'head-cleaner/head-cleaner.php'; }
if($tmc_use_ganalytics === '1') { require 'ganalytics/ganalytics.php'; }
if($tmc_use_callrail === '1') { require 'callrail/callrail.php'; }
if($tmc_use_ngage === '1') { require 'ngage/ngage.php'; }
if($tmc_use_linkedin === '1') { require 'linkedin/linkedin.php'; }
if($tmc_use_facebook === '1') { require 'facebook/facebook.php'; }
if($tmc_use_mailer === '1') { require 'mailer/mailer.php'; }
if($tmc_use_seo_meta === '1') { require 'metadata/seo_meta.php'; }
if($tmc_use_fb_og === '1') { require 'metadata/fb_og.php'; }
if($tmc_use_twitter_card === '1') { require 'metadata/twitter_card.php'; }
if($tmc_use_ab_tester === '1') { require 'ab-tester/ab.php'; }
?>