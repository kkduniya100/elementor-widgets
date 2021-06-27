<?php

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Acousticform extends Widget_Base{

 public function get_name(){
    return 'custom_widget';
  }

  public function get_title(){
    return 'Custom Elementor Widget';
  }

  public function get_icon(){
    return 'fa fa-code';
  }

  protected function _register_controls(){
  	global $wpdb;
  	$forms = $wpdb->get_results( "SELECT * FROM 'Dynamic Content Table Name' ", ARRAY_A  );
  	$variables = [];
  	foreach($forms as $form){
  		$fid = $form['id'];
  		$variables[$fid] = $fid;
  	}
    $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Custom Widget', 'custom_widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'widget_style',
			[
				'label' => __( 'Form Id', 'custom_widget' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => $variables,
			]
		);

		$this->end_controls_section();

		/*Email Notification*/
			$this->start_controls_section(
				'email_notification_section',
				[
					'label' => __( 'Email Notification', 'custom_widget' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'subject',
				[
					'label' => __( 'Subject', 'custom_widget' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Subject', 'custom_widget' ),
				]
			);

			$this->add_control(
				'recipient_email',
				[
					'label' => __( 'Recipient Email', 'custom_widget' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Recipient Email', 'custom_widget' ),
				]
			);

			$this->end_controls_section();
		/*end notification section*/


		/*Form  Meta*/
			$this->start_controls_section(
				'form_meta',
				[
					'label' => __( 'Acoustic Form Meta', 'custom_widget' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'form_url',
				[
					'label' => __( 'Form URL', 'custom_widget' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Form URL', 'custom_widget' ),
				]
			);

			$this->add_control(
				'thank_you_page',
				[
					'label' => __( 'Thank You Page', 'custom_widget' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'custom_widget' ),
					'show_external' => true,
					'default' => [
						'url' => '',
						'is_external' => true,
						'nofollow' => true,
					],
				]
			);
			$this->end_controls_section();
		/*end meta section*/

		
  }

  /*php rander*/

   protected function render() {
		$settings = $this->get_settings_for_display();
		var_dump($settings);
		echo '<div> Your Dynamic content  Style</div>';
	}

	
 }
