<?php

class GenericStack {

	protected $_stack = array();

	public function push($item) {
		array_unshift($this->_stack, $item);
	}

	public function pop() {
		return array_shift($this->_stack);
	}

	public function peek() {
		return isset($this->_stack[0]) ? $this->_stack[0] : null;
	}

	public function isEmpty() {
		return empty($this->_stack);
	}

	public function count() {
		return count($this->_stack);
	}

	public function printStack() {
		print_r($this->_stack);
	}
   
}

// enforces that new elements pushed to stack are strictly smaller than the previous element
class HanoiStack extends GenericStack {

	public static $numMoves = 0;

	// override
	public function push($item) {
		if (!$this->canPush($item)) {
			throw new Exception('invalid transfer');
		}
		parent::push($item);
	}

	public function canPush($item) {
		return empty($this->_stack) || $item < $this->_stack[0];
	}

	public function canMove(HanoiStack $to) {
		return !$this->isEmpty() && $to->canPush($this->peek());
	}

	public function move(HanoiStack $to) {
		!$this->isEmpty() && ++self::$numMoves && $to->push($this->pop());
	}

}

// set up hanoi H($n,3) problem
$n = 15;
$s1 = new HanoiStack;
$s2 = new HanoiStack;
$s3 = new HanoiStack;
// insert the disks in decreasing order
for ($i=$n; $i > 0; $i--) {
	$s1->push($i);
}

// execute the solver - move all disks from s1 to s2
$s1->printStack(); $s2->printStack();  $s3->printStack();
echo move_stack($s1, $s2, $s3) . "\n\n";
$s1->printStack(); $s2->printStack();  $s3->printStack();
echo "\n" . 'Total moves: ' . HanoiStack::$numMoves . "\n";

// solver function to move all the disks from $from to $to
function move_stack(HanoiStack $from, HanoiStack $to, HanoiStack $empty) {
	$i = 0;
	$toempty = array($to, $empty);
	list($b, $c) = ($from->count() % 2 == 0) ? $toempty : array_reverse($toempty);

	while (++$i && !is_done($from, $b, $c)) {
		switch ($i % 3) {
		case 1:
			break make_legal_move($from, $b);
		case 2:
			break make_legal_move($from, $c);
		case 0:
			break make_legal_move($b, $c);
		}
	}
}

// makes the legal move between $from and $to
function make_legal_move(HanoiStack $from, HanoiStack $to) {
	$from->canMove($to) ? $from->move($to) : $to->move($from);
}

// check if a solution has been obtained
function is_done(HanoiStack $from, HanoiStack $to, HanoiStack $empty) {
	return $from->isEmpty() && ($to->isEmpty() || $empty->isEmpty());
}



