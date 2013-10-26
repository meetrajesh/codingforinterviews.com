<?php

function spiral_grid($h, $w, $r, $c) {

	$i = 0;
	$result[] = get_cell_id($h, $w, $r, $c);
	$move = 'up';
	$span = 1;
	$repeats = 0;

	$move_map = array('up' => 'left', 'left' => 'down', 'down' => 'right', 'right' => 'up');

	while (count($result) != ($h*$w)) {
		switch ($move) {
			case 'up';
				$r--;
				break;
			case 'left':
				$c--;
				break;
			case 'down':
				$r++;
				break;
			case 'right':
				$c++;
				break;
		}

		// calc new move
		if (++$repeats == $span) {
			$repeats = 0;
			if ($move == 'left' || $move == 'right') {
				$span++;
			}
			$move = $move_map[$move];
		} 

		if ($r > 0 && $r <= $h && $c > 0 && $c <= $w) {
			$result[] = get_cell_id($h, $w, $r, $c);
		}

	}
	
	return $result;

}

function get_cell_id($h, $w, $r, $c) {
	$cell_id = ($r-1)*$w + $c;
	return $cell_id;
}


// unit tests
$grid_problems[] = array(5, 5, 3, 3, array(13, 8, 7, 12, 17, 18, 19, 14, 9, 4, 3, 2, 1, 6, 11, 16, 21, 22, 23, 24, 25, 20, 15, 10, 5));
$grid_problems[] = array(2, 4, 1, 2, array(2, 1, 5, 6, 7, 3, 8, 4));

foreach ($grid_problems as $i => $grid_problem) {
	list($h, $w, $r, $c, $answer) = $grid_problem;
	$result = spiral_grid($h, $w, $r, $c);
	if ($result !== $answer) {
		die('tests fail at grid problem ' . ($i+1) . "\n");
	}
}
die('tests pass' . "\n");
