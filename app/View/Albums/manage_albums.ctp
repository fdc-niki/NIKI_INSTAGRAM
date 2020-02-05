<h2>MANAGE ALBUMS</h2>
<form class="" action="" method="get">
    SEARCH: <input type="text" name="search" value=""><br>
    <button type="submit" name="submit_search_albums">SUBMIT</button>
</form>
<br><br>


<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th class="col">ALBUM ID</th>
            <th class="col">TITLE</th>
            <th class="col">DESCRIPTION</th>
            <th class="col">CREATED DATE</th>
            <th class="col">MODIFIED DATE</th>
            <th class="col">USER ID</th>
            <th class="col">USER NAME</th>
            <th class="col"></th>
            <th class="col"></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($view_all_albums as $album) { ?>
            <tr>
                <td><?php echo $album['Album']['album_id']; ?></td>
                <td>
                    <a href="/niki_instagram/cakephp/images/home?album_id=<?php echo $album["Album"]["album_id"]; ?>&album_title=<?php echo $album["Album"]["album_title"]; ?>"><?php echo $album["Album"]["album_title"]; ?></a>
                </td>
                <td><?php echo $album["Album"]["album_description"]; ?></td>
                <td><?php echo $album["Album"]["album_created"]; ?></td>
                <td><?php echo $album["Album"]["album_modified"]; ?></td>
                <td><?php echo $album['Album']['user_id']; ?></td>
                <td><?php echo $album['User']['user_name']; ?></td>
                <td>
                    <button type="button" name="button">
                        <?php echo $this->Html->link('EDIT', array('action' => 'edit_album', $album['Album']['album_id'])); ?>
                    </button>
                </td>
                <td>
                    <form class="" action="/niki_instagram/cakephp/Albums/delete_album?album_id=<?php echo $album["Album"]["album_id"]; ?>" method="post">
                        <button type="submit" name="submit_delete_album">DELETE</button>
                    </form>
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>

<?php
echo $this->Paginator->numbers();
?>
