<div class="wrap">
    <div id="icon-edit-pages" class="icon32 icon32-posts-page"><br></div>
    <h2>WordpREST API documentation</h2>
<br>
    <?php
        $args = array(
            'publicly_queryable' => true,
            'public'             => true
        );
        $post_types = array_merge(array('all'), get_post_types($args));
        unset($post_types['attachment']);
    ?>

    <h3>I - Introduction</h3>
    <p>
        WordpREST API is a Wordpress plugin that turns your blog into a powerful REST API in one click, without any configuration!
        <br>
        This plugin lets you get all your content as JSON, create new posts, and edit or delete them, through a few dead simple endpoints.
    </p>

    <h3>II - All routes</h3>
    <p>
        By default, WordpREST API will create a few routes for you. If you want, you can <a href="#all_routes">see all API routes</a>!
        <br>
        Basically, the plugin created one route for every type of content (resource) you have, so you're very REST compliant.
    </p>

    <h3>III - Authentication</h3>
    <p>
        For some actions, you'll need to authenticate on the API. If you only need to get/read some content, you don't have to worry about that.
    </p>
    <p>
        Actually, for anything else than getting some content, you'll have to tell the API who you are, so it can check if you're allowed to process your request.
        For any creation (POST), edition (PUT) or deletion (DELETE), you'll need to provide your API key, with a GET parameter.
        If you don't provide an API key, or if the one you're providing is wrong, the API will answer with a proper error.
    </p>
    <p>
        You should send us your API Key via a GET parameter, this way :

        <p class="description">http://www.foo.com/api/bar?api_key=YourApiKey</p>
    </p>
    <p><a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=security">Click here to get your API Key</a></p>

    <h3>IV - Get content (GET)</h3>
    <p>
        Lorem ipsum dolor sit amet
    </p>

    <h3>V - Create content (POST)</h3>
    <p>
        Lorem ipsum dolor sit amet
    </p>

    <h3>VI - Edit content (PUT)</h3>
    <p>
        Lorem ipsum dolor sit amet
    </p>

    <h3>VII - Delete content (DELETE)</h3>
    <p>
        Lorem ipsum dolor sit amet
    </p>
    <br>
    <br>

    <table id="all_routes" class="wp-list-table widefat fixed users" cellspacing="0">
        <thead>
            <tr>
                <th scope='col'><span>Method</span></th>
                <th scope='col' style="width: 40%;"><span>Endpoint</span></th>
                <th scope='col'><span>Description</span></th>
                <th scope='col'><span>Required parameters</span></th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th scope='col'><span>Method</span></th>
                <th scope='col'><span>Endpoint</span></th>
                <th scope='col'><span>Description</span></th>
                <th scope='col'><span>Required parameters</span></th>
            </tr>
        </tfoot>

        <tbody id="the-list" data-wp-lists='list:user'>
            <?php
                foreach ($post_types as $post_type) {
            ?>
                <tr>
                    <td style="border-bottom: 1px solid #333;">
                        <br>
                        <strong><?php echo $post_type; ?></strong>
                    </td>
                    <td style="border-bottom: 1px solid #333;"></td>
                    <td style="border-bottom: 1px solid #333;"></td>
                    <td style="border-bottom: 1px solid #333;"></td>
                </tr>
                <tr>
                    <td>GET</td>
                    <td><?php $url = get_bloginfo('url') . '/api/' . $post_type; ?><a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a></td>
                    <td>Get all posts from <?php echo $post_type; ?></td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>POST</td>
                    <td><?php echo get_bloginfo('url') . '/api/' . $post_type; ?></td>
                    <td>Create a post in <?php echo $post_type; ?></td>
                    <td>api_key</td>
                </tr>
                <tr>
                    <td>GET</td>
                    <td><?php echo get_bloginfo('url') . '/api/' . $post_type . '/{id}'; ?></td>
                    <td>Get a post from <?php echo $post_type; ?></td>
                    <td>ID</td>
                </tr>
                <tr>
                    <td>PUT</td>
                    <td><?php echo get_bloginfo('url') . '/api/' . $post_type . '/{id}'; ?></td>
                    <td>Edit a post from <?php echo $post_type; ?></td>
                    <td>ID, api_key</td>
                </tr>
                <tr>
                    <td>DELETE</td>
                    <td><?php echo get_bloginfo('url') . '/api/' . $post_type . '/{id}'; ?></td>
                    <td>Delete a post from <?php echo $post_type; ?></td>
                    <td>ID, api_key</td>
                </tr>
            <?php
                }
            ?>
        </tbody>

    </table>
</div>
