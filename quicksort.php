<?php

$list = array(6, 10, 13, 5, 8, 3, 2, 11);
$copy = $list;
quicksort($list);
sort($copy);
assert($copy == $list);

function quicksort(&$list) {
	if (count($list) > 1) {
		list($pivot, $lt, $gt) = partition($list);
		quicksort($lt);
		quicksort($gt);
		$list = array_merge($lt, array($pivot), $gt);
	}
}

function partition(&$list) {
	$lt = $gt = array();
	$pivot = $list[0];
	for ($i=1; $i < count($list); $i++) {
		if ($list[$i] <= $pivot) {
			$lt[] = $list[$i];
		} else {
			$gt[] = $list[$i];
		}
	}
	return array($pivot, $lt, $gt);
}
