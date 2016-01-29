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
<div class="col-lg-8">
    <h1>Event name</h1>
    <p>
        This is a description of the event, covering IC and OOC information, premise, and so on.<br><br>
        <?=nl2br('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mollis fermentum ante, vitae fringilla augue bibendum a. Donec non lacus urna. Vestibulum maximus semper neque, sit amet consequat augue faucibus et. Cras viverra lacus velit, in faucibus erat facilisis et. Sed ut dictum nisl. Nulla facilisi. Cras convallis, dui non euismod accumsan, tortor lacus vulputate elit, sit amet imperdiet urna tellus eu ante. In quis erat sagittis, iaculis justo euismod, efficitur arcu. Sed rhoncus lorem a ex pellentesque luctus. Cras sollicitudin semper mauris ac bibendum. Donec ultrices, nulla ac eleifend pulvinar, elit neque fermentum dui, nec mollis nunc orci ac risus. Vestibulum eget enim diam. Nullam accumsan metus quis rutrum volutpat. Maecenas aliquet molestie sapien, quis fringilla felis elementum at. Aliquam massa neque, consequat eu nisi id, auctor volutpat diam. Praesent venenatis nisi ex, sit amet fringilla libero dapibus quis.

Sed dignissim lectus in gravida sollicitudin. In fringilla felis mattis mauris sollicitudin tincidunt. Nullam lectus risus, sagittis vel consectetur rutrum, egestas at nunc. Vestibulum placerat lacus sit amet metus molestie faucibus. Pellentesque tempor, nibh suscipit faucibus lacinia, metus mauris viverra velit, nec rutrum metus leo ut metus. Pellentesque in faucibus eros. Suspendisse a turpis dolor. Vestibulum ut facilisis ipsum, vitae vestibulum tortor. Proin vitae vestibulum lectus. Ut fringilla est vitae est ultrices faucibus. Sed molestie neque sit amet augue egestas varius. Donec placerat luctus dolor vel tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.

Quisque mattis diam mauris. Fusce in ultrices mi. Praesent id tristique metus. Donec egestas augue enim, a molestie ligula placerat sed. Maecenas fermentum vehicula laoreet. Praesent nulla metus, ornare id erat ut, pulvinar cursus arcu. Nam eget tincidunt mauris. Curabitur malesuada feugiat aliquet. Pellentesque vitae porta nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam erat volutpat. Nulla eget urna sapien.')?>
    </p>
</div><!-- /col-lg-8 -->
<div class="col-lg-4">
	<h2>
		Tickets
		<button class="btn btn-default btn-sm pull-right">Buy now</button>
	</h2>
	<h3>Player Tickets</h3>
	<table class="table table-striped">
		<tr>
			<td>
				<big>Player Ticket</big><br>
				<small>Standard player ticket</small>
			</td>
			<td class="text-right">&pound;70.00</td>
		</tr>
		<tr>
			<td>
				<big>Hardship Ticket</big><br>
				<small>Player ticket for those with less resources</small>
			</td>
			<td class="text-right">&pound;55.00</td>
		</tr>
		<tr>
			<td>
				<big>Waiting List</big><br>
				<small>Put yourself on the waiting list</small>
			</td>
			<td class="text-right"></td>
		</tr>
	</table>
	<h3>Crew Tickets</h3>
	<table class="table table-striped">
		<tr>
			<td>
				<big>Crew Ticket</big><br>
				<small>Standard crew ticket with catering</small>
			</td>
			<td class="text-right">&pound;17.00</td>
		</tr>
	</table>
	<h3>Other</h3>
	<table class="table table-striped">
		<tr>
			<td>
				<big>Donation</big><br>
				<small>No ticket, no bonus, just adding a bit extra to event funds</small>
			</td>
			<td class="text-right"></td>
		</tr>
	</table>
</div><!-- /col-lg-4 -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>