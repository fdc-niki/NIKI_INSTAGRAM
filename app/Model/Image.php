<?php
class Image extends AppModel {
    public $primaryKey = 'image_id';

    public $belongsTo = 'Album';

}
 ?>
