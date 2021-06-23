<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Acousticform extends Widget_Base{

 public function get_name(){
    return 'acousticform_shortcode';
  }

  public function get_title(){
    return 'Acoustic Form';
  }

  public function get_icon(){
    return 'fa fa-code';
  }

  protected function _register_controls(){
  	global $wpdb;
  	$forms = $wpdb->get_results( "SELECT * FROM ccl_acoustic_forms", ARRAY_A  );
  	$variables = [];
  	foreach($forms as $form){
  		$fid = $form['id'];
  		$variables[$fid] = $fid;
  	}
    $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Acoustic Form', 'acousticform_shortcode' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'acoustic_style',
			[
				'label' => __( 'Form Id', 'acousticform_shortcode' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => $variables,
			]
		);

		$this->end_controls_section();
  }

  /*php rander*/

   protected function render() {
		$settings = $this->get_settings_for_display();
		$shortcode = '[acoustic_form id="'.$settings['acoustic_style'].'"]'; 
		echo '<div> '.do_shortcode($shortcode).'</div>';
	}

	protected function _content_template() {
		echo "<div> </div>";
	}


 }