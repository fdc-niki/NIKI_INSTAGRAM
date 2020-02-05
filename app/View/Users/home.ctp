<h2>MY PAGE</h2>
<br><br>
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-body" style="text-align: left;">
            <h4>NAME: <?php echo $view_user["User"]["user_name"]; ?></h4>
            <h4>EMAIL: <?php echo $view_user["User"]["user_email"]; ?></h4>
            <h4>PASSWORD: *****</h4>
            <h4>REGISTERED DATE: <?php echo $view_user["User"]["user_created"]; ?></h4>
            <h4>LAST UPDATED DATE: <?php echo $view_user["User"]["user_modified"]; ?></h4>
            <div class="" style="display: inline-block;">
                <button type="button" name="button">
                    <a href="/niki_instagram/cakephp/users/edit_user?user_id=<?php echo $view_user["User"]["user_id"]; ?>">EDIT</a>
                </button>
                <form style="float: right;" class="" action="/niki_instagram/cakephp/users/delete_user?user_id=<?php echo $view_user["User"]["user_id"]; ?>" method="post">
                    <button type="submit" name="submit_delete_user">DELETE</button>
                </form>
            </div>
        </div>
    </div>
</div>
