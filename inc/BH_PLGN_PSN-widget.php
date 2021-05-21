<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly. 
}

	class bhppsn_widget {

		private $admin=false;
		private $opt=null;
		private $enable=true;
	
		function __construct($id_admin=false){
	
			$this->admin=$id_admin;
			$this->product_support_now_load_options('product_support_now__option_name');
		   
			if($this->enable){
				add_action( 'woocommerce_after_add_to_cart_form',  array($this,'linktosupport_productpage_after_cart' ) );
				add_action( 'woocommerce_after_shop_loop_item_title',  array($this,'linktosupport_shop_after_cart' ) );
			}
		}

		function product_support_now_load_options(){
			$opt = get_option( 'product_support_now__option_name' );
			$this->opt = [];
			$this->opt['whatsapp1'] = isset($opt['whatsapp1'])?$opt['whatsapp1']:'';
			$this->opt['whatsapp2'] = isset($opt['whatsapp2'])?$opt['whatsapp2']:'';
			$this->opt['whatsapp_active_turn'] = isset($opt['whatsapp_active_turn'])?$opt['whatsapp_active_turn']:'';
			$this->opt['schedule_turn'] = isset($opt['schedule_turn'])?$opt['schedule_turn']:'';
			$this->opt['icon_color'] = isset($opt['icon_color'])?$opt['icon_color']:'';        
			$this->opt['background_color'] = isset($opt['background_color'])?$opt['background_color']:''; 
			$this->opt['text_color'] = isset($opt['text_color'])?$opt['text_color']:''; 
			$this->opt['text_size'] = isset($opt['text_size'])?$opt['text_size']:''; 
			$this->opt['text_label'] = isset($opt['text_label'])?$opt['text_label']:''; 
			$this->opt['start_message'] = isset($opt['start_message'])?$opt['start_message']:''; 

			$this->opt['active']= isset($opt['active']);
			$this->enable=$this->opt['active'];
		}
	

		function linktosupport_productpage_after_cart() {

			$whatsapp = $this->product_support_now_get_whatsapp();
			$message = $this->product_support_now_get_start_message();

			echo '<div class="bhpsn-widget" style="background-color:'.(isset($this->opt['background_color'])?$this->opt['background_color']:'#fff').';">
					<a href="https://wa.me/'.$whatsapp.'?text='.$message.'" target="_blank">
					<span  style="color:'. $this->opt['text_color'] .'; font-size: '.$this->opt['text_size'].';" >'. $this->opt['text_label'] .'</span>
					<svg fill="'.(isset($this->opt['icon_color'])?$this->opt['icon_color']:'#4fce50').'"  viewBox="0 0 90 90" width="'.$this->opt['text_size'].'" height="'.$this->opt['text_size'].'"><path d="M90,43.841c0,24.213-19.779,43.841-44.182,43.841c-7.747,0-15.025-1.98-21.357-5.455L0,90l7.975-23.522   c-4.023-6.606-6.34-14.354-6.34-22.637C1.635,19.628,21.416,0,45.818,0C70.223,0,90,19.628,90,43.841z M45.818,6.982   c-20.484,0-37.146,16.535-37.146,36.859c0,8.065,2.629,15.534,7.076,21.61L11.107,79.14l14.275-4.537   c5.865,3.851,12.891,6.097,20.437,6.097c20.481,0,37.146-16.533,37.146-36.857S66.301,6.982,45.818,6.982z M68.129,53.938   c-0.273-0.447-0.994-0.717-2.076-1.254c-1.084-0.537-6.41-3.138-7.4-3.495c-0.993-0.358-1.717-0.538-2.438,0.537   c-0.721,1.076-2.797,3.495-3.43,4.212c-0.632,0.719-1.263,0.809-2.347,0.271c-1.082-0.537-4.571-1.673-8.708-5.333   c-3.219-2.848-5.393-6.364-6.025-7.441c-0.631-1.075-0.066-1.656,0.475-2.191c0.488-0.482,1.084-1.255,1.625-1.882   c0.543-0.628,0.723-1.075,1.082-1.793c0.363-0.717,0.182-1.344-0.09-1.883c-0.27-0.537-2.438-5.825-3.34-7.977   c-0.902-2.15-1.803-1.792-2.436-1.792c-0.631,0-1.354-0.09-2.076-0.09c-0.722,0-1.896,0.269-2.889,1.344   c-0.992,1.076-3.789,3.676-3.789,8.963c0,5.288,3.879,10.397,4.422,11.113c0.541,0.716,7.49,11.92,18.5,16.223   C58.2,65.771,58.2,64.336,60.186,64.156c1.984-0.179,6.406-2.599,7.312-5.107C68.398,56.537,68.398,54.386,68.129,53.938z"></path></svg>
					</a>
				</div>';
		}
		
		function linktosupport_shop_after_cart() {
			$this->linktosupport_productpage_after_cart();
		}


		function product_support_now_get_start_message(){
			$message = '';
			$message = str_replace("@productname", get_the_title(), $this->opt['start_message']);
			$message = str_replace("@productid", get_the_ID(), $message);
			$message = str_replace("@site", site_url(), $message);
			return $message;
		}
	
		function product_support_now_get_whatsapp(){
			$whatsapp = '';
			
			switch ($this->opt['whatsapp_active_turn']) {
				case 'whatsapp1':
					$whatsapp = $this->opt['whatsapp1'];
					break;
				case 'whatsapp2':
					$whatsapp = $this->opt['whatsapp2'];
					break;
				case 'scheduled':
					$schedule = explode("|", $this->opt['schedule_turn']);
					$now = date("H:i");
					if(  strtotime($now)>=strtotime($schedule[1]) && strtotime($now)<=strtotime($schedule[2])) {
						$whatsapp=$this->opt['whatsapp1'];
					}
					else {
						$whatsapp=$this->opt['whatsapp2'];
					}
					break;                    
			}
			return $whatsapp;
			
		}
		
	}
	?>