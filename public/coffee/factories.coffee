angular.module 'IrkaApp'
	.factory 'Good', ($resource) ->
		$resource '/items/:id'

	.factory 'Cart', ($resource) ->
		$resource '/cart'

	.factory 'Additions', ($resource) ->
		$resource '/additions'