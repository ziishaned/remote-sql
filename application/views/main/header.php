<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Remote SQL</title>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/dbpage.ico" type="image/png">
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/jquery.toast.css" rel="stylesheet">
		<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.toast.js"></script>
		
		<!-- Codemirror -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/codemirror/lib/codemirror.css" />
		<script src="<?php echo base_url(); ?>assets/codemirror/lib/codemirror.js"></script>
		<script src="<?php echo base_url(); ?>assets/codemirror/mode/sql/sql.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/codemirror/addon/hint/show-hint.css" />
		<script src="<?php echo base_url(); ?>assets/codemirror/addon/hint/show-hint.js"></script>
		<script src="<?php echo base_url(); ?>assets/codemirror/addon/hint/sql-hint.js"></script>
		<script src="<?php echo base_url(); ?>assets/codemirror/addon/selection/active-line.js"></script>
		<script src="<?php echo base_url(); ?>assets/codemirror/addon/runmode/runmode.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/codemirror/theme/monokai.css">		
	</head>
	<body>
		<?php if ($this->session->flashdata('already_loggedIn')): ?>
			<?php echo $this->session->flashdata('already_loggedIn'); ?>
		<?php endif; ?>
		<?php if ($this->session->flashdata('login_failed')): ?>
			<div class="row errors">
				<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-lg-4 col-lg-offset-4">
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $this->session->flashdata('login_failed'); ?>
					</div>
				</div>
			</div>
		<?php endif ?>
		<?php if ($this->session->userdata('logged_in') === TRUE): ?>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<nav class="navbar navbar-default main-nav" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle nav-respon" data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#">Remote SQL Editor</a>
						</div>
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<ul class="nav navbar-nav">
								<li <?php if ($cur_page === 'home'): ?>class="active activeMan"<?php endif ?>><a href="<?php echo base_url(); ?>user/dashboard"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
								<li <?php if ($cur_page === 'query'): ?>class="active activeMan"<?php endif ?>><a href="<?php echo base_url(); ?>rsql/query"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>Query</a></li>
								<!-- <li><a href="#"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>Query Builder</a></li> -->
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<!-- <li <?php //if ($cur_page === 'activity'): ?>class="active activeMan"<?php //endif ?>><a href="<?php //echo base_url(); ?>user/activity"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> User Activity</a></li> -->
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>Setting <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li <?php if ($cur_page === 'profile'): ?>class="active activeMan"<?php endif ?>><a href="<?php echo base_url(); ?>user/profile"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile</a></li>
										<li <?php if ($cur_page === 'condb'): ?>class="active activeMan"<?php endif ?>><a href="<?php echo base_url(); ?>rsql/con_db"><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> Connect to DB</a></li>
										<li class="divider"></li>
										<li><a href="<?php echo base_url(); ?>user/logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<ul class="list-group" style="height: 48px; margin-bottom: 0px;">
							<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-4 col-lg-5 col-lg-offset-4">
								<li class="list-group-item db_con_list text-info">Connected Database: <span class="connected-db"><?php echo $this->session->userdata('current_db'); ?></span></li>
							</div>
						</ul>
					</div>				
				</div>
			</div>
		<?php endif ?>

<script>
	var curren_db = "<?php echo $this->session->userdata('current_db'); ?>",
		db_slug	  = "<?php echo $this->session->userdata('db_slug'); ?>"
	if (!curren_db && !db_slug ) {
		$('.connected-db').html('No Connection');
	};	
</script>