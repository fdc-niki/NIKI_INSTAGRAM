<h2>MANAGE USERS</h2>

<form class="" action="" method="get">
    <input type="text" name="search" value=""><br>
    <button type="submit" name="submit_search_users">SEARCH</button>
</form>

<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th class="col">USER ID</th>
            <th class="col">NAME</th>
            <th class="col">EMAIL</th>
            <th class="col">CREATE DATE</th>
            <th class="col">MODIFIED DATE</th>
            <th class="col"></th>
            <th class="col"></th>
            <th class="col"></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($view_users as $user) { ?>
            <tr>
                <td><?php echo $user["User"]["user_id"]; ?></td>
                <td><?php echo $user["User"]["user_name"]; ?></td>
                <td><?php echo $user["User"]["user_email"]; ?></td>
                <td><?php echo $user["User"]["user_created"]; ?></td>
                <td><?php echo $user["User"]["user_modified"]; ?></td>
                <td>
                    <img src="<?php echo "/niki_instagram/cakephp/app/webroot/profile_pictures/" . $user["User"]["user_image_path"]; ?>" alt="" style="width: 200px" >
                </td>
                <td>
                    <button type="button" name="button">
                        <a href="/niki_instagram/cakephp/users/edit_user?user_id=<?php echo $user["User"]["user_id"]; ?>">EDIT</a>
                    </button>
                </td>
                <td>
                    <form class="" action="/niki_instagram/cakephp/users/delete_user?user_id=<?php echo $user["User"]["user_id"]; ?>" method="post">
                        <button type="submit" name="submit_delete_user">DELETE</button>
                    </form>
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>

<?php
echo $this->Paginator->numbers();
?>
