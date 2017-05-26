<?php
	global $wpdb;
	$table_name = $wpdb->prefix . 'firm_forms_storage';
	$firm_myrows = $wpdb->get_results( "SELECT * FROM $table_name" );
	$firm_db_col_array = $wpdb->get_col_info('name');
	echo '<table>';
	echo '<tr>';
	foreach ($firm_db_col_array as $fields) {
		echo '<th>';
		echo $fields;
		echo '</th>';
	}
	echo '</tr>';
	foreach ($firm_myrows as $myrow) {
		echo '<tr>';
		foreach ($myrow as $cell) {
			echo '<td>';
			echo $cell;
			echo '</td>';
		}
		echo '</tr>';
	}
	echo '</table>';
	/* function database_display_css() {
		if ( $hook != 'toplevel_page_database' ) {
			return;
		}
		$database_display_css = plugins_url( 'css/database_display.css', dirname(__FILE__) );
		wp_enqueue_style('database_display',$database_display_css);
	}
	add_action( 'admin_enqueue_scripts', 'database_display_css'); */
?>