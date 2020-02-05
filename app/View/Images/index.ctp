<h2>POSTS</h2>

<?php foreach($view_posts as $posts) { ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #404040; color: white;"><?php echo $posts["Image"]["image_title"]; ?></div>
                <div class="panel-body">
                    <img src="<?php echo "/niki_instagram/cakephp/app/webroot/post_images/" . $posts["Image"]["image_path"]; ?>" class="img_responsive" alt="" style="width: 100%;" >
                </div>
                <div class="panel-footer"><?php echo $posts["Image"]["image_description"]; ?></div>
            </div>
        </div>
    </div>
<?php } ?>

<?php
echo $this->Paginator->numbers();
?>
