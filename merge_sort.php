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
			$i = $j = 0;
			while ($i < count($a) || $j < count($b)) {

				if (!isset($a[$i])) {
					$result[] = $b[$j];
					$j++;
				} elseif (!isset($b[$j])) {
					$result[] = $a[$i];
					$i++;
				} elseif ($a[$i] < $b[$j]) {
					$result[] = $a[$i];
					$i++;
				} elseif ($a[$i] > $b[$j]) {
					$result[] = $b[$j];
					$j++;
				} else {
					$result[] = $a[$i];
					$result[] = $b[$j];
					$i++; $j++;
				}
			}
			return $result;

		}, array());

	return $sorted_result;

}

// unit test
foreach (range(1,1000) as $i) {
	$question[] = mt_rand(0, 1000);
}

$answer = $question;
sort($answer);
var_dump(merge_sort($question) === $answer);