<?php
class User extends AppModel {
    public $primaryKey = 'user_id';

    public $hasMany = 'Album';
}
 ?>
