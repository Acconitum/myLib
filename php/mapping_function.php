<?php
/**
	 * calculates all bars, mapping heighest and lowest number between 100 and 305 pixels
	 * @author Marc Mentha <marc.mentha@cubetech.ch>
	 * @version 1.0
	 * @since Version 1.0.0
	 */
	private function mapValuesToPixels($value, $min, $max, $mapFrom, $mapTo) {

		// get difference between min and max as base
		// this value will refer as 100 percent
		$base = $max - $min;

		// get the difference between the actual value and the min value
		$difference = $value - $min;

		// prevent from dividing with 0
		if ($difference == 0){

			// no difference
			return $mapFrom;
		} else if ($difference === $base) {

			// same difference as base
			return $mapTo;
		} else {

			// calculate percentage of the difference and convert it to the same percentage of the pixel range
			$percent =  $difference / $base;
			$pixelRange = $mapTo - $mapFrom;

			return ($percent * $pixelRange) + $mapFrom;
		}
	}
	
