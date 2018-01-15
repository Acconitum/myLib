<?php
function get_special_messages()
{
	$timeNow = new DateTime();
	$timeToCompare = $timeNow->format('Ymd');
	$result = get_posts(array(
		'numberposts'	=> -1,
		'post_type'		=> 'special-message',
		'meta_query' => array(
			array(
				'key' => 'displayduration_start',
				'compare' => '<=',
				'value' => $timeToCompare,
			),
			array(
				'key' => 'displayduration_end',
				'compare' => '>=',
				'value' => $timeToCompare,
			),
		),
	));
	return $result;
}
