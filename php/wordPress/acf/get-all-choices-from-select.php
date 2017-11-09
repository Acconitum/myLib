<?php

$field = get_field_object('select_field', 1);

$choices = $field['choices'];

foreach ($choices as $choice) :
	echo $choice;
endforeach;
