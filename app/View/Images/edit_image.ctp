<h2>Edit Image</h2>
<a href="/niki_instagram/cakephp/images/home?album_id=<?php echo $view_image["Image"]["album_id"]; ?>">BACK TO ALBUM</a>
<br><br>
<div class="panel panel-default text-left">
    <div class="panel-body">
        <form class="" action="/niki_instagram/cakephp/images/edit_image?image_id=<?php echo $view_image['Image']['image_id']; ?>&album_id=<?php echo $view_image["Image"]["album_id"]; ?>" method="post">
            <label for="">Image Title</label>
            <input type="text" name="input_edit_image_title" value="<?php echo $view_image["Image"]["image_title"]; ?>">
            <br><br>
            <label for="">Image Descpription</label>
            <input type="text" name="input_edit_image_description" value="<?php echo $view_image["Image"]["image_description"]; ?>">
            <br><br>
            <button type="submit" name="submit_image_edit">UPDATE</button>
        </form>
    </div>
</div>
