<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

include(BH_PLGN_PSN_PATH."/inc/BH_PLGN_PSN-widget.php");

//Class for the setup plugin menu and initialization 
class bhppsn_main extends bhppsn_widget {

    function __construct(){
        
        //Setup admin panel
        if(is_admin()){
            parent::__construct(true);
            $this->bhppsn_admin_area();
            
        }
        else {
            if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                parent::__construct(false);
            }
        }
    }

     function bhppsn_admin_area(){
        //Call admin area class 
        include(BH_PLGN_PSN_PATH."/inc/BH_PLGN_PSN-admin.php");
        new bhppsn_admin($this);
    }
    
}

