<?php

use Referrals\DeleteReferrals\BaseReferrals;

$RimplenetdeleteReferralsApi = new class extends RimplenetDeleteReferrals
{

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'register_api_routes']);
    }

    public function register_api_routes()
    {
        register_rest_route('/rimplenet/v1', 'referrals', [
            'methods' => 'DELETE',
            'callback' => [$this, 'delete_user_referral']
        ]);
    }

    public function delete_user_referral(WP_REST_Request $request)
    {

        $user = $this->validate($request);

        if (empty($this->validation_error)) {

            $this->req = [
                'user_id'       => (int) $request['user_id'],
                'user_referral'     => $user['user_meta']['referral'],
            ];

            
            // add_user_meta($request['user_id'] ?? 1, 'rimplenet_user_refferral', $user['user_meta']['referral']);
            $deletereferral=$this->deleteReferrals();
            return new WP_REST_Response( $deletereferral );

        }

        $response['status_code'] = 400;
        $response['status'] = 'failed';
        $response['error'] = $this->validation_error;

        return new WP_REST_Response($response, $response['status_code']);
    }

    public function validate($request)
    {
        $referral_error = [];

        

        $user_meta['referral'] = sanitize_text_field( $request->get_param( 'referral' ) );
        

        if ($user_meta['referral'] == '') {
            $referral_error[] = 'Refferral Id is required';
        }

        if (!empty($referral_error)) {
            $this->validation_error[] = ['first_name' => $referral_error];
        }
      

        return ['user_meta' => $user_meta];
    }

  
};
