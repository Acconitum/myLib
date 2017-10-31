<?php
public function displayOptions()
{
	  add_options_page(
		  __('Appointments Options', 'wpplugin.appointments'),
		  __('Appointments Options', 'wpplugin.appointments'),
		  'manage_options',
		  'appointment_options',
		  array(
		  $this,
		  'renderOptionsPage'
		  )
	  );
}

public function displayOptionsFields()
{
	add_settings_section('options_section', __('Settings', 'wpplugin.appointments'), null, 'appointment_options');

	add_settings_field(
		'ct_enabled_weekdays',
		_x('Select Weekdays', 'Appointment options enabled weekdays', 'wpplugin.appointments'),
		array($this, 'displayEnabledRadioWeekday'),
		'appointment_options',
		'options_section'
	);

	add_settings_field(
		'ct_time_span_start',
		_x('Define start time', 'Appointment options starting time per day where appointments can be made', 'wpplugin.appointments'),
		array($this, 'displayTimeSpanStart'),
		'appointment_options',
		'options_section'
	);

	register_setting('options_section', 'ct_enabled_weekdays');
	register_setting('options_section', 'ct_time_span_start');
}

public function renderOptionsPage()
{
	if (!current_user_can('manage_options')) {
		return;
	}
	?>
	<section class="wrap">
	<header>            
	<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
		</header>
		<form action="options.php" method="post">
		<?php
		settings_fields('options_section');
		do_settings_sections('appointment_options');
		submit_button();
		?>
		</form>
		</section>
		<?php
}