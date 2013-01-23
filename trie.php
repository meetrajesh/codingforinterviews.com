<?php

class Trie {
	private $root;
	public function __construct() {
		$this->root = new TrieNode;
	}
	public function insert_key($str, $v)  {
		$node = $this->root;
		foreach (str_split($str) as $i => $char) {
			if (!isset($node->children[$char])) {
				$prefix = substr($str, 0, $i+1);
				$node->children[$char] = new TrieNode($prefix);
			}
			$node = $node->children[$char];
		}
		$node->bucket = $v;
	}
	public function print_trie() {
		$q1 = array($this->root);
		$q2 = array();
		while (!empty($q1)) {
			$node = array_shift($q1);
			$q2 = array_merge($q2, $node->children);
			echo $node->char . ' ';
			if (empty($q1)) {
				echo "\n";
				list($q1, $q2) = array($q2, $q1);
			}
		}
	}
	public function has_key($str) {
		$node = $this->_find_node($str);
		return (bool)$node;
	}
	private function _find_node($str) {
		$node = $this->root;
		foreach (str_split($str) as $char) {
			if (!isset($node->children[$char])) {
				return false;
			}
			$node = $node->children[$char];
		}
		return $node;
	}
	public function retrieve_val($str) {
		$node = $this->_find_node($str);
		return $node ? $node->bucket : false;
	}
	public function start_with_prefix($prefix) {
		$node = $this->_find_node($prefix);
		if (!$node) {
			return false;
		}
		// find all leaf nodes of $node
		$leafs = array();
		$queue = array($node);
		while (!empty($queue)) {
			$node = array_shift($queue);
			if (empty($node->children)) {
				// leaf node
				$leafs[] = $node->char;
			} else {
				$queue = array_merge($queue, $node->children);
			}
		}
		return $leafs;
	}
}

class TrieNode {
	public $char;
	public $bucket;
	public $children = array();
	public function __construct($char=null) {
		$this->char = $char;
	}
}

$trie = new Trie;
$trie->insert_key('foo', 2);
$trie->insert_key('doo', 4);
$trie->insert_key('bar', 6);
$trie->insert_key('fodder', 10);
$trie->insert_key('ladder', 11);
$trie->insert_key('to', 11);
$trie->insert_key('tea', 11);
$trie->insert_key('ted', 16);
$trie->insert_key('ten', 11);
$trie->insert_key('A', 11);
$trie->insert_key('i', 11);
$trie->insert_key('in', 11);
$trie->insert_key('inn', 11);

var_dump($trie->has_key('to'));
var_dump($trie->has_key('tramp'));
var_dump($trie->retrieve_val('ted'));
var_dump($trie->start_with_prefix('t'));
