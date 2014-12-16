(function() {
  angular.module('IrkaApp').controller('MainCtrl', function($scope, $rootScope, $location, Cart) {
    var cart;
    $scope.isActive = function(nav) {
      var location;
      location = $location.path();
      if ($location.path().length > 1) {
        location = $location.path().substr(1);
      }
      if (nav === location) {
        return true;
      }
      return false;
    };
    $rootScope.totalCountCart = 0;
    return cart = Cart.query(function() {
      var length;
      length = 0;
      angular.forEach(cart, function(val, index) {
        return length += parseInt(val.quantity);
      });
      return $rootScope.totalCountCart = length;
    });
  }).controller('GoodCtrl', function($scope, $rootScope, $resource, Good, Cart, Additions, $timeout) {
    $rootScope.loading = [];
    $scope.goods = Good.query(function() {
      return angular.forEach($scope.goods, function(value, index) {
        return $rootScope.loading[index] = false;
      });
    });
    $scope.additions = Additions.query();
    $scope.selects = {};
    return $scope.addToCart = function(id, additions) {
      $rootScope.loading[id - 1] = true;
      $scope.cartGood = new Cart({
        id: id,
        additions: additions
      });
      return $scope.cartGood.$save(function(data) {
        console.log(data);
        $rootScope.loading[id - 1] = false;
        return $rootScope.totalCountCart += 1;
      });
    };
  }).controller('ItemCtrl', function($scope, $routeParams, Good) {
    return $scope.item = Good.get({
      id: parseInt($routeParams.id, 10)
    });
  }).controller('CartCtrl', function($scope, $rootScope, $routeParams, Cart, $http, $location) {
    $scope.totalPrice = 0;
    $scope.showCart = false;
    $rootScope.cartGoods = Cart.query(function() {
      angular.forEach($rootScope.cartGoods, function(value, index) {
        return $scope.totalPrice += value.total_price * value.quantity;
      });
      if ($rootScope.cartGoods.length) {
        return $scope.showCart = true;
      }
    });
    $scope.deleteItem = function(itemId) {
      var price, quantity;
      $http["delete"]('cart', {
        params: {
          item_id: itemId
        }
      });
      quantity = 0;
      price = 0;
      angular.forEach($rootScope.cartGoods, function(val, index) {
        if (val.order_item === itemId) {
          $rootScope.cartGoods.splice(index, 1);
          quantity = val.quantity;
          price = val.total_price;
          return true;
        }
      });
      $rootScope.totalCountCart -= quantity;
      $scope.totalPrice -= price * quantity;
      if ($rootScope.totalCountCart === 0) {
        return $scope.showCart = false;
      }
    };
    return $scope.submitOrder = function() {
      return swal({
        title: 'Вы уверены?',
        text: 'После того, как оформите заказ, Вы не сможете сгененировать XML, вы точно хотите оформить заказ без генерации XML файла?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Да, оформить заказ',
        cancelButtonText: 'Нет',
        closeOnConfirm: false,
        closeOnCancel: false
      }, function(isConfirm) {
        if (isConfirm) {
          return $http.get('cartOrder').success(function(data) {
            if (data === 'ok') {
              swal({
                title: 'Заказ оформлен',
                text: 'Мы рады что Вы пользуетесь нашим магазином!',
                type: 'success'
              });
              $rootScope.cartGoods = [];
              $rootScope.totalCountCart = 0;
              $scope.showCart = false;
              return $location.path('/goods');
            }
          }).error(function(data) {
            return console.log('error');
          });
        } else {
          return swal({
            title: 'Заказ не оформлен',
            text: 'Ну это какой-то текст',
            type: 'error'
          });
        }
      });
    };
  }).controller('OrderCtrl', function($scope, Orders, SingleOrder) {
    var $singleOrder;
    $scope.singleOrders = [];
    $scope.totalPrice = 0;
    $singleOrder = $('#single-order');
    $scope.orders = Orders.query(function() {
      return console.log($scope.orders);
    });
    return $scope.showOrder = function(orderId) {
      $scope.totalPrice = 0;
      return $scope.singleOrders = SingleOrder.get(orderId).query(function() {
        angular.forEach($scope.singleOrders, function(value, index) {
          return $scope.totalPrice += value.total_price * value.quantity;
        });
        return $singleOrder.modal('show');
      });
    };
  });

}).call(this);
