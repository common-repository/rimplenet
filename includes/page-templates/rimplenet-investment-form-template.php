<?php
   if(!is_user_logged_in()) {
?>
  <center>
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong> ERROR: </strong> Please Login or Register to Procced
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
   </div>
  </center>
<?php
     return ;
   }
?>
<?php
//Included from shortcode in includes/class-investments.php
//use case [rimplenet-investment-form linked_package="868" wallet_id="eth,blcc" min="eth:0.1,blcc:20" max="eth:10,blcc:5000"]
 global $current_user;
 wp_get_current_user();

$atts = shortcode_atts( array(

    'action' => 'empty',
    'user_id' => $current_user->ID,
    'linked_package' => '',
    'wallet_id' => 'all',

), $atts );


$action = $atts['action'];
$user_id = $atts['user_id'];
$linked_package = $atts['linked_package'];
$wallet_id = $atts['wallet_id'];

$wallet_obj = new Rimplenet_Wallets();
$all_wallets = $wallet_obj->getWallets();

?>

<div class="clearfix"></div><br>
    <div class='rimplenetmlm' style="max-width:600px;margin:auto;">
        <div class="rimplenet-investment-form">
            
            

    
    <?php
    
    if(isset($_POST['rimplenet-investment-form']) && wp_verify_nonce($_POST['rimplenet-investment-form'], 'rimplenet-investment-form' )) {
          
          global $wpdb;
        
        
          $amount = sanitize_text_field(trim($_POST['amount']));
          $payment_wallet = sanitize_text_field(trim($_POST['payment_wallet']));
          
                  
            if (empty($payment_wallet)) {
              $status_error = "Payment Wallet is empty";
            }
            
            elseif (empty($amount)) {
             $status_error = "Amount is empty";
            }
            
            elseif ($amount<1) {
             $status_error = "Min Investment should be greater than 0";
            }
            
            else{   
                
               $investment_info = $this->rimplenet_wallet_investment($user_id, $amount, $payment_wallet);
               
               	if($investment_info>1){
        		    $status_success = 'Investment Successful';
        		    if(!empty($linked_package)){
        		    update_post_meta($investment_info,'linked_package',$linked_package);
        		    }
        		    do_action('rimplenet_investment_successful', $investment_info, $current_user, $wallet_id, $amount,$note );
        		
        		}
        		else{
        		    
        		    $status_error = $investment_info;
        		    do_action('rimplenet_investment_failed', $investment_info, $current_user, $wallet_id, $amount,$note );
        		
        		}
		
               
            }
    }
    ?>
          
          
              
        <div class="rimplenet-status-msg">
            <center>
          
          <?php

                 if (!empty($status_success)) {
               
              ?>

              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> SUCCESS: </strong> <?php echo $status_success; ?>
              </div>
              <?php
                }


           ?>
           
             
          <?php

                 if (!empty($status_error)) {
               
              ?>

              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> ERROR: </strong> <?php echo $status_error; ?>
              </div>
              <?php
                }


           ?>
              
          </center>
        </div>  
            
        <form action="" method="POST" class="rimplenet-investment-form" id="rimplenet-investment-form" > 
  
            <div class="clearfix"></div><br>
            <div class="row">
             <div class="col-lg-12">
              <label for="payment_wallet"> <strong> Select Wallet </strong> </label>
             
                <select name="payment_wallet" id="rimplenet-select-payment-wallet" class="rimplenet-select rimplenet-select-payment-wallet" required="">
                    
                    <?php
                     
                     if($wallet_id=='all'){
                        
                        foreach($all_wallets as $wallet){
                          $wallet_id_op = $wallet['id'];
                          if($wallet['include_in_withdrawal_form']=='yes'){
                           $user_wdr_bal = $wallet_obj->get_withdrawable_wallet_bal($user_id, $wallet_id_op);
                           $dec = $wallet['decimal'];
                           $symbol = $wallet['symbol'];
                           $symbol_position = $all_wallets[$wallet_id_op]['symbol_position'];
                           
                           $disp_info = getRimplenetWalletFormattedAmount($user_wdr_bal,$wallet_id_op,'wallet_name');
                           
                          ?>
                            <option value="<?php echo $wallet_id_op; ?>" > <?php echo $disp_info; ?> </option> 
                        <?php
                           }
                         }
                         
                         
                     }
                     else{
                         $withdrawal_wallets_op = explode(",",$wallet_id);
                         foreach($withdrawal_wallets_op as $wallet_id_op){
                           $wallet_id_op = trim($wallet_id_op);
                           $user_wdr_bal = $wallet_obj->get_withdrawable_wallet_bal($user_id, $wallet_id_op);
                           $dec = $all_wallets[$wallet_id_op]['decimal'];
                           $symbol = $all_wallets[$wallet_id_op]['symbol'];
                           $symbol_position = $all_wallets[$wallet_id_op]['symbol_position'];
                          
                           $disp_info = getRimplenetWalletFormattedAmount($user_wdr_bal,$wallet_id_op,'wallet_name');
                         ?>
                        <option value="<?php echo $wallet_id_op; ?>"> <?php echo $disp_info; ?> </option> 
                    <?php
                         }
                     }
                     ?>
                    
                </select>
             </div>
            
            
            <div class="clearfix"></div><br>   
             <div class="col-lg-12">
             <label for="amount"> <strong> Amount </strong> </label>
             <input name="amount" id="rimplenet-input-amount" class="rimplenet-input rimplenet-input-amount" placeholder="0" type="number" min="<?php echo $min_price; ?>" max="<?php echo $max_price; ?>"  value="" required="">       
             </div>
            
             
           <div class="col-lg-12">
                <?php wp_nonce_field( 'rimplenet-investment-form', 'rimplenet-investment-form' ); ?>
                <div class="clearfix"></div>
                <br>
                <center>
                  <input class="rimplenet-button rimplenet-submit-investment-form" id="rimplenet-submit-investment-form" type="submit" value="INVEST">
                </center>
           </div>
          </div> 
              
         </form>
 
            
            
        </div>
    </div>
</div>