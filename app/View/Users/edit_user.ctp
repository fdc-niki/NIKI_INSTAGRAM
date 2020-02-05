<h2>Edit User</h2>
<a href="/niki_instagram/cakephp/users/manage_users">BACK TO MANAGE USERS</a>
<br><br>
<!-- <?php
echo $this->Form->create('User');
echo $this->Form->input('user_name');
echo $this->Form->input('user_email');
// echo $this->Form->input('album_id', array('type' => 'hidden'));
echo $this->Form->end('Update User');
 ?> -->

 <div class="col-sm-12">
     <div class="panel panel-default">
         <div class="panel-body" style="text-align: left;">
             <form class="" action="/niki_instagram/cakephp/users/edit_user?user_id=<?php echo $view_user["User"]["user_id"]; ?>" method="post">
                 <label for="">Name: </label>
                 <input type="text" name="input_edit_user_name" value="<?php echo $view_user["User"]["user_name"]; ?>">
                 <br><br>
                 <label for="">Email: </label>
                 <input type="text" name="input_edit_user_email" value="<?php echo $view_user["User"]["user_email"]; ?>">
                 <br><br>
                 <label for="">Current Password: </label>
                 <input type="password" name="input_current_user_password" value="">
                 <br><br>
                 <label for="">New Password: </label>
                 <input type="password" name="input_new_user_password" value="">
                 <br><br>
                 <button type="submit" name="submit_user_edit">UPDATE</button>
             </form>
         </div>
     </div>
</div>
