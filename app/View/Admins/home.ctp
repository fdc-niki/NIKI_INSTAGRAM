<h2>ADMIN MY PAGE</h2>
<!-- <a href="/niki_instagram/cakephp/admins/register_admin">REGISTER ADMIN MEMBER</a> -->
<br><br>

<!-- how many images were uploaded today?) (how many users registered today?) {how many albums were created today? -->
<p>Today's uploaded Images: <a href="/niki_instagram/cakephp/images/manage_images"><?php echo $count_images; ?></a></p>
<p>Today's uploaded Albums: <a href="/niki_instagram/cakephp/albums/manage_albums"><?php echo $count_albums; ?></a></p>
<p>Today's registered Users: <a href="/niki_instagram/cakephp/users/manage_users"><?php echo $count_users; ?></a></p>
