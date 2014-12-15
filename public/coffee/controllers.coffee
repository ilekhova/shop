angular.module 'IrkaApp'

	.controller 'MainCtrl', ($scope, $location) ->
		$scope.isActive = (nav) ->
			location = do $location.path

			if $location.path().length > 1
				location = $location.path().substr 1

			if nav == location
				return true

			return false

	.controller 'GoodCtrl', ($scope, $resource, Good) ->
		# Делаем запрос в БД для получения всех товаров
		$scope.goods = do Good.query

	.controller 'ItemCtrl', ($scope, $routeParams, Good) ->
		# Получаем конкретный товар
		$scope.item = Good.get id: parseInt $routeParams.id, 10