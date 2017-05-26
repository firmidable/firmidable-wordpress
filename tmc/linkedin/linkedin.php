<?php
function firm_linkedin_funct() {
	wp_enqueue_script( 'linkedin_src', '//platform.linkedin.com/in.js', array(), null, true);
}
add_action( 'wp_enqueue_scripts','firm_linkedin_funct');	
?>