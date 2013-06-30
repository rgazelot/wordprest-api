<?php

namespace Wordprest\Service;

class Query
{
    /**
     * Format posts array and add some useful data
     * @param  array $posts
     * @return array
     */
    public function format($posts)
    {
        $response = array();

        foreach ($posts as $post) {
            $postArray = $this->postToArray($post);
            $postArray['post_author'] = $this->getAuthor($post);
            $postArray['taxonomies'] = $this->getTaxonomies($post);
            $postArray['thumbnail'] = $this->getThumbnail($post);
            $postArray['metadata'] = $this->getMetadata($post);
            $response[] = $postArray;
        }

        return $response;
    }

    /**
     * Post object to array
     * @param  Object $post
     * @return Array
     */
    private function postToArray($post)
    {
        return (array) $post;
    }

    /**
     * Returns information about the author
     * @return array $author
     */
    private function getAuthor($post)
    {
        $meta = get_user_meta((int) $post->post_author);

        // Why the fuck does this method return an array of arrays ?!
        return array(
            'first_name'  => $meta['first_name'][0],
            'last_name'   => $meta['last_name'][0],
            'nickname'    => $meta['nickname'][0],
            'description' => $meta['description'][0]
        );
    }

    /**
     * Returns information about taxonomies (all of them)
     * @return array $taxonomies
     */
    private function getTaxonomies($post)
    {
        $response = array();
        $taxonomies = get_object_taxonomies($post->post_type);

        foreach ($taxonomies as $taxonomy) {
            $terms = get_the_terms($post->ID, $taxonomy);
            if (!empty($terms)) {
                $response[$taxonomy] = array();
                foreach ($terms as $term)
                    $response[$taxonomy][] = $term;
            }
        }

        return $response;
    }

    /**
     * If there is one, returns the thumbnail
     * @return array $thumbnail
     */
    private function getThumbnail($post)
    {
        $image = null;

        if (has_post_thumbnail($post->ID)) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
        } else {
            $args = array(
               'post_type'      => 'attachment',
               'numberposts'    => 1,
               'post_status'    => null,
               'post_mime_type' => 'image',
               'post_parent'    => $post->ID
            );

            $attachments = get_posts($args);
            $image = wp_get_attachment_image_src($attachments[0]->ID, 'large');
        }

        if (empty($image)) {
            return array();
        }

        return array(
            'src' => $image[0],
            'width' => $image[1],
            'height' => $image[2]
        );
    }

    /**
     * Returns information about metadata, if there are some
     * @return array $metadata
     */
    private function getMetadata()
    {
        return array();
    }
}
