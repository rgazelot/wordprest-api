<?php

namespace Wordprest\Service;

class Payload
{
    /**
     * [success description]
     * @return [type] [description]
     */
    public function success($data)
    {
        status_header(200);
        $data = array(
            'success' => array('data' => $data)
        );
        $this->send($data);
    }

    /**
     * [error description]
     * @return [type] [description]
     */
    public function error($data, $code = 400, $message = 'error')
    {
        status_header($code);
        $data = array(
            'error' => array(
                'data' => $data,
                'message' => $message
            )
        );
        $this->send($data);
    }

    private function send($data)
    {
        wp_send_json($data);
    }
}
