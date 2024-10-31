<?php

use Debits\CreateDebits\BaseDebits;

$createDebits = new class extends BaseDebits
{

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'register_api_routes']);
    }

    public function register_api_routes()
    {
        register_rest_route('/rimplenet/v1', 'debits', [
            'methods' => 'POST',
            'callback' => [$this, 'api_create_debits']
        ]);
    }

    public function api_create_debits(WP_REST_Request $req)
    {
        $this->req = [
            'note'          => sanitize_text_field($req['note'] ?? ''),
            'user_id'       => (int) $req['user_id'],
            'wallet_id'     => sanitize_text_field(strtolower($req['wallet_id'])),
            'request_id'      => sanitize_text_field($req['request_id']),
            'amount_to_add' => floatval(-str_replace('-', '', $req['amount'])),
        ];

        # check for required fields
        if ($this->checkEmpty())
            return new WP_REST_Response($this->response);

        if ($db = $this->createDebits()) :
            return new WP_REST_Response([
                'status' => 200,
                'response_message' => 'Executed',
                'data' => [$db]
            ]);
        else :
            return new WP_REST_Response($this->response);
        endif;
    }
};
