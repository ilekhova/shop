angular.module 'IrkaApp', ['ngRoute', 'ngResource', 'ngAnimate']
	.config ($routeProvider, $locationProvider) ->
		$routeProvider
			.when '/',
				templateUrl: '../templates/main.html'

			.when '/goods',
				controller: 'GoodCtrl'
				templateUrl: '../templates/goods.html'

			.when '/goods/:id',
				controller: 'ItemCtrl'
				templateUrl: '../templates/item.html'

			.when '/cart',
				controller: 'CartCtrl'
				templateUrl: '../templates/cart.html'

			.otherwise
				redirectTo: '/'

		# $locationProvider.html5Mode true