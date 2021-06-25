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

		/*Email Notification*/
			$this->start_controls_section(
				'email_notification_section',
				[
					'label' => __( 'Email Notification', 'acousticform_shortcode' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'subject',
				[
					'label' => __( 'Subject', 'acousticform_shortcode' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Subject', 'acousticform_shortcode' ),
				]
			);

			$this->add_control(
				'recipient_email',
				[
					'label' => __( 'Recipient Email', 'acousticform_shortcode' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Recipient Email', 'acousticform_shortcode' ),
				]
			);

			$this->end_controls_section();
		/*end notification section*/


		/*Form  Meta*/
			$this->start_controls_section(
				'form_meta',
				[
					'label' => __( 'Acoustic Form Meta', 'acousticform_shortcode' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'form_url',
				[
					'label' => __( 'Form URL', 'acousticform_shortcode' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Form URL', 'acousticform_shortcode' ),
				]
			);

			$this->add_control(
				'interest_code',
				[
					'label' => __( 'Interest Code', 'acousticform_shortcode' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Interest Code', 'acousticform_shortcode' ),
				]
			);

			$this->add_control(
				'campaign_track',
				[
					'label' => __( 'Campaign Track', 'acousticform_shortcode' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Campaign Track', 'acousticform_shortcode' ),
				]
			);

			$this->add_control(
				'thank_you_page',
				[
					'label' => __( 'Thank You Page', 'acousticform_shortcode' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'acousticform_shortcode' ),
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

			/*Email Notification*/
			$this->start_controls_section(
				'datalayer_configuration',
				[
					'label' => __( 'DataLayer Configuration', 'acousticform_shortcode' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'goal_category',
				[
					'label' => __( 'Goal Category', 'acousticform_shortcode' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Example: OE Form', 'acousticform_shortcode' ),
				]
			);

			$this->add_control(
				'form_region',
				[
					'label' => __( 'Form Region', 'acousticform_shortcode' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'ie, Americas, APAC, EMEA etc', 'acousticform_shortcode' ),
				]
			);

			$this->add_control(
				'form_type',
				[
					'label' => __( 'Form Type', 'acousticform_shortcode' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'will populate label on submit button. Example: Download Now', 'acousticform_shortcode' ),
				]
			);

			$this->add_control(
				'content_type',
				[
					'label' => __( 'Content Type', 'acousticform_shortcode' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Example: APAC OE Program Brochure', 'acousticform_shortcode' ),
				]
			);

			$this->end_controls_section();
		/*end notification section*/
  }

  /*php rander*/

   protected function render() {
		$settings = $this->get_settings_for_display();
		$shortcode = '[acoustic_form id="'.$settings['acoustic_style'].'" subject="'.$settings['subject'].'"  recipient_email="'.$settings['recipient_email'].'"  form_url="'.$settings['form_url'].'"  interest_code="'.$settings['interest_code'].'"  campaign_track="'.$settings['campaign_track'].'"  goal_category="'.$settings['goal_category'].'"  form_region="'.$settings['form_region'].'" thank_you_page="'.$settings['thank_you_page']['url'].'" form_type="'.$settings['form_type'].'" content_type="'.$settings['content_type'].'"]'; 
		echo '<div> '.do_shortcode($shortcode).'</div>';
	}

	
 }
