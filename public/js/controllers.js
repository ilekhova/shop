(function() {
  angular.module('IrkaApp').controller('MainCtrl', function($scope, $location) {
    return $scope.isActive = function(nav) {
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
  }).controller('GoodCtrl', function($scope, $resource, Good, Cart, Additions) {
    $scope.goods = Good.query();
    $scope.additions = Additions.query();
    $scope.selects = {};
    return $scope.addToCart = function(id, additions) {
      $scope.cartGood = new Cart({
        id: id,
        additions: additions
      });
      return $scope.cartGood.$save(function(data) {
        return console.log(data);
      });
    };
  }).controller('ItemCtrl', function($scope, $routeParams, Good) {
    return $scope.item = Good.get({
      id: parseInt($routeParams.id, 10)
    });
  }).controller('CartCtrl', function($scope, $routeParams, Cart) {
    return $scope.cartGoods = Cart.query();
  });

}).call(this);
