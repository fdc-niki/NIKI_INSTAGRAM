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
					<li><a href="/niki_instagram/cakephp/images/index">POSTS</a></li>
					<li><a href="/niki_instagram/cakephp/users/register">REGISTRATION</a></li>
					<li><a href="/niki_instagram/cakephp/users/login">LOGIN</a></li>
					<li><a href="/niki_instagram/cakephp/admins/login">ADMIN LOGIN</a></li>
				</ul>
			</div>
		</div>
	</nav>

<!-- Left Menu -->
	<div class="container text-center">
		<div class="row">
			<div class="col-sm-3 well">
		    	<div class="well">
		        	<p>Hello Guest!</p>
		        	<img src="/niki_instagram/cakephp/app/webroot/img/person.jpg" class="img-square" width="100%" alt="Avatar">
		      	</div>
		      	<div class="">
					<button type="button" class="btn btn-info btn-lg"><a href="/niki_instagram/cakephp/users/login">LOGIN</a></button>
		      	</div>
	    	</div>

			<div class="col-sm-7">
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
