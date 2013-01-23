<?php

class Node {
	private $left;
	private $right;
	public $value;
	public $visited = false;
	protected $parent;
	public function __construct($value) {
		$this->value = $value;
	}
	public function __set($key, $val) {
		if ($key == 'left' || $key == 'right') {
			$this->$key = $val;
			$this->$key->parent = $this;
		}
	}
	public function __get($key) {
		if (in_array($key, array('left', 'right', 'parent'))) {
			return $this->$key;
		}
	}
	public function preorder(closure $visit=null) {
		$ret = $visit ? $visit($this) : $this->print_node(); // visit node
		$this->left && $this->left->preorder($visit);
		$this->right && $this->right->preorder($visit);
		return $ret;
	}

	public function inorder(closure $visit=null) {
		$this->left && $this->left->inorder($visit);
		$ret = $visit ? $visit($this) : $this->print_node(); // visit node
		$this->right && $this->right->inorder($visit);
		return $ret;
	}

	public function postorder(closure $visit=null) {
		$this->left && $this->left->postorder($visit);
		$this->right && $this->right->postorder($visit);
		$ret = $visit ? $visit($this) : $this->print_node(); // visit node
		return $ret;
	}

	public function find(Node $node) {
		if ($this->value == $node->value) {
			return $this;
		} elseif ($this->left && false !== $found = $this->left->find($node)) {
			return $found;
		} elseif ($this->right && false !== $found = $this->right->find($node)) {
			return $found;
		} else {
			return false;
		}
	}

	public function print_node() {
		echo $this->value . "\n";
	}

	// with parent pointers
	public function lowest_common_ancestor_with_parent($n1, $n2) {
		// mark all nodes as false
		$this->preorder(function($node) {
				$node->visited = false;
			});

		while (true) {
			if (!$n1->visited) {
				$n1->visited = true;
			} elseif ($n1->parent) {
				return $n1;
			}

			if (!$n2->visited) {
				$n2->visited = true;
			} elseif ($n2->parent) {
				return $n2;
			}

			if (!$n1->parent && !$n2->parent) {
				// both n1 and n2 must be equal and must both be the root node
				// return either n1 or n2 in this case
				return $n1;
			}

			$n1 = $n1->parent ? $n1->parent : $n1;
			$n2 = $n2->parent ? $n2->parent : $n2;
		}

	}

	// without parent pointers
	public function lowest_common_ancestor($n1, $n2) {
		if ($n1->value == $this->value && $this->find($n2)) {
			return $this;
		} elseif ($n2->value == $this->value && $this->find($n1)) {
			return $this;
		}

		if ($this->left && $this->right) {
			if ($this->left->find($n1) && $this->right->find($n2)) {
				return $this;
			} elseif ($this->right->find($n1) && $this->left->find($n2)) {
				return $this;
			}
		}
		if ($this->left && false !== $found = $this->left->lowest_common_ancestor($n1, $n2)) {
			return $found;
		}

		if ($this->right && false !== $found = $this->right->lowest_common_ancestor($n1, $n2)) {
			return $found;
		}

		return false;
	}
}

// build the graph
$root = new Node(8);
$root->left = new Node(4);
$root->left->left = new Node(2);
$root->left->right = new Node(6);
$root->left->left->left = new Node(0);
$root->left->left->right = new Node(3);
$root->left->right->left = new Node(5);
$root->left->right->right = new Node(7);
$root->right = new Node(14);
$root->right->left = new Node(13);
$root->right->right = new Node(15);

// echo $root->preorder() . "\n";
// echo $root->inorder() . "\n";
// echo $root->postorder() . "\n";

// echo $root->lowest_common_ancestor(0, 5);
var_dump($root->lowest_common_ancestor_with_parent($root, $root)->value);
