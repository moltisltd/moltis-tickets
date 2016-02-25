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
    <h1>
		Event name tickets<br>
		<small>April 8 - 10, 2016</small>
	</h1>
</div><!-- /col-lg-12 -->
<div class="col-lg-12">
	<h3>Player Tickets</h3>
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="col-lg-7">Ticket type</th>
				<th class="col-lg-2 text-center">Price/each</th>
				<th class="col-lg-1 text-center">Quantity</th>
				<th class="col-lg-2 text-right">Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<big>Player Ticket</big><br>
					<small>Standard player ticket</small>
				</td>
				<td class="text-center">&pound;70.00</td>
				<td class="text-center">
					<select class="form-control input-sm" onchange="$('#ticket1').html(70 * $(this).val());">
						<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</td>
				<td class="text-right">&pound;<span id="ticket1">0.00</span></td>
			</tr>
			<tr>
				<td>
					<big>Hardship Ticket</big><br>
					<small>Player ticket for those with less resources</small>
				</td>
				<td class="text-center">&pound;55.00</td>
				<td class="text-center">
					<select class="form-control input-sm" onchange="$('#ticket2').html(55 * $(this).val());">
						<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</td>
				<td class="text-right">&pound;<span id="ticket2">0.00</span></td>
			</tr>
			<tr>
				<td>
					<big>Waiting List</big><br>
					<small>Put yourself on the waiting list</small>
				</td>
				<td class="text-center">FREE</td>
				<td class="text-center">
					<select class="form-control input-sm">
						<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</td>
				<td class="text-right">FREE</td>
			</tr>
	</table>
	<h3>Crew Tickets</h3>
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="col-lg-7">Ticket type</th>
				<th class="col-lg-2 text-center">Price/each</th>
				<th class="col-lg-1 text-center">Quantity</th>
				<th class="col-lg-2 text-right">Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<big>Crew Ticket</big><br>
					<small>Standard crew ticket with catering</small>
				</td>
				<td class="text-center">&pound;17.00</td>
				<td class="text-center">
					<select class="form-control input-sm" onchange="$('#ticket3').html(17 * $(this).val());">
						<option>0</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</td>
				<td class="text-right">&pound;<span id="ticket3">0.00</span></td>
			</tr>
		</tbody>
	</table>
	<h3>Other</h3>
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="col-lg-7">Ticket type</th>
				<th class="col-lg-2 text-center">Price/each</th>
				<th class="col-lg-1 text-center">Quantity</th>
				<th class="col-lg-2 text-right">Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<big>Donation</big><br>
					<small>No ticket, no bonus, just adding a bit extra to event funds</small>
				</td>
				<td class="text-center">-</td>
				<td class="text-center">
					<input class="form-control input-sm" onchange="$('#ticket4').html($(this).val());" value="0.00">
				</td>
				<td class="text-right">&pound;<span id="ticket4">0.00</span></td>
			</tr>
		</tbody>
	</table>
</div><!-- /col-lg-12 -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>