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
  }).controller('GoodCtrl', function($scope, $resource, Good) {
    return $scope.goods = Good.query();
  }).controller('ItemCtrl', function($scope, $routeParams, Good) {
    return $scope.item = Good.get({
      id: parseInt($routeParams.id, 10)
    });
  });

}).call(this);
