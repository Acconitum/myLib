<?php
function enqueue_appointment_scripts()
{
	   $url = plugins_url('assets/js/insert-data.js', $this->file);
	   wp_enqueue_script('ct-appointment', $url, array( 'jquery' ), false, true);
}
add_action('wp_enqueue_scripts', array( $this, 'enqueue_my_scripts'));
