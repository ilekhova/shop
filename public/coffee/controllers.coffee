angular.module 'IrkaApp'

	.controller 'MainCtrl', ($scope, $location) ->
		$scope.isActive = (nav) ->
			location = do $location.path

			if $location.path().length > 1
				location = $location.path().substr 1

			if nav == location
				return true

			return false

	.controller 'GoodCtrl', ($scope, $resource, Good, Cart, Additions) ->
		# Делаем запрос в БД для получения всех товаров
		$scope.goods = do Good.query

		# Получаем "фишечки" для товара
		$scope.additions = do Additions.query

		# Поля для select'а
		$scope.selects = {}

		# Функция добавление товара в корзину
		$scope.addToCart = (id, additions) ->
			$scope.cartGood = new Cart
				id: id
				additions: additions

			$scope.cartGood.$save (data) ->
				console.log data


	.controller 'ItemCtrl', ($scope, $routeParams, Good) ->
		# Получаем конкретный товар
		$scope.item = Good.get id: parseInt $routeParams.id, 10

	.controller 'CartCtrl', ($scope, $routeParams, Cart) ->
		$scope.cartGoods = do Cart.query