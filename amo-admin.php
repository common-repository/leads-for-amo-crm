<?php

class Amo_Admin {

	private static $initiated = false;

	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	public static function init_hooks() {
		self::$initiated = true;
		add_action( 'admin_init', array( 'Amo_Admin', 'admin_init' ) );
	}

	public static function admin_init() {

	}

	public function display_page()
	{
		return "ewfwef";

	}

}