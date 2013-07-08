<h1>Security</h1>
<h2>Generate your key and start hacking the API!</h2>
<table>
    <?php
        $users = get_users();
        $apiKeys = get_option('wordprest_api_keys');

        foreach ($users as $user) {
            echo
            "<tr>
                <td>{$user->user_email}</td>
                <td>{$user->user_login}</td>
                <td>{$user->roles[0]}</td>
                <td>{$apiKeys[$user->ID]}</td>
                <td>
                    <form method='post' action='admin-post.php'>
                        <input type='hidden' name='action' value='generate_key' />
                        <input type='hidden' name='wordprest_user_ID' value='{$user->ID}' />
                        <input type='submit' value='Generate a key' class='button-primary' />
                    </form>
                </td>
                <td>
                    <form method='post' action='admin-post.php'>
                        <input type='hidden' name='action' value='delete_key' />
                        <input type='hidden' name='wordprest_user_ID' value='{$user->ID}' />
                        <input type='submit' value='Delete key' class='button-primary' />
                    </form>
                </td>
            </tr>";
        }
    ?>
</table>
