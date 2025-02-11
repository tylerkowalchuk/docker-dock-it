<?php
	
	namespace MMBookPlugin;
	
	abstract class Singleton {
		protected static $instance;
		
		abstract protected function __construct(); //protected because we need the child classes to access it
		
		// To prevent cloning (PHP specific)
		private function __clone(){
		
		}
		// method for creating/returning the existing instance
		// self is the class that it is written in
		// static is the class that implements and calls the method
		public static function getInstance()
		{
			if (!static::$instance) { //self refers to the class where the function is written in, as in:
				static::$instance = new static(); // Keyword to access an abstract class is static.
			}
			return static::$instance;
		}
	}