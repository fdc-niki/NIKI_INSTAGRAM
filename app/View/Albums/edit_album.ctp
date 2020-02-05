<h2>Edit Album</h2>
<a href="/niki_instagram/cakephp/albums/home">BACK TO ALBUMS</a>
<div class="panel panel-default text-left">
    <div class="panel-body">
        <?php
        echo $this->Form->create('Album');
        echo $this->Form->input('album_title');
        echo $this->Form->input('album_description', array('row' => '3'));
        // echo $this->Form->input('album_id', array('type' => 'hidden'));
        echo $this->Form->end('Update Album');
         ?>
    </div>
</div>
<!-- <form class="" action="/niki_instagram/cakephp/albums/edit_album" method="post">
    <label for="">Album Title</label>
    <input type="text" name="input_edit_album_title" value="<?php echo $view_album["Album"]["album_title"]; ?>">
    <br><br>
    <label for="">Album Description</label>
    <input type="text" name="input_edit_album_description" value="<?php echo $view_album["Album"]["album_description"]; ?>">
    <br><br>
    <button type="submit" name="submit_album_edit">UPDATE</button>
</form> -->
