<?php

class Node {
	public $left;
	public $right;
	public $value;
	public $visited = false;
	public function __construct($value) {
		$this->value = $value;
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

	public function lca_postorder(closure $visit=null) {
		if ($this->left && $a = $this->left->postorder($visit)) {
			return $a;
		}
		if ($this->right && $b = $this->right->postorder($visit)) {
			return $b;
		}
		$ret = $visit ? $visit($this) : $this->print_node(); // visit node
		return $ret;
	}

	public function print_node() {
		echo $this->value . "\n";
	}

	public function lowest_common_ancestor($n1, $n2) {

		$root = $this;
		$unvisit = function() use ($root) {
			// mark all nodes as un-visited
			$root->postorder(function($node) {
					$node->visited = false;
				});
		};

		$ret = $this->lca_postorder(function($node) use ($unvisit, $n1, $n2) {

				// unvisit ALL the nodes in the whole tree
				$unvisit();
					
				// mark all child nodes of this node as visited
				$node->postorder(function($iNode) {
					$iNode->visited = true;
				});

				// unvisit the root node
				$node->visited = false;

				// check if two passed in nodes have been visited
				if ($n1->visited && $n2->visited) {
					return $node->value;
				}

			});

		return $ret;

	}

}

function lowest_common_ancestor($root, $n1, $n2) {
	// without no parent pointers


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
var_dump($root->lowest_common_ancestor($root->left->left, $root->left));
