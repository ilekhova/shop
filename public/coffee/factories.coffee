angular.module 'IrkaApp'
	.factory 'Good', ($resource) ->
		$resource '/items/:id'