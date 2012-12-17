<?php

function is_binary_search_tree($node, $parent_value=null, $rightleft=null) {

    if ($node->left && $node->left->value >= $node->value) {
        return false;
    }
        
    if ($node->right && $node->right->value <= $node->value) {
        return false;
    }

    if ($parent_value != null) {
        if ($node->right && (string)$rightleft == 'left' && $node->right->value >= $parent_value) {
            return false;
        }
        
        if ($node->left && (string)$rightleft == 'right' && $node->left->value <= $parent_value) {
            return false;
        }
    }
        
    $a = $node->left ? is_binary_search_tree($node->left, $node->value, 'left') : true;
    $b = $node->right ? is_binary_search_tree($node->right, $node->value, 'right') : true;
    
    return $a && $b;
    
}

// unit test
class Node {
	public $left;
	public $right;
	public $value;
	public function __construct($value) {
		$this->value = $value;
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

var_dump(is_binary_search_tree($root));