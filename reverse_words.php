<?php

$sentence = "Coding for Interviews contains too many gifs.";
$reversed_sentence = reverse_words($sentence);

echo $sentence . "\n";
echo $reversed_sentence . "\n";

assert($reversed_sentence == "gifs. many too contains Interviews for Coding");

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
	for ($i=0; $i < strlen($sentence)/2; $i++) {
		swap_chars($sentence, $i, strlen($sentence)-$i-1);
	}
}

function swap_chars(&$sentence, $i, $j) {
	$tmp = $sentence[$j];
	$sentence[$j] = $sentence[$i];
	$sentence[$i] = $tmp;
}

function reverse_word_in_sentence(&$sentence, $start, $end) {
	for ($i=$start; $i < ($start+$end)/2; $i++) {
		swap_chars($sentence, $i, $start+$end-$i-1);
	}
}
