<h2>Add Image</h2>
<a href="/niki_instagram/cakephp/images/home?album_id=<?php echo $album_id; ?>">BACK TO ALBUM</a>
<div class="panel panel-default text-left">
    <div class="panel-body">
        <form enctype="multipart/form-data" class="" action="/niki_instagram/cakephp/images/add_image?album_id=<?php echo $album_id; ?>" method="post">
            <div class="form-group">
                <label for="">TITLE:</label>
                <input type="text" name="input_image_title" value="">
            </div>
            <div class="form-group">
                <label for="">DESCRIPTION:</label>
                <input type="text" name="input_image_description" value="">
            </div>
            <div class="form-group">
                <label for="">PICTURE</label>
                <input type="file" name="input_add_image" value="">
            </div>
            <button type="submit" name="submit_add_image">ADD</button>
        </form>
    </div>
</div>
