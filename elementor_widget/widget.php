<?php

namespace WPC;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class widget_Loader{

	private static $_instance = null;

	public static function instance()
	  {
	    if (is_null(self::$_instance)) {
	      self::$_instance = new self();
	    }
	    return self::$_instance;
	}

	private function include_widgets_files(){
	    require_once(__DIR__ . '/action.php');
	}


	public function acoustic_widgets_register(){

		$this->include_widgets_files();

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Acousticform());

	}

	public function __construct(){

		add_action('elementor/widgets/widgets_registered', [$this, 'acoustic_widgets_register'], 99);
	}


}

Widget_Loader::instance();

