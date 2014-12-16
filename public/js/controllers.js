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
  }).controller('CartCtrl', function($scope, $rootScope, $routeParams, Cart, $http) {
    $rootScope.cartGoods = Cart.query();
    return $scope.deleteItem = function(itemId) {
      var quantity;
      $http["delete"]('cart', {
        params: {
          item_id: itemId
        }
      });
      quantity = 0;
      angular.forEach($rootScope.cartGoods, function(val, index) {
        if (val.order_item === itemId) {
          $rootScope.cartGoods.splice(index - 1, 1);
          quantity = val.quantity;
          return true;
        }
      });
      return $rootScope.totalCountCart -= quantity;
    };
  });

}).call(this);
