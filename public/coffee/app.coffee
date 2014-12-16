angular.module 'IrkaApp', ['ngRoute', 'ngResource', 'ngAnimate']
	.config ($routeProvider, $locationProvider) ->
		$routeProvider

			.when '/goods',
				controller: 'GoodCtrl'
				templateUrl: '../templates/goods.html'

			.when '/goods/:id',
				controller: 'ItemCtrl'
				templateUrl: '../templates/item.html'

			.when '/cart',
				controller: 'CartCtrl'
				templateUrl: '../templates/cart.html'

			.when '/orders/:id?',
				controller: 'OrderCtrl'
				templateUrl: '../templates/orders.html'

			.otherwise
				redirectTo: '/goods'

		# $locationProvider.html5Mode true