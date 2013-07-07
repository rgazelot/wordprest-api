<?php

namespace Wordprest\Service;

class Insert
{
    public function save($data, $postType, $id)
    {
        if (empty($data)) {
            throw new \Exception('data POST parameter is missing');
        }

        $data['post_type'] = $postType;

        if (!empty($id)) {
            $data['ID'] = (int) $id;
        } else {
            unset($data['ID']);
        }

        $result = wp_insert_post($data, true);

        if (is_WP_Error($result)) {
            throw new \Exception('missing mandatory parameters');
        }

        header('Location: ' . get_bloginfo('url') . '/api/' . $postType . '/' . $id);
        die;
    }

    public function delete($id)
    {
        // wp_delete_post((int) $id);
    }
}
