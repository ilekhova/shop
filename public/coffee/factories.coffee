angular.module 'IrkaApp'
	.factory 'Good', ($resource) ->
		$resource '/items/:id'

	.factory 'Cart', ($resource) ->
		$resource '/cart'

	.factory 'Additions', ($resource) ->
		$resource '/additions'

	.factory 'Orders', ($resource) ->
		$resource '/orders/:order_id', order_id: '@id'

	.factory 'SingleOrder', ($resource) ->

		get: (order_id) ->
			$resource "/orders/#{order_id}"

		# $resource '/orderSingle'