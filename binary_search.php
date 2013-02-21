<?php

function binary_search($array, $key, $min=null, $max=null) {

	$min = !$min ? 0 : $min;
	$max = !$max ? count($array) - 1 : $max;

	if ($key > $array[$max] || $key < $array[$min]) {
		return -1;
	}

	if ($key == $array[$min]) {
		return $min;
	} elseif ($key == $array[$max]) {
		return $max;
	}

	while (true) {

		$mid = (int) floor(($min + $max)/2);
	   
		if ($mid == $min || $mid == $max) {
			return -1;
		}

		if ($key == $array[$mid]) {
			while ($key == $array[--$mid]);
			return $mid + 1;
		} elseif ($key < $array[$mid]) {
			$max = $mid;
		} else {
			$min = $mid;
		}

	}

}

var_dump(binary_search(array(-10, -10, -2, 1, 5, 5, 8, 20), $argv[1]));