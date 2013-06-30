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
    private function getTaxonomies()
    {
        return array();
    }

    /**
     * If there is one, returns the thumbnail
     * @return array $thumbnail
     */
    private function getThumbnail()
    {
        return array();
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
