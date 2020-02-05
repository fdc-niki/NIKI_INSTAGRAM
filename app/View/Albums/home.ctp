<h2>MY ALBUMS</h2>
<a href="/niki_instagram/cakephp/albums/create_album">CREATE ALBUM</a>
<br><br>
<?php foreach($view_all_albums as $album) { ?>
    <div class="row" style="text-align: center;">
        <div class="col-sm-12" style="display: inline-block;">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #404040; color: white; font-weight: bold;">
                    <a href="/niki_instagram/cakephp/images/home?album_id=<?php echo $album["Album"]["album_id"]; ?>&album_title=<?php echo $album["Album"]["album_title"]; ?>"><?php echo $album["Album"]["album_title"]; ?></a>
                </div>
                <div class="panel-body">
                    <p style="font-weight: bold; overflow-wrap: break-word; word-wrap: break-word;"><?php echo $album["Album"]["album_description"]; ?></p>
                    <p style="text-align: left;">created date: <?php echo $album["Album"]["album_created"]; ?></p>
                    <p style="text-align: left;">modified date: <?php echo $album["Album"]["album_modified"]; ?></p>
                </div>
                <div class="panel-footer" style="display: inline-block;">
                    <button type="button" name="edit_button" style="float: left;">
                        <?php echo $this->Html->link('EDIT', array('action' => 'edit_album', $album['Album']['album_id'])); ?>
                    </button>
                    <form style="float: right;" class="" action="/niki_instagram/cakephp/Albums/delete_album?album_id=<?php echo $album["Album"]["album_id"]; ?>" method="post">
                        <button type="submit" name="submit_delete_album">DELETE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php
echo $this->Paginator->numbers();
?>
