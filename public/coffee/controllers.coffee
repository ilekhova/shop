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

	.controller 'CartCtrl', ($scope, $rootScope, $routeParams, Cart, $http, $location) ->
		# Общая стоимость
		$scope.totalPrice = 0

		# Не показываем товары
		$scope.showCart = no

		# Делаем зарос на получение товаров
		$rootScope.cartGoods = Cart.query ->
			# Подсчитываем общую стоимость
			angular.forEach $rootScope.cartGoods, (value, index) ->
				$scope.totalPrice += value.total_price * value.quantity

			if $rootScope.cartGoods.length then $scope.showCart = yes
		
		$scope.deleteItem = (itemId) ->
			$http.delete 'cart', params: item_id: itemId
			
			quantity = 0
			price = 0

			angular.forEach $rootScope.cartGoods, (val, index) ->
				if val.order_item == itemId
					$rootScope.cartGoods.splice index, 1
					quantity = val.quantity
					price = val.total_price
					return true

			$rootScope.totalCountCart -= quantity
			$scope.totalPrice -= price * quantity

			if $rootScope.totalCountCart == 0 then $scope.showCart = no


		$scope.submitOrder = ->

			swal
				title: 'Вы уверены?'
				text: 'После того, как оформите заказ, Вы не сможете сгененировать XML, вы точно хотите оформить заказ без генерации XML файла?'
				type: 'warning'
				showCancelButton: yes
				confirmButtonText: 'Да, оформить заказ'
				cancelButtonText: 'Нет'
				closeOnConfirm: no
				closeOnCancel: no
				(isConfirm) ->
					# Если пользователь нажал что хочет оформить заказ
					if isConfirm

						$http.get 'cartOrder'
							.success (data) ->
								# Если данные пришли нормально
								if data == 'ok'
									# Выводим попап
									swal
										title: 'Заказ оформлен'
										text: 'Мы рады что Вы пользуетесь нашим магазином!'
										type: 'success'

									# Устанавливаем значения по нулям
									$rootScope.cartGoods = []
									$rootScope.totalCountCart = 0
									$scope.showCart = no

									$location.path '/goods'

							.error (data) ->
								console.log 'error'

					else

						swal
							title: 'Заказ не оформлен'
							text: 'Ну это какой-то текст'
							type: 'error'


	.controller 'OrderCtrl', ($scope, Orders, SingleOrder) ->
		# Конкретный заказ пользователя
		$scope.singleOrders = []
		$scope.totalPrice = 0

		$singleOrder = $('#single-order')

		# Все совершенные заказы пользователя
		$scope.orders = Orders.query ->
			console.log $scope.orders

		$scope.showOrder = (orderId) ->
			$scope.totalPrice = 0
			$scope.singleOrders = SingleOrder.get(orderId).query ->
				angular.forEach $scope.singleOrders, (value, index) ->
					$scope.totalPrice += value.total_price * value.quantity

				$singleOrder.modal 'show'

		
