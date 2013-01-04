<?php

class LList {
	public $head;
	public function __construct($head) {
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

class Node {
	public $key;
	public $next;
	public function __construct($key, $next=null) {
		$this->key = $key;
		$this->next = $next;
	}
}

$a = new Node(12,
			  new Node(24,
					   new Node(35,
								new Node(35,
										 new Node(35,
										 new Node(82,
												  new Node(82
														   )))))));

$l = new LList($a);
$l->print_list();
echo "\n";
//$l->remove_3rd_last_element();
//$l->print_list();
//var_dump($l->has_loop());
//$a->next = $a;
//var_dump($l->has_loop());

$l->remove_duplicates();
$l->print_list();
