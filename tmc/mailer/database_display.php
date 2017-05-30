<?php
	global $wpdb;
	$table_name = $wpdb->prefix . 'firm_forms_storage';
	$firm_myrows = $wpdb->get_results( "SELECT * FROM $table_name" );
	$firm_db_col_array = $wpdb->get_col_info('name');
	echo '<table id="form_data">';
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
?>