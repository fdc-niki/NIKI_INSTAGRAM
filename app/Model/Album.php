<?php
class Album extends AppModel {
    public $primaryKey = 'album_id';

    public $belongsTo = 'User';
    public $hasMany = 'Image';

}
 ?>
