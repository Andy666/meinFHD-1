<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>meinFHD</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="HandheldFriendly" content="true" />
		
		<!--apple meta tags-->
		<meta name="apple-mobile-web-app-capable" content="yes" />
		
		<!-- Styles -->
		<link rel="stylesheet/less" type="text/css" href="resources/bootstrap/less/bootstrap.less">
		<link rel="stylesheet/less" type="text/css" href="resources/bootstrap/less/responsive.less">
		<link rel="stylesheet/less" type="text/css" href="resources/less/meinfhd.less">
		<link rel="stylesheet/less" type="text/css" href="resources/less/meinfhd-responsive.less">
		
		<!--LESS compiler-->
		<script src="resources/lessjs/dist/less-1.3.0.min.js" type="text/javascript"></script>
	</head> <!-- /head -->
	<body>
		<?php print $messages; ?>
		<?php // if user eingeloggt ?>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">meinFHD<span>mobile</span></a>
					<div class="nav-collapse">
						<ul class="nav">
							<li class="active"><a href="index.html">Dashboard</a></li>
							<li><a href="#">Studienplanung</a></li>
							<li><a href="#">Persönlich Daten</a></li>
							<li><a href="#">Hilfe</a></li>
							<li><a href="#">Impressum</a></li>
							<!--LOGOUT-->
							<li><a href="#">Logout</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<?php // else zeige pseudonav ?>
		<!--pseudonav-->
		<!-- <div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
			</div>
		</div> -->
		<!--pseudonav ends here-->
		<?php # endif; ?>