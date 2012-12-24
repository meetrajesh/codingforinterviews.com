<?php

function merge_sort(array $arr) {

	switch (count($arr)) {
		case 0:
		case 1:
			return $arr;
		case 2:
			return $arr[0] < $arr[1] ? $arr : array_reverse($arr);
		default:
			// break the array into two halves
			$chunks = array_chunk($arr, ceil(count($arr) / 2));
			return merge_sorted_arrays(merge_sort($chunks[0]), merge_sort($chunks[1]));
	}

}

function merge_sorted_arrays() {

	$sorted_result = array_reduce(func_get_args(), function($a, $b) {

			$result = array();
			$i = $j = $k = 0;
			$len_a = count($a);
			$len_b = count($b);

			while ($i < $len_a || $j < $len_b) {

				if ($i == $len_a) {
					$result[$k] = $b[$j];
					$j++;
				} elseif ($j == $len_b) {
					$result[$k] = $a[$i];
					$i++;
				} elseif ($a[$i] <= $b[$j]) {
					$result[$k] = $a[$i];
					$i++;
				} elseif ($a[$i] > $b[$j]) {
					$result[$k] = $b[$j];
					$j++;
				} else {
					$result[$k] = $a[$i];
					$result[$k] = $b[$j];
					$i++; $j++;
				}

				$k++;

			}

			return $result;

		}, array());

	return $sorted_result;

}

// unit test

// var_dump(merge_sorted_arrays(array(1,2,4), array(3)));
// exit;

foreach (range(1,1000) as $i) {
	$question[] = mt_rand(0, 1000);
}

$answer = $question;
sort($answer);
var_dump(merge_sort($question) === $answer);