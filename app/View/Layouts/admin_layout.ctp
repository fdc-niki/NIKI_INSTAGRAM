<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>NIKINSTAGRAM</title>
	<?php
		// echo $this->Html->meta('icon');

		echo $this->Html->css('cake.niki');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
	/* Set black background color, white text and some padding */
	footer {
	  background-color: #555;
	  color: white;
	  padding: 15px;
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
		    	<a class="navbar-brand" href="/niki_instagram/cakephp/admins/home">NIKINSTAGRAM</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		    	<ul class="nav navbar-nav">
					<li class="active"><a href="/niki_instagram/cakephp/admins/home">HOME</a></li>
					<li><a href="/niki_instagram/cakephp/albums/manage_albums">MANAGE ALBUMS</a></li>
					<li><a href="/niki_instagram/cakephp/images/manage_images">MANAGE POSTS</a></li>
					<li><a href="/niki_instagram/cakephp/users/manage_users">MANAGE USERS</a></li>
					<li>
						<form class="navbar-form navbar-right" action="/niki_instagram/cakephp/admins/logout" method="post">
							<button class="btn" type="submit" name="logout_button">LOGOUT</button>
						</form>
					</li>
		    	</ul>
		    </div>
		</div>
	</nav>
	<!-- <div id="container" class="container">
		<div class="header-logo"><h1>NIKINSTAGRAM</h1></div>
		<nav class="header-nav">
			<ul>
				<li><a href="/niki_instagram/cakephp/admins/home">ADMIN MY PAGE</a></li>
				<li><a href="/niki_instagram/cakephp/albums/manage_albums">MANAGE ALBUMS</a></li>
				<li><a href="/niki_instagram/cakephp/images/manage_images">MANAGE POSTS</a></li>
				<li><a href="/niki_instagram/cakephp/users/manage_users">MANAGE USERS</a></li>
				<li>
					<form action="/niki_instagram/cakephp/admins/logout" method="post">
						<button type="submit" name="logout_button">LOGOUT</button>
					</form>
				</li>
			</ul>
		</nav>
	</div> -->

	<div class="container text-center">
		<div class="row">
			<div id="content">

				<?php echo $this->Flash->render(); ?>

				<?php echo $this->fetch('content'); ?>
			</div>

	  	</div>

		<div id="footer">
			<footer class="container-fluid text-center">
				<!-- <?php echo $this->element('sql_dump'); ?> -->
			</footer>
		</div>
	</div>

</body>
</html>
