<!DOCTYPE HTML>
<html>
<head>
<title><?php echo isset($title)? 'What Can I Bring? | ' . $title: 'What Can I Bring? &mdash; Create, Plan and Manage Group Meals' ?></title>
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="pagewrap">
	<div class="wrap">
	<div class="header">
	
		<?php
			if (isset($username))
			{
				echo $username;
				echo anchor('authentication/logout', 'Logout');
			}
		?>
		<h1>Welcome to WhatCanIBring?</h1>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">WhatCanIBring</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
			<li><?php echo anchor('/', 'Home');?></li>
			<li><?php echo anchor('/myevents/', 'My Events');?></li>
			<li><?php echo anchor('/authentication/my_profile', 'My Profile');?></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>		
	</div> <!-- end header -->
	<div id="content">

		<?php $this->load->view($content);?>

	</div><!-- end content -->
	<div id="footer">
	</div><!-- end footer -->
</div><!-- end wrap -->
</div><!-- end page -->
</body>
</html>