<?php

class Singleton {

	private static $_instance;
	
	// singleton has private constructor
	private function __construct() {
	}

	public function getInstance() {
		if (!self::$_instance) {
			self::$_instance = new Singleton;
		}
		return self::$_instance;
	}

}

var_dump(Singleton::getInstance());
var_dump(Singleton::getInstance());
var_dump(Singleton::getInstance());
var_dump(Singleton::getInstance());
var_dump(Singleton::getInstance());
var_dump(Singleton::getInstance());
var_dump(Singleton::getInstance());
var_dump(Singleton::getInstance());
