<?php

// check if the repeater field has rows of data
if (have_rows('repeater_field_name')) :
	 // loop through the rows of data
	while (have_rows('repeater_field_name')) :
		//unformatted
		the_row();

		//get the subfields in an array as key value where the key is the fiedl label instad of the field id
		$row = the_row(true);
		// display a sub field value
		the_sub_field('sub_field_name');
	endwhile;
else :
	// no rows found
endif;
