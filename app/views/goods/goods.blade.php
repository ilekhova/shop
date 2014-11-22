<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Irina Project</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar navbar-mad">
	<div class="container">

		<div class="navbar-header">
			<a href="#" class="navbar-brand">Brand</a>
		</div>

		<ul class="nav navbar-nav navbar-right">
			<li><a href="#">
				<i class="fa fa-shopping-cart"></i>
				<span class="price">300$</span>
			</a></li>
		</ul>

	</div>
</div>

<div class="container">
	
	<div class="row">
		<?php foreach($item as $good):?>
		<div class="col-sm-4">
			<img src="img/items/{{ $good->filename }}" class="img-responsive text-center" alt="" width="200" >
			<h4>{{ $good->name }}</h4>
			<div class="row">
				<div class="col-sm-6">
					<h5>{{ $good->price , ' руб.' }}</h5>
				</div>
				<div class="col-sm-6">
					<button class="btn btn-primary">Buy Now</button>
				</div>
			</div>
		</div>
		<?php endforeach;?>
	</div>
</div>
</body>
</html>