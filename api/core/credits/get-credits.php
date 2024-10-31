<?php

use Credits\GetCredits\BaseCredits;

$getCredits = new Class extends BaseCredits
{
    public function __construct() {
        add_action('rest_api_init', [$this, 'register_api_routes']);
    }

    public function register_api_routes()
    {
        register_rest_route('rimplenet/v1', 'credits', [
            'methods' => 'GET',
            'callback' => [$this, 'api_get_credits']
        ]);
    }

    public function api_get_credits(WP_REST_Request $req)
    {
        # ================= set fields ============
        $wlt_id  = sanitize_text_field($req['credit_id']);
        $page      = $req['page'] ?? 1;

        if ($wlt_id !== '') :
            return new WP_REST_Response($this->getCredits($wlt_id, 'credit'));
        else:
            return "Credit Smilling";
        endif;
    }
};