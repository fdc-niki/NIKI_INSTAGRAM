<h2>MANAGE POSTS</h2>
<form class="" action="" method="get">
    <input type="text" name="search" value=""><br>
    <button type="submit" name="submit_search_image">SEARCH</button>
</form>

<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col"></th>
            <th scope="col">IMAGE ID</th>
            <th scope="col">TITLE</th>
            <th scope="col">DESCRIPTION</th>
            <th scope="col">CREATED DATE</th>
            <th scope="col">MODIFIED DATE</th>
            <th scope="col">ALBUM ID</th>
            <th scope="col">ALBUM TITLE</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($view_posts as $posts) { ?>
            <tr>
                <td>
                    <img src="<?php echo "/niki_instagram/cakephp/app/webroot/post_images/" . $posts["Image"]["image_path"]; ?>" alt="" style="width: 200px">
                </td>
                <td><?php echo $posts["Image"]["image_id"]; ?></td>
                <td><?php echo $posts["Image"]["image_title"]; ?></td>
                <td><?php echo $posts["Image"]["image_description"]; ?></td>
                <td><?php echo $posts["Image"]["image_created"]; ?></td>
                <td><?php echo $posts["Image"]["image_modified"]; ?></td>
                <td><?php echo $posts["Image"]["album_id"]; ?></td>
                <td><?php echo $posts["Album"]["album_title"]; ?></td>
                <td>
                    <button type="button" name="button">
                        <a href="/niki_instagram/cakephp/images/edit_image?image_id=<?php echo $posts["Image"]["image_id"]; ?>">EDIT</a>
                    </button>
                </td>
                <td>
                    <form class="" action="/niki_instagram/cakephp/images/delete_image?image_id=<?php echo $posts["Image"]["image_id"]; ?>" method="post">
                        <button type="submit" name="submit_delete_image">DELETE</button>
                    </form>
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>

<?php
echo $this->Paginator->numbers();
?>
