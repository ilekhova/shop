<!doctype html>
<html lang="en" ng-app="IrkaApp">
<head>
	<meta charset="UTF-8">
	<title>Интернет магазин Иры</title>
	<link rel="stylesheet" href="http://bootswatch.com/simplex/bootstrap.min.css">
	<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">
</head>
<body ng-controller="MainCtrl">
		
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">

			<div class="navbar-header">
				<a class="navbar-brand" href="/landing">Ирка Апп</a>
			</div>

			<div class="nav navbar-nav navbar-right">
				<li><a href="/landing">Главная</a></li>
				<li ng-class="{ active: isActive('goods') }"><a href="#/goods">Товары</a></li>
				<li  ng-class="{ active: isActive('cart') }"><a href="#/cart" class="pos-rel">Корзина <span class="madmed-little-float-quantity" ng-bind="totalCountCart"></span></a></li>
			</div>

		</div>
	</div>


	<div ng-view class="slide-animation"></div>

	<!-- JavaScript -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<script src="https://code.angularjs.org/1.2.26/angular.min.js"></script>
	<script src="https://code.angularjs.org/1.2.26/angular-route.min.js"></script>
	<script src="https://code.angularjs.org/1.2.27/angular-resource.min.js"></script>
	<script src="https://code.angularjs.org/1.2.27/angular-animate.min.js"></script>

	<script src="js/app.js"></script>
	<script src="js/controllers.js"></script>
	<script src="js/factories.js"></script>
	<script src="js/filters.js"></script>
</body>
</html>
