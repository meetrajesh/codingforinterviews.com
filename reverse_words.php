<?php

$sols = array('in' => array('', 'X', 'X YZ', 'because I naughty naughty', 'The quick brown fox jumps over the lazy dogs.', 'Coding for Interviews contains too many gifs.'),
			  'out' => array('', 'X', 'YZ X', 'naughty naughty I because', 'dogs. lazy the over jumps fox brown quick The', 'gifs. many too contains Interviews for Coding'));

foreach ($sols['in'] as $i => $sentence) {
	if ($sentence) {
		$reversed_sentence = reverse_words($sentence);
		echo $sentence . "\n";
		echo $reversed_sentence . "\n\n";
		assert($reversed_sentence == $sols['out'][$i]);
	}
}

function reverse_words($sentence) {
	reverse_each_word($sentence);
	reverse_substring($sentence);
	return $sentence;
}

function reverse_each_word(&$sentence) {
	$start = 0;
	$len = strlen($sentence);
	for ($i=0; $i <= $len; $i++) {
		if ($i == $len || $sentence[$i] == ' ') {
			reverse_substring($sentence, $start, $i);
			$start = $i+1;
		}
	}
}

function reverse_substring(&$sentence, $start=0, $end=null) {
	$end = $end ?: strlen($sentence);
	for ($i=$start; $i < ($start+$end)/2; $i++) {
		swap_chars($sentence, $i, $start+$end-$i-1);
	}
}

function swap_chars(&$sentence, $i, $j) {
	$tmp = $sentence[$j];
	$sentence[$j] = $sentence[$i];
	$sentence[$i] = $tmp;
}
