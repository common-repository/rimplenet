<?php
/**
 * The api-facing functionality of the plugin.
 *
 * @link       https://rimplenet.com/
 * @since      1.0.0
 *
 * @package    Rimplenet
 * @subpackage Rimplenet/api
 */
/**
 * The api-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * @package    Rimplenet
 * @subpackage Rimplenet/api
 * @author     Rimplenet <info@rimplenet.com>
 */
class Rimplenet_Api {

	public function __construct() {
		$this->load_required_files();
	}
	
    private function load_required_files() {
   	 //Add Required Files to Load
	 require_once plugin_dir_path( dirname( __FILE__ ) ) . 'api/core/wallets/class-base-wallets.php';
	 require_once plugin_dir_path( dirname( __FILE__ ) ) . 'api/core/debits/class-base-debits.php';
	 require_once plugin_dir_path( dirname( __FILE__ ) ) . 'api/core/credits/class-base-credits.php';
     require_once plugin_dir_path( dirname( __FILE__ ) ) . 'api/core/users/class-base-users.php';
    //  require_once plugin_dir_path( dirname( __FILE__ ) ) . 'api/core/users/class-base-auth.php';
	 require_once plugin_dir_path( dirname( __FILE__ ) ) . 'api/core/referrals/class-base-referral.php';
	 require_once plugin_dir_path( dirname( __FILE__ ) ) . 'api/core/transactions/class-base-transactions.php';
    }
	
}


$Rimplenet_Api = new Rimplenet_Api();