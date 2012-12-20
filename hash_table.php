<?php

class HashTable {

	private $_table = array();
	private $_size = 10000;

	public function __construct($size=0) {
		$size = (int)$size;
		if ($size > 0) {
			$this->_size = $size;
		}
	}

	public function set($key, $val) {
		$i = $orig_i = $this->_get_index($key);
		$node = new HashTableNode($key, $val);

		while (true) {
			if (!isset($this->_table[$i]) || $key == $this->_table[$i]->key) {
				$this->_table[$i] = $node;
				break;
			}
			// increment $i
			$i = (++$i % $this->_size);
			// loop complete
			if ($i == $orig_i) {
				// out of space
				$this->_double_table_size();
				return $this->set($key, $val);
			}
		}
		return $this;
	}

	public function get($key) {
		$i = $orig_i = $this->_get_index($key);
		while (true) {
			if (!isset($this->_table[$i])) {
				return null;
			}
			$node = $this->_table[$i];
			if ($key == $node->key) {
				return $node->val;
			}
			// increment $i
			$i = (++$i % $this->_size);
			// loop complete
			if ($i == $orig_i) {
				return null;
			}
		}
	}

	private function _get_index($key) {
		return crc32($key) % $this->_size;
	}

	private function _double_table_size() {
		$old_size = $this->_size; // backup old size
		$this->_size *= 2; // double the current table size
		$data = array(); // new array
		$collisions = array(); // to be re-added later

		for ($i=0; $i < $old_size; $i++) {
			if (!empty($this->_table[$i])) {
				$node = $this->_table[$i];
				$j = $this->_get_index($node->key);
				// check collisions and record them
				if (isset($data[$j]) && $data[$j]->key != $node->key) {
					$collisions[] = $node;
				} else {
					$data[$j] = $node;
				}
			}
		}

		$this->_table = $data;

		// manage collisions
		foreach ($collisions as $node) {
			$this->set($node->key, $node->val);
		}
	}

}

class HashTableNode {
	public $key;
	public $val;
	public function __construct($key, $val) {
		$this->key = $key;
		$this->val = $val;
	}
}

// unit test
$h = new HashTable(1);
$h->set('abc', 'def');
$h->set('ghi', 'test');
$h->set('def', 'qbc');
echo $h->get('abc') . "\n";
echo $h->get('def') . "\n";
echo $h->get('ghi') . "\n";


