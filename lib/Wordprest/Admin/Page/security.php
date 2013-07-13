<div class="wrap">
    <div id="icon-users" class="icon32"><br></div>
    <h2>API Security</h2>
    <br>
    <h3>Generate your key and start hacking the API!</h3>
    <?php
        $users = get_users();
        $apiKeys = get_option('wordprest_api_keys');
    ?>

    <table class="wp-list-table widefat fixed users" cellspacing="0">
        <thead>
        <tr>
            <th scope='col' id='username' class='manage-column column-username sortable desc'  style=""><span>Identifiant</span></th>
            <th scope='col' id='name' class='manage-column column-name sortable desc'  style=""><span>Nom</span></th>
            <th scope='col' id='email' class='manage-column column-email sortable desc'  style=""><span>E-mail</span></th>
            <th scope='col' id='role' class='manage-column column-role'  style=""><span>Rôle</span></th>
            <th scope='col' id='posts' class='manage-column column-posts num'  style=""><span>API Key</span></th>
            <th scope='col' class='manage-column'><span>Generate key</span></th>
            <th scope='col' class='manage-column'><span>Delete key</th>
        </tr>
        </thead>

        <tfoot>
            <tr>
                <th scope='col'  class='manage-column column-username sortable desc'  style="">
                </th>
                <th scope='col'  class='manage-column column-name sortable desc'  style="">
                </th>
                <th scope='col'  class='manage-column column-email sortable desc'  style="">
                </th>
                <th scope='col'  class='manage-column column-role'  style="">
                </th>
                <th scope='col'  class='manage-column column-posts num'  style="">
                </th>
                <th scope='col'  class='manage-column column-posts num'  style="">
                </th>
                <th scope='col'  class='manage-column column-posts num'  style="">
                </th>
            </tr>
        </tfoot>

        <tbody id="the-list" data-wp-lists='list:user'>

        <?php foreach ($users as $user) { ?>

            <tr id='user-2' class="alternate">
                <td class="username column-username">
                    <img alt="" src="http://0.gravatar.com/avatar/ab97c12d2de3bbf423e9b2a064ed9722?s=32&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D32&amp;r=G" class="avatar avatar-32 photo" height="32" width="32">
                    <strong>
                        <?php echo $user->user_login; ?>
                    </strong><br />
                </td>
                <td class="name column-name">
                    <?php echo $user->user_nicename; ?>
                </td>
                <td class="email column-email">
                    <?php echo $user->user_email; ?>
                </td>
                <td class="role column-role">
                    <?php echo $user->roles[0]; ?>
                </td>
                <td>
                    <?php echo $apiKeys[$user->ID]; ?>
                </td>
                <td class="posts column-posts">
                    <?php
                        echo "<form method='post' action='admin-post.php'>
                            <input type='hidden' name='action' value='generate_key' />
                            <input type='hidden' name='wordprest_user_ID' value='{$user->ID}' />
                            <input type='submit' value='Generate a key' class='button-primary' />
                        </form>";
                    ?>
                </td>
                <td class="posts column-posts">
                    <?php
                        echo "<form method='post' action='admin-post.php'>
                            <input type='hidden' name='action' value='delete_key' />
                            <input type='hidden' name='wordprest_user_ID' value='{$user->ID}' />
                            <input type='submit' value='Delete key' class='button-primary' />
                        </form>";
                    ?>
                </td>
            </tr>

        <?php } ?>

        </tbody>

    </table>
</div>
