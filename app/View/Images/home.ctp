<h2>MY IMAGES</h2>
<a href="/niki_instagram/cakephp/images/add_image?album_id=<?php echo $this->request->query("album_id"); ?>">ADD IMAGE</a>
<!-- <a href="/niki_instagram/cakephp/images/add_image">ADD IMAGE</a> -->
<br><br>

<?php foreach($view_all_images as $image) { ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #404040; color: white; font-weight: bold;">
                    <?php echo $image["Image"]["image_title"]; ?>
                </div>
                <div class="panel-body">
                    <img src="<?php echo "/niki_instagram/cakephp/app/webroot/post_images/" . $image["Image"]["image_path"]; ?>" alt="" style="width: 100%" >
                    <p><?php echo $image["Image"]["image_description"]; ?></p>
                    <p style="text-align: left;">created date: <?php echo $image["Image"]["image_created"]; ?></p>
                    <p style="text-align: left;">modified date: <?php echo $image["Image"]["image_modified"]; ?></p>
                </div>
                <div class="panel-footer" style="display: inline-block;">
                    <button type="button" name="edit_button" style="float: left;">
                        <?php echo $this->Html->link('EDIT', array('action' => 'edit_image', $image['Image']['image_id'], $image['Album']['album_id'])); ?>
                    </button>
                    <form style="float: right;" class="" action="/niki_instagram/cakephp/images/delete_image?image_id=<?php echo $image["Image"]["image_id"]; ?>&album_id=<?php echo $image["Album"]["album_id"]; ?>" method="post">
                        <button type="submit" name="submit_delete_image">DELETE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php
echo $this->Paginator->numbers();
?>
