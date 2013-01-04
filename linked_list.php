<?php

class Node {
	public $key;
	public $next;
	public function __construct($key, $next=null) {
		$this->key = $key;
		$this->next = $next;
	}
}

class LList {
	public $head;
	public function __construct(Node $head) {
		$this->head = $head;
	}
	public function add(Node $n) {
		$n->next = $this->head;
		$this->head = $n;
	}
	public function print_list() {
		$a = $this->head;
		while ($a != null) {
			echo $a->key . "\n";
			$a = $a->next;
		}
	}
	public function remove_3rd_last_element() {
		$a = $this->head;
		// edge case - list has less than 3 elements
		if (!isset($a->next->next)) {
			return false;
		}
		$scout = $a->next->next->next;
		$prev = null;
		while ($scout != null) {
			$prev = $a;
			$a = $a->next;
			$scout = $scout->next;
		}
		if ($prev == null) {
			$this->head = $a->next;
		} else {
			$prev->next = $a->next;
		}
	}
	public function remove_duplicates() {
		$visited = array();
		$prev = null;
		for ($a=$this->head; $a != null; $a = $a->next) {
			$key = $a->key;
			if (isset($visited[$key])) {
				$prev->next = $a->next;
			} else {
				$visited[$key] = true;
				$prev = $a;
			}
		}
	}
	public function remove_duplicates_no_buffer() {
		$prev = null;
		for ($a=$this->head, $i=0; $a != null; $a = $a->next, $i++) {
			for ($b=$this->head, $j=0; $j < $i; $b = $b->next, $j++) {
				if ($a->key == $b->key) {
					$prev->next = $a->next;
					break;
				}
			}
			$prev = $a;
		}
	}
	public function has_loop() {
		$visited = array();
		for ($a=$this->head; $a != null; $a = $a->next) {
			$hash = spl_object_hash($a);
			if (isset($visited[$hash])) {
				return true;
			}
			$visited[$hash] = true;
		}
		return false;
	}
		
}

// unit tests
$a = new Node(12,
			  new Node(12,
					   new Node(24,
								new Node(35,
										 new Node(35,
												  new Node(35,
														   new Node(82,
																	new Node(82
																			 ))))))));


// init list
$l = new LList($a);
echo $l->print_list() . "\n";

// remove 3rd last element
$l->remove_3rd_last_element();
echo $l->print_list() . "\n";

// check for loops
echo var_dump($l->has_loop()) . "\n";

// remove duplicates
$l->remove_duplicates_no_buffer();
echo $l->print_list() . "\n";

// check for loops
$a->next = $a;
var_dump($l->has_loop());

