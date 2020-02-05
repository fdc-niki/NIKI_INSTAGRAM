<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>NIKINSTAGRAM</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php
echo $this->Html->css('cake.niki');
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');

 ?>
	<style>
		/* Set black background color, white text and some padding */
		footer {
		  background-color: #555;
		  color: white;
		  padding: 15px;
		}

		body{
			background: linear-gradient(to top, rgb(49, 120, 149) 0%, rgb(171, 207, 221) 100%);
			background-size: cover;
			background-repeat:  no-repeat;  /* 背景の繰り返し設定 */
			background-position: center;    /* 背景の位置指定 */
		}

		.row span a{
			color: white;
		}

		.panel-heading a{
			color: white;
		}

	</style>

</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/niki_instagram/cakephp/users/home">NIKINSTAGRAM</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="/niki_instagram/cakephp/users/home">HOME</a></li>
					<li><a href="/niki_instagram/cakephp/albums/home">MY ALBUMS</a></li>
					<li><a href="/niki_instagram/cakephp/images/">POSTS</a></li>
					<li>
						<form class="navbar-form navbar-right" action="/niki_instagram/cakephp/users/logout" method="post">
							<button class="btn" type="submit" name="logout_button">LOGOUT</button>
						</form>
					</li>
				</ul>
			</div>
		</div>
	</nav>

<!-- Left Menu -->
	<div class="container text-center">
		<div class="row">
			<div class="col-sm-3 well">
		    	<div class="well">
		        	<p><a href="/niki_instagram/cakephp/users/home"><?php echo $user_info["User"]["user_name"]; ?></a></p>
		        	<img src="<?php echo "/niki_instagram/cakephp/app/webroot/profile_pictures/" . $user_info['User']['user_image_path']; ?>" class="img-square" width="100%" alt="Avatar">
		      	</div>
		      	<div class="">
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#edit_profile_image">Edit</button>
		      	</div>
	    	</div>

			<!-- Modal -->
			<div class="modal fade" id="edit_profile_image" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
			    	<div class="modal-header">
			      		<button type="button" class="close" data-dismiss="modal">&times;</button>
			      		<h4 class="modal-title">Edit Profile Image</h4>
			    	</div>
				    <div class="modal-body">
						<img src="<?php echo "/niki_instagram/cakephp/app/webroot/profile_pictures/" . $user_info['User']['user_image_path']; ?>" class="img-square" width="50%">
						<form  enctype="multipart/form-data" class="" action="/niki_instagram/cakephp/users/edit_profile_image?user_id=<?php $user_info['User']['user_id']; ?>" method="post">
							<label for="">SELECT FILE:</label>
							<input type="file" class="form-control-file" id="" name="new_profile_image">
							<br><br>
							<button type="submit" class="btn btn-default" name="submit_edit_profile_image">Submit</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</form>
				    </div>
				</div>

			</div>
			</div>

<!-- Above menu (for search function)-->
			<div class="col-sm-7">
		        <div class="row">
		          	<div class="col-sm-12">
		            	<div class="panel panel-default text-left">
		              		<div class="panel-body">
						  		<form class="" action="" method="get">
						      		SEARCH: <input type="text" name="search" value="">
						      		<button type="submit" name="submit_search">SUBMIT</button>
						  		</form>
		              		</div>
		            	</div>
		          	</div>
		        </div>

				<div id="content">
					<?php echo $this->Flash->render(); ?>
					<?php echo $this->fetch('content'); ?>
				</div>

	  		</div>
		</div>
	</div>

	<div id="footer">
		<footer class="container-fluid text-center">
			<!-- <?php echo $this->element('sql_dump'); ?> -->
		</footer>
	</div>

</body>
</html>
