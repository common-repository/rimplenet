<?php  

class Rimplenet_Admin_Settings_Package_and_Rules {
    public function __construct() {
        
	    add_action( 'tgmpa_register', array( $this,  'required_plugins' ));
	    
        // Hook into the admin menu
        add_action( 'admin_menu', array( $this, 'admin_menu_general' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu_wallets' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu_matrix' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu_package_settings_and_rules' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu_pairing' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu_referral' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu_withdrawal' ) );
        
    }



     public function admin_menu_general()
	{
		 add_submenu_page(
            'edit.php?post_type=rimplenettransaction',
            __( 'Settings: General', 'text-domain' ),
            __( 'Settings: General', 'text-domain' ),
            'manage_options',
            'settings_general',
            array( $this, 'settings_general_fxn' )
            );
	}

	public function settings_general_fxn()
	{

	  include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/layouts/admin-settings-general.php';

     }

     public function admin_menu_wallets()
	{
		 add_submenu_page(
            'edit.php?post_type=rimplenettransaction',
            __( 'Settings: Wallets', 'text-domain' ),
            __( 'Settings: Wallets', 'text-domain' ),
            'manage_options',
            'settings_wallets',
            array( $this, 'settings_wallets_fxn' )
            );
	}

	public function settings_wallets_fxn()
	{

	  include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/layouts/admin-settings-wallets.php';

     }


     public function admin_menu_matrix()
	{
		 add_submenu_page(
            'edit.php?post_type=rimplenettransaction',
            __( 'Settings: Matrix', 'text-domain' ),
            __( 'Settings: Matrix', 'text-domain' ),
            'manage_options',
            'settings_matrix',
            array( $this, 'settings_matrix_fxn' )
            );
	}

	public function settings_matrix_fxn()
	{

	  include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/layouts/admin-settings-matrix.php';

     }



    public function admin_menu_pairing()
	{
		 add_submenu_page(
            'edit.php?post_type=rimplenettransaction',
            __( 'Settings: Pairing and Rules', 'text-domain' ),
            __( 'Settings: Pairing and Rules', 'text-domain' ),
            'manage_options',
            'settings_pairing_and_rules',
            array( $this, 'settings_pairing_and_rules_fxn' )
            );
	}

	public function settings_pairing_and_rules_fxn()
	{

	  include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/layouts/admin-settings-pairing.php';

     }


    public function admin_menu_package_settings_and_rules()
	{
		 add_submenu_page(
            'edit.php?post_type=rimplenettransaction',
            __( 'Settings: Packages / Plans and Rules', 'text-domain' ),
            __( 'Settings: Packages / Plans and Rules', 'text-domain' ),
            'manage_options',
            'settings_package_plans_and_rules',
            array( $this, 'settings_package_plans_and_rules_fxn' )
            );
	}

	public function settings_package_plans_and_rules_fxn()
	{

	  include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/layouts/admin-settings-package.php';

		

     }

    public function admin_menu_referral()
	{
		 add_submenu_page(
            'edit.php?post_type=rimplenettransaction',
            __( 'Settings: Referral', 'text-domain' ),
            __( 'Settings: Referral', 'text-domain' ),
            'manage_options',
            'settings_referral',
            array( $this, 'settings_referral_fxn' )
            );
	}

	public function settings_referral_fxn()
	{

	  include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/layouts/admin-settings-referral.php';

     }
     
     
    public function admin_menu_withdrawal()
	{
		 add_submenu_page(
            'edit.php?post_type=rimplenettransaction',
            __( 'Settings: Withdrawal', 'text-domain' ),
            __( 'Settings: Withdrawal', 'text-domain' ),
            'manage_options',
            'settings_withdrawal',
            array( $this, 'settings_withdrawal_fxn' )
            );
	}

	public function settings_withdrawal_fxn()
	{

	  include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/layouts/admin-settings-withdrawal.php';

     }
     
     
    function required_plugins() {
 
		    $plugins = array(
		       array(
		          'name'      => 'WooCommerce',
		          'slug'      => 'woocommerce',
		          'required'  => true, // this plugin is required
		        )
		     );

		    
		    $config = array(
		    'id'           => 'rimplenet-mlm-plugin-actiavtor', // your unique TGMPA ID
		    'default_path' => get_stylesheet_directory() . '/lib/plugins/', // default absolute path
		    'menu'         => 'rimplenet-mlm-install-required-plugins', // menu slug
		    'has_notices'  => true, // Show admin notices
		    'dismissable'  => true, // the notices are NOT dismissable
		    'dismiss_msg'  => 'The following plugins are needed for proper functionality of the RIMPLENET MLM, Wallets, Rules and Rewarder Plugin', // this message will be output at top of nag
		    'is_automatic' => true, // automatically activate plugins after installation
		    'message'      => 'Install & Activate the following Plugins', // message to output right before the plugins table
		     );
		     
		    tgmpa( $plugins, $config );
		 
	}



 }

$Rimplenet_Admin_Settings_Package_and_Rules = new Rimplenet_Admin_Settings_Package_and_Rules();
?>