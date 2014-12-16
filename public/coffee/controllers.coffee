angular.module 'IrkaApp'

	.controller 'MainCtrl', ($scope, $rootScope, $location, Cart) ->
		$scope.isActive = (nav) ->
			location = do $location.path

			if $location.path().length > 1
				location = $location.path().substr 1

			if nav == location
				return true

			return false

		# Количество товаров в корзине
		$rootScope.totalCountCart = 0

		cart = Cart.query ->
			length = 0

			angular.forEach cart, (val, index) ->
				length += parseInt val.quantity

			$rootScope.totalCountCart = length

	.controller 'GoodCtrl', ($scope, $rootScope, $resource, Good, Cart, Additions, $timeout) ->

		$rootScope.loading = []

		# Делаем запрос в БД для получения всех товаров
		$scope.goods = Good.query ->
			angular.forEach $scope.goods, (value, index) ->
				$rootScope.loading[index] = no

		# Получаем "фишечки" для товара
		$scope.additions = do Additions.query

		# Поля для select'а
		$scope.selects = {}

		# Функция добавление товара в корзину
		$scope.addToCart = (id, additions) ->

			# Показ загрузки
			$rootScope.loading[id-1] = yes

			$scope.cartGood = new Cart
				id: id
				additions: additions

			$scope.cartGood.$save (data) ->
				console.log data
				$rootScope.loading[id-1] = no
				$rootScope.totalCountCart += 1


	.controller 'ItemCtrl', ($scope, $routeParams, Good) ->
		# Получаем конкретный товар
		$scope.item = Good.get id: parseInt $routeParams.id, 10

	.controller 'CartCtrl', ($scope, $rootScope, $routeParams, Cart, $http) ->
		$rootScope.cartGoods = do Cart.query

		$scope.deleteItem = (itemId) ->
			$http.delete 'cart', params: item_id: itemId
			
			quantity = 0

			angular.forEach $rootScope.cartGoods, (val, index) ->
				if val.order_item == itemId
					$rootScope.cartGoods.splice index-1, 1
					quantity = val.quantity
					return true

			$rootScope.totalCountCart -= quantity







		