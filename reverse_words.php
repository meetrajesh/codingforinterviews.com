<?php

$sentence = "Coding for Interviews contains too many gifs.";
echo $sentence . "\n";
echo reverse_words($sentence) . "\n";

function reverse_words($sentence) {
	reverse_words_in_sentence($sentence);
	reverse_sentence($sentence);
	return $sentence;
}

function reverse_words_in_sentence(&$sentence) {
	$start = 0;
	for ($i=0; $i < strlen($sentence); $i++) {
		if ($sentence[$i] == ' ') {
			reverse_word_in_sentence($sentence, $start, $i);
			$start = $i+1;
		}
	}
	// process last word
	reverse_word_in_sentence($sentence, $start, $i);
}

function reverse_sentence(&$sentence) {
	for ($i=0; $i < floor(strlen($sentence) / 2); $i++) {
		swap_chars($sentence, $i, strlen($sentence)-$i-1);
	}
}

function swap_chars(&$sentence, $i, $j) {
	$tmp = $sentence[$j];
	$sentence[$j] = $sentence[$i];
	$sentence[$i] = $tmp;
}

function reverse_word_in_sentence(&$sentence, $start, $end) {
	for ($i=$start; $i < $start + floor(($end-$start)/2); $i++) {
		// echo $i . ' ' . ($end+$start-$i-1) . "\n";
		swap_chars($sentence, $i, $end+$start-$i-1);
	}
}
