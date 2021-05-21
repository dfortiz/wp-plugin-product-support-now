<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class bhppsn_admin {
    private $opt=null;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'product_support_now__add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'product_support_now__page_init' ) );
	}

	public function product_support_now__add_plugin_page() {
		add_menu_page(
			'PSN', // page_title
			'PSN', // menu_title
			'manage_options', // capability
			'product-support-now', // menu_slug
			array( $this, 'product_support_now__create_admin_page' ), // function
			BH_PLGN_PSN_URL . 'assets/img/wmn-icon.png'
			//2 // position
		);
	}

	public function product_support_now__create_admin_page() {
		$this->opt = get_option( 'product_support_now__option_name' ); ?>

		<div class="wrap">
			<h2>Product support now!</h2>
			<p>This plugins add a link to each woocommerce product to send a web-whatsapp message with info about the product to the support employee on turn, if you have any question or need some improvement please contact me <a href="mailto:dfortiz@gmail.com" target="_blank">dfortiz@gmail.com</a></p>
			<?php settings_errors(); ?>
			<form method="post" action="options.php">
				<?php
					settings_fields( 'product_support_now__option_group' );
					do_settings_sections( 'product-support-now-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function product_support_now__page_init() {
		register_setting(
			'product_support_now__option_group', // option_group
			'product_support_now__option_name', // option_name
			array( $this, 'product_support_now__sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'product_support_now__setting_section', // id
			'Settings', // title
			array( $this, 'product_support_now__section_info' ), // callback
			'product-support-now-admin' // page
		);

		add_settings_field(
			'whatsapp1', // id
			'whatsapp1', // title
			array( $this, 'whatsapp1_callback' ), // callback
			'product-support-now-admin', // page
			'product_support_now__setting_section' // section
		);

		add_settings_field(
			'whatsapp2', // id
			'whatsapp2', // title
			array( $this, 'whatsapp2_callback' ), // callback
			'product-support-now-admin', // page
			'product_support_now__setting_section' // section
		);

		add_settings_field(
			'whatsapp_active_turn', // id
			'whatsapp-active-turn', // title
			array( $this, 'whatsapp_active_turn_callback' ), // callback
			'product-support-now-admin', // page
			'product_support_now__setting_section' // section
		);

		add_settings_field(
			'schedule_turn', // id
			'schedule-turn', // title
			array( $this, 'schedule_turn_callback' ), // callback
			'product-support-now-admin', // page
			'product_support_now__setting_section' // section
		);

		add_settings_field(
			'icon_color', // id
			'icon-color', // title
			array( $this, 'icon_color_callback' ), // callback
			'product-support-now-admin', // page
			'product_support_now__setting_section' // section
		);

		add_settings_field(
			'background_color', // id
			'icon-background-color', // title
			array( $this, 'background_color_callback' ), // callback
			'product-support-now-admin', // page
			'product_support_now__setting_section' // section
		);

		add_settings_field(
			'text_color', // id
			'text_color', // title
			array( $this, 'text_color_callback' ), // callback
			'product-support-now-admin', // page
			'product_support_now__setting_section' // section
		);

		add_settings_field(
			'text_size', // id
			'text_size', // title
			array( $this, 'text_size_callback' ), // callback
			'product-support-now-admin', // page
			'product_support_now__setting_section' // section
		);

		
		// add_settings_field(
		// 	'show_on_product_page', // id
		// 	'show_on_product_page', // title
		// 	array( $this, 'show_on_product_page_callback' ), // callback
		// 	'product-support-now-admin', // page
		// 	'product_support_now__setting_section' // section
		// );

		add_settings_field(
			'text_label', // id
			'text_label', // title
			array( $this, 'text_label_callback' ), // callback
			'product-support-now-admin', // page
			'product_support_now__setting_section' // section
		);

		add_settings_field(
			'start_message', // id
			'start_message', // title
			array( $this, 'start_message_callback' ), // callback
			'product-support-now-admin', // page
			'product_support_now__setting_section' // section
		);

		add_settings_field(
			'active', // id
			'active', // title
			array( $this, 'active_callback' ), // callback
			'product-support-now-admin', // page
			'product_support_now__setting_section' // section
		);
		
	}

	public function product_support_now__sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['whatsapp1'] ) ) {
			$sanitary_values['whatsapp1'] = sanitize_text_field( $input['whatsapp1'] );
		}

		if ( isset( $input['whatsapp2'] ) ) {
			$sanitary_values['whatsapp2'] = sanitize_text_field( $input['whatsapp2'] );
		}

		if ( isset( $input['whatsapp_active_turn'] ) ) {
			$sanitary_values['whatsapp_active_turn'] = $input['whatsapp_active_turn'];
		}

		if ( isset( $input['icon_color'] ) ) {
			$sanitary_values['icon_color'] = $input['icon_color'];
		}

		if ( isset( $input['background_color'] ) ) {
			$sanitary_values['background_color'] = $input['background_color'];
		}

		if ( isset( $input['text_color'] ) ) {
			$sanitary_values['text_color'] = $input['text_color'];
		}

		if ( isset( $input['text_size'] ) ) {
			$sanitary_values['text_size'] = $input['text_size'];
		}

		if ( isset( $input['schedule_turn'] ) ) {
			$sanitary_values['schedule_turn'] = $input['schedule_turn'];
		}


		if ( isset( $input['text_label'] ) ) {
			$sanitary_values['text_label'] = $input['text_label'];
		}

		if ( isset( $input['start_message'] ) ) {
			$sanitary_values['start_message'] = $input['start_message'];
		}

		if ( isset( $input['active'] ) ) {
			$sanitary_values['active'] = $input['active'];
		}

		// if ( isset( $input['show_on_product_page'] ) ) {
		// 	$sanitary_values['show_on_product_page'] = $input['show_on_product_page'];
		// }

		return $sanitary_values;
	}

	public function product_support_now__section_info() {
		
	}

	public function whatsapp1_callback() {
		printf(
			'<input class="regular-text" type="text" name="product_support_now__option_name[whatsapp1]" id="whatsapp1" value="%s">',
			isset( $this->opt['whatsapp1'] ) ? esc_attr( $this->opt['whatsapp1']) : ''
		);
	}

	public function whatsapp2_callback() {
		printf(
			'<input class="regular-text" type="text" name="product_support_now__option_name[whatsapp2]" id="whatsapp2" value="%s">',
			isset( $this->opt['whatsapp2'] ) ? esc_attr( $this->opt['whatsapp2']) : ''
		);
	}

	public function whatsapp_active_turn_callback() {
		?> <select name="product_support_now__option_name[whatsapp_active_turn]" id="whatsapp_active_turn">
			<?php $selected = (isset( $this->opt['whatsapp_active_turn'] ) && $this->opt['whatsapp_active_turn'] === 'whatsapp1') ? 'selected' : '' ; ?>
			<option value="whatsapp1" <?php echo $selected; ?>>whatsapp1</option>
			<?php $selected = (isset( $this->opt['whatsapp_active_turn'] ) && $this->opt['whatsapp_active_turn'] === 'whatsapp2') ? 'selected' : '' ; ?>
			<option value="whatsapp2" <?php echo $selected; ?>>whatsapp2</option>
			<?php $selected = (isset( $this->opt['whatsapp_active_turn'] ) && $this->opt['whatsapp_active_turn'] === 'scheduled') ? 'selected' : '' ; ?>
			<option value="scheduled" <?php echo $selected; ?>>scheduled</option>
		</select> <?php
	}

	public function icon_color_callback() {
		?> <select name="product_support_now__option_name[icon_color]" id="icon_color">
			<?php $selected = (isset( $this->opt['icon_color'] ) && $this->opt['icon_color'] === '#ffffff') ? 'selected' : '' ; ?>
			<option value="#4fce50" <?php echo $selected; ?>>green</option>
			<?php $selected = (isset( $this->opt['icon_color'] ) && $this->opt['icon_color'] === '#000000') ? 'selected' : '' ; ?>
			<option value="#000000" <?php echo $selected; ?>>black</option>
			<?php $selected = (isset( $this->opt['icon_color'] ) && $this->opt['icon_color'] === '#ffffff') ? 'selected' : '' ; ?>
			<option value="#ffffff" <?php echo $selected; ?>>white</option>
		</select> <?php
	}

	public function background_color_callback() {
		?> <select name="product_support_now__option_name[background_color]" id="background_color">
			<?php $selected = (isset( $this->opt['background_color'] ) && $this->opt['background_color'] === '#000000') ? 'selected' : '' ; ?>
			<option value="#000000" <?php echo $selected; ?>>black</option>
			<?php $selected = (isset( $this->opt['background_color'] ) && $this->opt['background_color'] === '#ffffff') ? 'selected' : '' ; ?>
			<option value="#ffffff" <?php echo $selected; ?>>white</option>
		</select> <?php
	}

	public function text_color_callback() {
		?> <select name="product_support_now__option_name[text_color]" id="text_color">
			<?php $selected = (isset( $this->opt['text_color'] ) && $this->opt['text_color'] === '#000000') ? 'selected' : '' ; ?>
			<option value="#000000" <?php echo $selected; ?>>black</option>
			<?php $selected = (isset( $this->opt['text_color'] ) && $this->opt['text_color'] === '#ffffff') ? 'selected' : '' ; ?>
			<option value="#ffffff" <?php echo $selected; ?>>white</option>
		</select> <?php
	}

	public function text_size_callback() {
		printf(
			'<input class="regular-text" placeholder="16px" type="text" name="product_support_now__option_name[text_size]" id="text_size" value="%s">',
			isset( $this->opt['text_size'] ) ? esc_attr( $this->opt['text_size']) : ''
		);
	}
	
	public function schedule_turn_callback() {
		?> <select name="product_support_now__option_name[schedule_turn]" id="schedule_turn">
			<?php $selected = (isset( $this->opt['schedule_turn'] ) && $this->opt['schedule_turn'] === 'whatsapp1|09|17') ? 'selected' : '' ; ?>
			<option value="whatsapp1|09:00|16:59|whatsapp2|17:00|08:59" <?php echo $selected; ?>>whatsapp1 (09:00-16:59) whatsapp2 (17:00-08:59)</option>
			<?php $selected = (isset( $this->opt['schedule_turn'] ) && $this->opt['schedule_turn'] === 'whatsapp2|17|09') ? 'selected' : '' ; ?>
			<option value="whatsapp1|09:00|20:59|whatsapp2|21:00|08:59" <?php echo $selected; ?>>whatsapp1 (09:00-20:59) whatsapp2 (21:00-08:59)</option>
		</select> <?php
	}

	public function text_label_callback() {
		printf(
			'<input class="regular-text" placeholder="More info" type="text" name="product_support_now__option_name[text_label]" id="text_label" value="%s">
			<br/><span>This text is displayed before the icon</span>',
			isset( $this->opt['text_label'] ) ? esc_attr( $this->opt['text_label']) : ''
		);
	}

	public function start_message_callback() {
		printf(
			'<input class="regular-text" placeholder="More info about @productname @productid please" type="text" name="product_support_now__option_name[start_message]" id="start_message" value="%s">
			<br/><span>You can use only these tags:
			<br/> @productname (product name), 
			<br/> @productid (product identifier),
			<br/> @site (site url)
			</span>',
			isset( $this->opt['start_message'] ) ? esc_attr( $this->opt['start_message']) : ''
		);
	}

	public function active_callback() {
		printf(
			'<input type="checkbox" name="product_support_now__option_name[active]" id="active" value="active" %s> <label for="active">If checked the link is visible/enable</label>',
			( isset( $this->opt['active'] ) && $this->opt['active'] === 'active' ) ? 'checked' : ''
		);
	}
	public function show_on_product_page_callback() {
		printf(
			'<input type="checkbox" name="product_support_now__option_name[show_on_product_page]" id="show_on_product_page" value="show_on_product_page" %s> <label for="active">If checked the link is visible on the product page</label>',
			( isset( $this->opt['show_on_product_page'] ) && $this->opt['show_on_product_page'] === 'show_on_product_page' ) ? 'checked' : ''
		);
	}
}

/* 
 * Retrieve this value with:
 * $product_support_now__options = get_option( 'product_support_now__option_name' ); // Array of All Options
 * $whatsapp1 = $product_support_now__options['whatsapp1']; // whatsapp1
 * $whatsapp2 = $product_support_now__options['whatsapp2']; // whatsapp2
 * $whatsapp_active_turn = $product_support_now__options['whatsapp_active_turn']; // whatsapp-active-turn
 * $background_color = $product_support_now__options['background_color']; // background-color
 * $schedule_turn = $product_support_now__options['schedule_turn']; // schedule-turn
 * $active = $product_support_now__options['active']; // active
 */