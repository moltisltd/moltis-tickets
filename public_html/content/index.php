<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Bootstrap 101 Template</title>

	<!-- Bootstrap -->
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/css/default.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Project name</a>
		</div><!-- /navbar-header -->
		<div id="navbar" class="navbar-collapse collapse">
			<form class="navbar-form navbar-right">
				<div class="form-group">
					<input type="text" placeholder="Email" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" placeholder="Password" class="form-control">
				</div>
				<button type="submit" class="btn btn-success">Sign in</button>
			</form>
		</div><!-- /navbar-collapse -->
	</div>
</nav>
<div class="container">
<div class="col-lg-12">
    <h1>Project name</h1>
    <p>
       This is a description of the project, including whatever details are wanted..<br><br>
        <?=nl2br('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mollis fermentum ante, vitae fringilla augue bibendum a. Donec non lacus urna. Vestibulum maximus semper neque, sit amet consequat augue faucibus et. Cras viverra lacus velit, in faucibus erat facilisis et. Sed ut dictum nisl. Nulla facilisi. Cras convallis, dui non euismod accumsan, tortor lacus vulputate elit, sit amet imperdiet urna tellus eu ante. In quis erat sagittis, iaculis justo euismod, efficitur arcu. Sed rhoncus lorem a ex pellentesque luctus. Cras sollicitudin semper mauris ac bibendum. Donec ultrices, nulla ac eleifend pulvinar, elit neque fermentum dui, nec mollis nunc orci ac risus. Vestibulum eget enim diam. Nullam accumsan metus quis rutrum volutpat. Maecenas aliquet molestie sapien, quis fringilla felis elementum at. Aliquam massa neque, consequat eu nisi id, auctor volutpat diam. Praesent venenatis nisi ex, sit amet fringilla libero dapibus quis.')?>
    </p>
</div><!-- /col-lg-12 -->
<div class="col-lg-12">
	<h2>
		Events
	</h2>
	<table class="table table-striped">
		<tr>
			<td>
				<big><a href="events/">Event Name</a></big><br>
				<small>April 8-10, 2016</small>
			</td>
			<td class="text-right">
				<a class="btn btn-default" href="events/">More info &amp; tickets</a>
			</td>
		</tr>
		<tr>
			<td>
				<big><a href="events/">Event Name</a></big><br>
				<small>April 8-10, 2016</small>
			</td>
			<td class="text-right">
				<a class="btn btn-default" href="events/">More info &amp; tickets</a>
			</td>
		</tr>
	</table>
</div><!-- /col-lg-12 -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>